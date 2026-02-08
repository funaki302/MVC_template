<?php
require_once __DIR__ . '/../helpers/lib_validation.php';

function e($v) { return htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8'); }
function cls_invalid($errors, $field) { return ($errors[$field] ?? '') !== '' ? 'is-invalid' : ''; }

$errors = ['name'=>'','email'=>'','password'=>'','telephone'=>''];
$values = ['name'=>'','email'=>'','telephone'=>''];
$success = false;
?>
<!DOCTYPE html>
<html lang="fr" data-bs-theme="light">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>

  <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" as="style">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <script type="module" crossorigin src=".<?= BASE_URL ?>/assets/vendor-bootstrap-C9iorZI5.js"></script>
  <script type="module" crossorigin src=".<?= BASE_URL ?>/assets/vendor-ui-CflGdlft.js"></script>
  <script type="module" crossorigin src=".<?= BASE_URL ?>/assets/main-bDXl1YJh.js"></script>
  <link rel="stylesheet" crossorigin href=".<?= BASE_URL ?>/assets/main-CFKPan32.css">
</head>
<body class="bg-light" data-page="login">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-12 col-md-8 col-lg-6">
        <div class="card shadow-sm">
          <div class="card-header">
            <h5 class="card-title mb-0">
              <i class="bi bi-person-circle me-2 text-primary"></i>
              Login utilisateur
            </h5>
          </div>

          <div class="card-body">
            <form id="registerForm" method="post" action="/">
              <div id="formStatus" class="alert d-none"></div>

              <div class="row g-3">
                <div class="col-12">
                  <div class="form-group floating-label">
                    <input
                      id="name"
                      name="name"
                      type="text"
                      class="form-control <?= cls_invalid($errors,'name') ?>"
                      value="<?= e($values['name']) ?>"
                      placeholder=" "
                      required
                    >
                    <label class="form-label">Nom</label>
                    <div class="invalid-feedback" id="nameError"><?= e($errors['name']) ?></div>
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-group floating-label">
                    <input
                      id="email"
                      name="email"
                      type="email"
                      class="form-control <?= cls_invalid($errors,'email') ?>"
                      value="<?= e($values['email']) ?>"
                      placeholder=" "
                      required
                    >
                    <label class="form-label">Email</label>
                    <div class="invalid-feedback" id="emailError"><?= e($errors['email']) ?></div>
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-group floating-label">
                    <input
                      id="password"
                      name="password"
                      type="password"
                      class="form-control <?= cls_invalid($errors,'password') ?>"
                      placeholder=" "
                      required
                    >
                    <label class="form-label">Mot de passe</label>
                    <div class="invalid-feedback" id="passwordError"><?= e($errors['password']) ?></div>
                  </div>
                </div>

                <div class="col-12">
                  <div class="form-group floating-label">
                    <input
                      id="telephone"
                      name="telephone"
                      type="text"
                      class="form-control <?= cls_invalid($errors,'telephone') ?>"
                      value="<?= e($values['telephone']) ?>"
                      placeholder=" "
                      required
                    >
                    <label class="form-label">Téléphone</label>
                    <div class="invalid-feedback" id="telephoneError"><?= e($errors['telephone']) ?></div>
                  </div>
                </div>

                <div class="col-12">
                  <button class="btn btn-primary" type="submit">
                    <i class="bi bi-box-arrow-in-right me-2"></i>
                    Se connecter
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>