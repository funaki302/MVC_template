<?php

use app\controllers\DiscussionController;
use app\controllers\MessageController;
use app\middlewares\SecurityHeadersMiddleware;
use flight\Engine;
use flight\net\Router;
use app\controllers\UserController;


/** 
 * @var Router $router 
 * @var Engine $app
 */

// This wraps all routes in the group with the SecurityHeadersMiddleware
$router->group('', function(Router $router) use ($app) {
	/*
	$userController = new UserController();
	$discussionController = new DiscussionController();
	$messageController = new MessageController();
	*/

// URL D'ACCUEIL 
	$router->get('/', function() use ($app) {
		$app->render('login', []);
	});

	$router->post('/', function() {
		$controller = new UserController();
		$controller->login();
	});

// URL DE BASE
	$router->get('/home', function() use ($app) {
		if (!isset($_SESSION['user_id'])) {
			$app->redirect('/');
			return;
		}
		$app->render('index', []);
	});

	$router->get('/users', function() use ($app) {
		if (!isset($_SESSION['user_id'])) {
			$app->redirect('/');
			return;
		}
		$app->render('users', []);
	});

	$router->get('/analytics', function() use ($app) {
		if (!isset($_SESSION['user_id'])) {
			$app->redirect('/');
			return;
		}
		$app->render('analytics', []);
	});

	$router->get('/products', function() use ($app) {
		if (!isset($_SESSION['user_id'])) {
			$app->redirect('/');
			return;
		}
		$app->render('products', []);
	});

	$router->get('/settings', function() use ($app) {
		if (!isset($_SESSION['user_id'])) {
			$app->redirect('/');
			return;
		}
		$app->render('settings', []);
	});

	$router->get('/orders', function() use ($app) {
		if (!isset($_SESSION['user_id'])) {
			$app->redirect('/');
			return;
		}
		$app->render('orders', []);
	});

	$router->get('/forms', function() use ($app) {
		if (!isset($_SESSION['user_id'])) {
			$app->redirect('/');
			return;
		}
		$app->render('forms', []);
	});

	$router->get('/reports', function() use ($app) {
		if (!isset($_SESSION['user_id'])) {
			$app->redirect('/');
			return;
		}
		$app->render('reports', []);
	});

	$router->get('/calendar', function() use ($app) {
		if (!isset($_SESSION['user_id'])) {
			$app->redirect('/');
			return;
		}
		$app->render('caledar', []);
	});

	$router->get('/files', function() use ($app) {
		if (!isset($_SESSION['user_id'])) {
			$app->redirect('/');
			return;
		}
		$app->render('files', []);
	});

	$router->get('/messages', function() use ($app) {
		if (!isset($_SESSION['user_id'])) {
			$app->redirect('/');
			return;
		}
		$app->render('messages', []);
	});

	$router->post('/logout', function() use ($app) {
		if (!isset($_SESSION['user_id'])) {
			$app->redirect('/');
			return;
		}
		$id = $_SESSION['user_id'];
		$userController = new UserController();
		$userController->logout($id);
		$app->redirect('/');
		return;
	});

// RESAKA MESSAGE
	$router->get('/api/conversations/@id', function($id) use ($app) {
		$discussionController = new DiscussionController();
		$conversation = $discussionController->getDiscussions($id);
		$app->json($conversation);
	});

	$router->get('/api/unread/@id', function($id) use ($app) {
		$userId = (int) $id;
		if ($userId <= 0) {
			$app->json(['unread_total' => 0]);
			return;
		}

		try {
			$db = \Flight::db();
			$sql = "SELECT COUNT(*) AS unread_total
					FROM messages m
					JOIN discussion d ON d.id_discussion = m.id_discussion
					WHERE (d.id_user1 = ? OR d.id_user2 = ?)
					  AND m.id_sender != ?
					  AND m.seen_at IS NULL";
			$stmt = $db->prepare($sql);
			$stmt->execute([$userId, $userId, $userId]);
			$row = $stmt->fetch(\PDO::FETCH_ASSOC);
			$app->json(['unread_total' => (int) ($row['unread_total'] ?? 0)]);
		} catch (\PDOException $e) {
			error_log("Error in /api/unread - " . $e->getMessage());
			$app->json(['unread_total' => 0]);
		}
	});

	$router->get('/api/notifications/messages/@id', function($id) use ($app) {
		$userId = (int) $id;
		if ($userId <= 0) {
			$app->json([]);
			return;
		}

		try {
			$db = \Flight::db();
			$sql = "SELECT
						d.id_discussion,
						u.id_user AS other_user_id,
						u.name AS other_user_name,
						COUNT(m.id_message) AS unread_count,
						MAX(m.id_message) AS last_unread_message_id,
						MAX(m.date_envoie) AS last_unread_date
					FROM messages m
					JOIN discussion d ON d.id_discussion = m.id_discussion
					JOIN user u ON u.id_user = IF(d.id_user1 = ?, d.id_user2, d.id_user1)
					WHERE (d.id_user1 = ? OR d.id_user2 = ?)
					  AND m.id_sender != ?
					  AND m.seen_at IS NULL
					GROUP BY d.id_discussion, u.id_user, u.name
					ORDER BY last_unread_message_id DESC
					LIMIT 5";
			$stmt = $db->prepare($sql);
			$stmt->execute([$userId, $userId, $userId, $userId]);
			$rows = $stmt->fetchAll(\PDO::FETCH_ASSOC) ?: [];
			$app->json($rows);
		} catch (\PDOException $e) {
			error_log("Error in /api/notifications/messages - " . $e->getMessage());
			$app->json([]);
		}
	});

	$router->get('/api/messages/@id', function($id) use ($app) {
		$messageController = new MessageController();
		$messages = $messageController->getByDiscussion($id);
		$app->json($messages);
	});

	$router->get('/api/user2/@id', function($id) use ($app) {
		$discussionController = new DiscussionController();
		$conversation = $discussionController->getById($id);
		$app->json($conversation);
	});

	$router->post('/api/messages/send', function() use ($app) {
		$messageController = new MessageController();
		
		// Récupérer les données JSON du corps de la requête
		$json_input = file_get_contents('php://input');
		$data = json_decode($json_input, true);
		
		$result = $messageController->create($data);
		$app->json(['success' => $result !== false, 'message_id' => $result]);
	});

	$router->post('/api/messages/seen', function() use ($app) {
		// Récupérer les données JSON du corps de la requête
		$json_input = file_get_contents('php://input');
		$data = json_decode($json_input, true);

		$discussionId = (int)($data['id_discussion'] ?? 0);
		$viewerId = (int)($data['viewer_id'] ?? 0);

		if ($discussionId <= 0 || $viewerId <= 0) {
			$app->json(['success' => false, 'error' => 'Paramètres invalides']);
			return;
		}

		$messageModel = new \app\models\Message();
		$updated = $messageModel->markSeen($discussionId, $viewerId);
		$app->json(['success' => $updated !== false, 'updated' => $updated === false ? 0 : (int)$updated]);
	});

	$router->post('/api/recherche', function() use ($app) {
		$discussionController = new DiscussionController();
		
		// Récupérer les données JSON du corps de la requête
		$json_input = file_get_contents('php://input');
		$data = json_decode($json_input, true);
		
		$result = $discussionController->recherche($data);
		$app->json($result);
	});

	$router->get('/api/noConv/@id', function($id) use ($app){
		$discussionController = new DiscussionController();
		$result = $discussionController->getNoConv($id);
		$app->json($result);
	});

	$router->post('/api/newConversation', function() use ($app) {
		$discussionController = new DiscussionController();
		
		// Récupérer les données JSON du corps de la requête
		$json_input = file_get_contents('php://input');
		$data = json_decode($json_input, true);
		
		$result = $discussionController->createDiscussion($data);
		$app->json($result);
	});

// RESAKA USER
	$router->get('/api/AllUsers', function() use ($app) {
		$userController = new UserController();
		$users = $userController->getAll();
		$app->json($users);
	});
	
}, [ SecurityHeadersMiddleware::class ]);