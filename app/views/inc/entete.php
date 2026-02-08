<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <?php $cspNonce = \Flight::app()->get('csp_nonce'); $baseUrl = rtrim(BASE_URL, '/'); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages & Communication - Modern Bootstrap Admin</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Real-time messaging and communication center with chat interface">
    <meta name="keywords" content="bootstrap, admin, dashboard, messages, chat, communication">
    
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="<?= $baseUrl ?>/assets/favicon-CvUZKS4z.svg">
    <link rel="icon" type="image/png" href="<?= $baseUrl ?>/assets/favicon-B_cwPWBd.png">
    
    <!-- PWA Manifest -->
    <link rel="manifest" href="<?= $baseUrl ?>/assets/manifest-DTaoG9pG.json">
    
    <!-- Preload critical fonts -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" as="style">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">  
  <script nonce="<?= htmlspecialchars($cspNonce) ?>" type="module" crossorigin src="<?= $baseUrl ?>/assets/vendor-bootstrap-C9iorZI5.js"></script>
  <script nonce="<?= htmlspecialchars($cspNonce) ?>" type="module" crossorigin src="<?= $baseUrl ?>/assets/vendor-charts-DGwYAWel.js"></script>
  <script nonce="<?= htmlspecialchars($cspNonce) ?>" type="module" crossorigin src="<?= $baseUrl ?>/assets/vendor-ui-CflGdlft.js"></script>
  <script nonce="<?= htmlspecialchars($cspNonce) ?>" type="module" crossorigin src="<?= $baseUrl ?>/assets/main-bDXl1YJh.js"></script>
  <script nonce="<?= htmlspecialchars($cspNonce) ?>" type="module" crossorigin src="<?= $baseUrl ?>/assets/messages-ByGNYy7N.js"></script>
  <script nonce="<?= htmlspecialchars($cspNonce) ?>" src="<?= $baseUrl ?>/assets/js/notifications.js"></script>
  <script nonce="<?= htmlspecialchars($cspNonce) ?>" src="<?= $baseUrl ?>/assets/js/theme.js"></script>
  <link rel="stylesheet" crossorigin href="<?= $baseUrl ?>/assets/main-CFKPan32.css">
    
    <!-- Styles personnalisés pour les conversations -->
    <link rel="stylesheet" href="<?= $baseUrl ?>/assets/css/styleMess.css">

</head>
