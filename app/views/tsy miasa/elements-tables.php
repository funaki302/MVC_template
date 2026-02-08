<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tables - Bootstrap 5 Elements</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Bootstrap 5 table examples - responsive design, striped, bordered, and hover styles">
    <meta name="keywords" content="bootstrap, tables, responsive, striped, bordered, hover, data tables">
    
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href=".<?= BASE_URL ?>/assets/favicon-CvUZKS4z.svg">
    <link rel="icon" type="image/png" href=".<?= BASE_URL ?>/assets/favicon-B_cwPWBd.png">
    
    <!-- PWA Manifest -->
    <link rel="manifest" href=".<?= BASE_URL ?>/assets/manifest-DTaoG9pG.json">
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Prism.js for syntax highlighting -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css" rel="stylesheet">
    
    <!-- Custom syntax highlighting overrides -->
    <style>
        .element-code-block pre[class*="language-"] {
            background: #1e1e1e !important;
            border: 1px solid #333 !important;
            border-radius: 0.5rem !important;
            margin: 0 !important;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1) !important;
        }
        
        .element-code-block code[class*="language-"] {
            background: transparent !important;
            color: #d4d4d4 !important;
            font-family: 'Fira Code', 'Courier New', monospace !important;
            font-size: 0.875rem !important;
            line-height: 1.6 !important;
        }
        
        /* VS Code inspired colors */
        .token.tag { color: #569cd6 !important; }
        .token.attr-name { color: #9cdcfe !important; }
        .token.attr-value { color: #ce9178 !important; }
        .token.string { color: #ce9178 !important; }
        .token.punctuation { color: #808080 !important; }
        .token.comment { color: #6a9955 !important; font-style: italic !important; }
        
        /* Bootstrap classes highlighting */
        .token.attr-value .token.string {
            background: linear-gradient(transparent 0%, transparent 100%);
        }

        /* Fix unreadable active+hover sidebar navigation */
        .nav-submenu .nav-link.active:hover {
            background-color: var(--bs-primary) !important;
            color: white !important;
            transform: translateX(2px) !important;
        }

        .nav-submenu .nav-link.active:hover i {
            opacity: 1 !important;
            color: white !important;
        }

        .sidebar-nav .nav .nav-link.active:hover {
            background-color: var(--bs-primary) !important;
            color: white !important;
            transform: none !important;
        }
    </style>
  <script type="module" crossorigin src=".<?= BASE_URL ?>/assets/vendor-bootstrap-C9iorZI5.js"></script>
  <script type="module" crossorigin src=".<?= BASE_URL ?>/assets/vendor-charts-DGwYAWel.js"></script>
  <script type="module" crossorigin src=".<?= BASE_URL ?>/assets/vendor-ui-CflGdlft.js"></script>
  <script type="module" crossorigin src=".<?= BASE_URL ?>/assets/main-bDXl1YJh.js"></script>
  <link rel="stylesheet" crossorigin href=".<?= BASE_URL ?>/assets/main-CFKPan32.css">
</head>

<body data-page="elements" class="elements-page">
    <div class="admin-app">
        <div class="admin-wrapper" id="admin-wrapper">
            
            <!-- Header -->
            <?php include __DIR__ . "/inc/header.php"; ?>

            <!-- Sidebar -->
            <?php include __DIR__ . "/inc/menu.php"; ?>

            <!-- Sidebar Backdrop (mobile overlay) -->
        <div class="sidebar-backdrop" aria-hidden="true"></div>
            <!-- Main Content -->
            <main class="admin-main">
                <div class="container-fluid p-4">
                    
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb" class="mb-4">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./elements.html">Elements</a></li>
                            <li class="breadcrumb-item active">Tables</li>
                        </ol>
                    </nav>

                    <!-- Page Header -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h1 class="h3 mb-0">Tables</h1>
                            <p class="text-muted mb-0">Responsive design, striped, bordered, and hover styles</p>
                        </div>
                        <div class="d-flex gap-2">
                            <button class="btn btn-outline-secondary" onclick="window.history.back()">
                                <i class="bi bi-arrow-left me-2"></i>Back
                            </button>
                            <button class="btn btn-primary" onclick="copyAllCode()">
                                <i class="bi bi-clipboard me-2"></i>Copy All
                            </button>
                        </div>
                    </div>

                    <!-- Table Examples -->
                    <div class="row g-4">
                        
                        <!-- Basic Table -->
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Basic Table</h5>
                                </div>
                                <div class="card-body">
                                    <div class="element-preview-container">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">First</th>
                                                    <th scope="col">Last</th>
                                                    <th scope="col">Handle</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">1</th>
                                                    <td>Mark</td>
                                                    <td>Otto</td>
                                                    <td>@mdo</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">2</th>
                                                    <td>Jacob</td>
                                                    <td>Thornton</td>
                                                    <td>@fat</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">3</th>
                                                    <td colspan="2">Larry the Bird</td>
                                                    <td>@twitter</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="element-code-block">
                                        <pre><code class="language-html">&lt;table class="table"&gt;
  &lt;thead&gt;
    &lt;tr&gt;
      &lt;th scope="col"&gt;#&lt;/th&gt;
      &lt;th scope="col"&gt;First&lt;/th&gt;
      &lt;th scope="col"&gt;Last&lt;/th&gt;
      &lt;th scope="col"&gt;Handle&lt;/th&gt;
    &lt;/tr&gt;
  &lt;/thead&gt;
  &lt;tbody&gt;
    &lt;tr&gt;
      &lt;th scope="row"&gt;1&lt;/th&gt;
      &lt;td&gt;Mark&lt;/td&gt;
      &lt;td&gt;Otto&lt;/td&gt;
      &lt;td&gt;@mdo&lt;/td&gt;
    &lt;/tr&gt;
    &lt;tr&gt;
      &lt;th scope="row"&gt;2&lt;/th&gt;
      &lt;td&gt;Jacob&lt;/td&gt;
      &lt;td&gt;Thornton&lt;/td&gt;
      &lt;td&gt;@fat&lt;/td&gt;
    &lt;/tr&gt;
    &lt;tr&gt;
      &lt;th scope="row"&gt;3&lt;/th&gt;
      &lt;td colspan="2"&gt;Larry the Bird&lt;/td&gt;
      &lt;td&gt;@twitter&lt;/td&gt;
    &lt;/tr&gt;
  &lt;/tbody&gt;
&lt;/table&gt;</code></pre>
                                    </div>
                                    <button class="btn btn-sm btn-outline-secondary" onclick="copyCode(this)">
                                        <i class="bi bi-clipboard me-2"></i>Copy Code
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Table Variants -->
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Table Variants</h5>
                                </div>
                                <div class="card-body">
                                    <div class="element-preview-container">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Class</th>
                                                    <th scope="col">Heading</th>
                                                    <th scope="col">Heading</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">Default</th>
                                                    <td>Cell</td>
                                                    <td>Cell</td>
                                                </tr>
                                                <tr class="table-primary">
                                                    <th scope="row">Primary</th>
                                                    <td>Cell</td>
                                                    <td>Cell</td>
                                                </tr>
                                                <tr class="table-secondary">
                                                    <th scope="row">Secondary</th>
                                                    <td>Cell</td>
                                                    <td>Cell</td>
                                                </tr>
                                                <tr class="table-success">
                                                    <th scope="row">Success</th>
                                                    <td>Cell</td>
                                                    <td>Cell</td>
                                                </tr>
                                                <tr class="table-danger">
                                                    <th scope="row">Danger</th>
                                                    <td>Cell</td>
                                                    <td>Cell</td>
                                                </tr>
                                                <tr class="table-warning">
                                                    <th scope="row">Warning</th>
                                                    <td>Cell</td>
                                                    <td>Cell</td>
                                                </tr>
                                                <tr class="table-info">
                                                    <th scope="row">Info</th>
                                                    <td>Cell</td>
                                                    <td>Cell</td>
                                                </tr>
                                                <tr class="table-light">
                                                    <th scope="row">Light</th>
                                                    <td>Cell</td>
                                                    <td>Cell</td>
                                                </tr>
                                                <tr class="table-dark">
                                                    <th scope="row">Dark</th>
                                                    <td>Cell</td>
                                                    <td>Cell</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="element-code-block">
                                        <pre><code class="language-html">&lt;table class="table"&gt;
  &lt;tbody&gt;
    &lt;tr&gt;
      &lt;th scope="row"&gt;Default&lt;/th&gt;
      &lt;td&gt;Cell&lt;/td&gt;
      &lt;td&gt;Cell&lt;/td&gt;
    &lt;/tr&gt;
    &lt;tr class="table-primary"&gt;
      &lt;th scope="row"&gt;Primary&lt;/th&gt;
      &lt;td&gt;Cell&lt;/td&gt;
      &lt;td&gt;Cell&lt;/td&gt;
    &lt;/tr&gt;
    &lt;tr class="table-success"&gt;
      &lt;th scope="row"&gt;Success&lt;/th&gt;
      &lt;td&gt;Cell&lt;/td&gt;
      &lt;td&gt;Cell&lt;/td&gt;
    &lt;/tr&gt;
    &lt;tr class="table-danger"&gt;
      &lt;th scope="row"&gt;Danger&lt;/th&gt;
      &lt;td&gt;Cell&lt;/td&gt;
      &lt;td&gt;Cell&lt;/td&gt;
    &lt;/tr&gt;
  &lt;/tbody&gt;
&lt;/table&gt;</code></pre>
                                    </div>
                                    <button class="btn btn-sm btn-outline-secondary" onclick="copyCode(this)">
                                        <i class="bi bi-clipboard me-2"></i>Copy Code
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Striped Table -->
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Striped Table</h5>
                                </div>
                                <div class="card-body">
                                    <div class="element-preview-container">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">First</th>
                                                    <th scope="col">Last</th>
                                                    <th scope="col">Handle</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">1</th>
                                                    <td>Mark</td>
                                                    <td>Otto</td>
                                                    <td>@mdo</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">2</th>
                                                    <td>Jacob</td>
                                                    <td>Thornton</td>
                                                    <td>@fat</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">3</th>
                                                    <td>Larry</td>
                                                    <td>the Bird</td>
                                                    <td>@twitter</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">4</th>
                                                    <td>John</td>
                                                    <td>Doe</td>
                                                    <td>@john</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="element-code-block">
                                        <pre><code class="language-html">&lt;table class="table table-striped"&gt;
  &lt;thead&gt;
    &lt;tr&gt;
      &lt;th scope="col"&gt;#&lt;/th&gt;
      &lt;th scope="col"&gt;First&lt;/th&gt;
      &lt;th scope="col"&gt;Last&lt;/th&gt;
      &lt;th scope="col"&gt;Handle&lt;/th&gt;
    &lt;/tr&gt;
  &lt;/thead&gt;
  &lt;tbody&gt;
    &lt;tr&gt;
      &lt;th scope="row"&gt;1&lt;/th&gt;
      &lt;td&gt;Mark&lt;/td&gt;
      &lt;td&gt;Otto&lt;/td&gt;
      &lt;td&gt;@mdo&lt;/td&gt;
    &lt;/tr&gt;
    &lt;!-- More rows... --&gt;
  &lt;/tbody&gt;
&lt;/table&gt;</code></pre>
                                    </div>
                                    <button class="btn btn-sm btn-outline-secondary" onclick="copyCode(this)">
                                        <i class="bi bi-clipboard me-2"></i>Copy Code
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Hoverable Table -->
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Hoverable Table</h5>
                                </div>
                                <div class="card-body">
                                    <div class="element-preview-container">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">First</th>
                                                    <th scope="col">Last</th>
                                                    <th scope="col">Handle</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">1</th>
                                                    <td>Mark</td>
                                                    <td>Otto</td>
                                                    <td>@mdo</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">2</th>
                                                    <td>Jacob</td>
                                                    <td>Thornton</td>
                                                    <td>@fat</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">3</th>
                                                    <td>Larry</td>
                                                    <td>the Bird</td>
                                                    <td>@twitter</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="element-code-block">
                                        <pre><code class="language-html">&lt;table class="table table-hover"&gt;
  &lt;thead&gt;
    &lt;tr&gt;
      &lt;th scope="col"&gt;#&lt;/th&gt;
      &lt;th scope="col"&gt;First&lt;/th&gt;
      &lt;th scope="col"&gt;Last&lt;/th&gt;
      &lt;th scope="col"&gt;Handle&lt;/th&gt;
    &lt;/tr&gt;
  &lt;/thead&gt;
  &lt;tbody&gt;
    &lt;tr&gt;
      &lt;th scope="row"&gt;1&lt;/th&gt;
      &lt;td&gt;Mark&lt;/td&gt;
      &lt;td&gt;Otto&lt;/td&gt;
      &lt;td&gt;@mdo&lt;/td&gt;
    &lt;/tr&gt;
    &lt;!-- More rows... --&gt;
  &lt;/tbody&gt;
&lt;/table&gt;</code></pre>
                                    </div>
                                    <button class="btn btn-sm btn-outline-secondary" onclick="copyCode(this)">
                                        <i class="bi bi-clipboard me-2"></i>Copy Code
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Bordered Table -->
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Bordered Table</h5>
                                </div>
                                <div class="card-body">
                                    <div class="element-preview-container">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">First</th>
                                                    <th scope="col">Last</th>
                                                    <th scope="col">Handle</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">1</th>
                                                    <td>Mark</td>
                                                    <td>Otto</td>
                                                    <td>@mdo</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">2</th>
                                                    <td>Jacob</td>
                                                    <td>Thornton</td>
                                                    <td>@fat</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">3</th>
                                                    <td colspan="2">Larry the Bird</td>
                                                    <td>@twitter</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="element-code-block">
                                        <pre><code class="language-html">&lt;table class="table table-bordered"&gt;
  &lt;thead&gt;
    &lt;tr&gt;
      &lt;th scope="col"&gt;#&lt;/th&gt;
      &lt;th scope="col"&gt;First&lt;/th&gt;
      &lt;th scope="col"&gt;Last&lt;/th&gt;
      &lt;th scope="col"&gt;Handle&lt;/th&gt;
    &lt;/tr&gt;
  &lt;/thead&gt;
  &lt;tbody&gt;
    &lt;tr&gt;
      &lt;th scope="row"&gt;1&lt;/th&gt;
      &lt;td&gt;Mark&lt;/td&gt;
      &lt;td&gt;Otto&lt;/td&gt;
      &lt;td&gt;@mdo&lt;/td&gt;
    &lt;/tr&gt;
    &lt;!-- More rows... --&gt;
  &lt;/tbody&gt;
&lt;/table&gt;</code></pre>
                                    </div>
                                    <button class="btn btn-sm btn-outline-secondary" onclick="copyCode(this)">
                                        <i class="bi bi-clipboard me-2"></i>Copy Code
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Borderless Table -->
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Borderless Table</h5>
                                </div>
                                <div class="card-body">
                                    <div class="element-preview-container">
                                        <table class="table table-borderless">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">First</th>
                                                    <th scope="col">Last</th>
                                                    <th scope="col">Handle</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">1</th>
                                                    <td>Mark</td>
                                                    <td>Otto</td>
                                                    <td>@mdo</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">2</th>
                                                    <td>Jacob</td>
                                                    <td>Thornton</td>
                                                    <td>@fat</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">3</th>
                                                    <td colspan="2">Larry the Bird</td>
                                                    <td>@twitter</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="element-code-block">
                                        <pre><code class="language-html">&lt;table class="table table-borderless"&gt;
  &lt;thead&gt;
    &lt;tr&gt;
      &lt;th scope="col"&gt;#&lt;/th&gt;
      &lt;th scope="col"&gt;First&lt;/th&gt;
      &lt;th scope="col"&gt;Last&lt;/th&gt;
      &lt;th scope="col"&gt;Handle&lt;/th&gt;
    &lt;/tr&gt;
  &lt;/thead&gt;
  &lt;tbody&gt;
    &lt;tr&gt;
      &lt;th scope="row"&gt;1&lt;/th&gt;
      &lt;td&gt;Mark&lt;/td&gt;
      &lt;td&gt;Otto&lt;/td&gt;
      &lt;td&gt;@mdo&lt;/td&gt;
    &lt;/tr&gt;
    &lt;!-- More rows... --&gt;
  &lt;/tbody&gt;
&lt;/table&gt;</code></pre>
                                    </div>
                                    <button class="btn btn-sm btn-outline-secondary" onclick="copyCode(this)">
                                        <i class="bi bi-clipboard me-2"></i>Copy Code
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Small Table -->
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Small Table</h5>
                                </div>
                                <div class="card-body">
                                    <div class="element-preview-container">
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">First</th>
                                                    <th scope="col">Last</th>
                                                    <th scope="col">Handle</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">1</th>
                                                    <td>Mark</td>
                                                    <td>Otto</td>
                                                    <td>@mdo</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">2</th>
                                                    <td>Jacob</td>
                                                    <td>Thornton</td>
                                                    <td>@fat</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">3</th>
                                                    <td colspan="2">Larry the Bird</td>
                                                    <td>@twitter</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="element-code-block">
                                        <pre><code class="language-html">&lt;table class="table table-sm"&gt;
  &lt;thead&gt;
    &lt;tr&gt;
      &lt;th scope="col"&gt;#&lt;/th&gt;
      &lt;th scope="col"&gt;First&lt;/th&gt;
      &lt;th scope="col"&gt;Last&lt;/th&gt;
      &lt;th scope="col"&gt;Handle&lt;/th&gt;
    &lt;/tr&gt;
  &lt;/thead&gt;
  &lt;tbody&gt;
    &lt;tr&gt;
      &lt;th scope="row"&gt;1&lt;/th&gt;
      &lt;td&gt;Mark&lt;/td&gt;
      &lt;td&gt;Otto&lt;/td&gt;
      &lt;td&gt;@mdo&lt;/td&gt;
    &lt;/tr&gt;
    &lt;!-- More rows... --&gt;
  &lt;/tbody&gt;
&lt;/table&gt;</code></pre>
                                    </div>
                                    <button class="btn btn-sm btn-outline-secondary" onclick="copyCode(this)">
                                        <i class="bi bi-clipboard me-2"></i>Copy Code
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Responsive Table -->
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Responsive Tables</h5>
                                </div>
                                <div class="card-body">
                                    <div class="element-preview-container">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Heading</th>
                                                        <th scope="col">Heading</th>
                                                        <th scope="col">Heading</th>
                                                        <th scope="col">Heading</th>
                                                        <th scope="col">Heading</th>
                                                        <th scope="col">Heading</th>
                                                        <th scope="col">Heading</th>
                                                        <th scope="col">Heading</th>
                                                        <th scope="col">Heading</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">1</th>
                                                        <td>Cell</td>
                                                        <td>Cell</td>
                                                        <td>Cell</td>
                                                        <td>Cell</td>
                                                        <td>Cell</td>
                                                        <td>Cell</td>
                                                        <td>Cell</td>
                                                        <td>Cell</td>
                                                        <td>Cell</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">2</th>
                                                        <td>Cell</td>
                                                        <td>Cell</td>
                                                        <td>Cell</td>
                                                        <td>Cell</td>
                                                        <td>Cell</td>
                                                        <td>Cell</td>
                                                        <td>Cell</td>
                                                        <td>Cell</td>
                                                        <td>Cell</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">3</th>
                                                        <td>Cell</td>
                                                        <td>Cell</td>
                                                        <td>Cell</td>
                                                        <td>Cell</td>
                                                        <td>Cell</td>
                                                        <td>Cell</td>
                                                        <td>Cell</td>
                                                        <td>Cell</td>
                                                        <td>Cell</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="element-code-block">
                                        <pre><code class="language-html">&lt;div class="table-responsive"&gt;
  &lt;table class="table"&gt;
    &lt;thead&gt;
      &lt;tr&gt;
        &lt;th scope="col"&gt;#&lt;/th&gt;
        &lt;th scope="col"&gt;Heading&lt;/th&gt;
        &lt;th scope="col"&gt;Heading&lt;/th&gt;
        &lt;th scope="col"&gt;Heading&lt;/th&gt;
        &lt;th scope="col"&gt;Heading&lt;/th&gt;
        &lt;th scope="col"&gt;Heading&lt;/th&gt;
        &lt;th scope="col"&gt;Heading&lt;/th&gt;
        &lt;th scope="col"&gt;Heading&lt;/th&gt;
        &lt;th scope="col"&gt;Heading&lt;/th&gt;
        &lt;th scope="col"&gt;Heading&lt;/th&gt;
      &lt;/tr&gt;
    &lt;/thead&gt;
    &lt;tbody&gt;
      &lt;tr&gt;
        &lt;th scope="row"&gt;1&lt;/th&gt;
        &lt;td&gt;Cell&lt;/td&gt;
        &lt;td&gt;Cell&lt;/td&gt;
        &lt;td&gt;Cell&lt;/td&gt;
        &lt;td&gt;Cell&lt;/td&gt;
        &lt;td&gt;Cell&lt;/td&gt;
        &lt;td&gt;Cell&lt;/td&gt;
        &lt;td&gt;Cell&lt;/td&gt;
        &lt;td&gt;Cell&lt;/td&gt;
        &lt;td&gt;Cell&lt;/td&gt;
      &lt;/tr&gt;
      &lt;!-- More rows... --&gt;
    &lt;/tbody&gt;
  &lt;/table&gt;
&lt;/div&gt;</code></pre>
                                    </div>
                                    <button class="btn btn-sm btn-outline-secondary" onclick="copyCode(this)">
                                        <i class="bi bi-clipboard me-2"></i>Copy Code
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Dark Table -->
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Dark Table</h5>
                                </div>
                                <div class="card-body">
                                    <div class="element-preview-container">
                                        <table class="table table-dark">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">First</th>
                                                    <th scope="col">Last</th>
                                                    <th scope="col">Handle</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">1</th>
                                                    <td>Mark</td>
                                                    <td>Otto</td>
                                                    <td>@mdo</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">2</th>
                                                    <td>Jacob</td>
                                                    <td>Thornton</td>
                                                    <td>@fat</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">3</th>
                                                    <td>Larry</td>
                                                    <td>the Bird</td>
                                                    <td>@twitter</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="element-code-block">
                                        <pre><code class="language-html">&lt;table class="table table-dark"&gt;
  &lt;thead&gt;
    &lt;tr&gt;
      &lt;th scope="col"&gt;#&lt;/th&gt;
      &lt;th scope="col"&gt;First&lt;/th&gt;
      &lt;th scope="col"&gt;Last&lt;/th&gt;
      &lt;th scope="col"&gt;Handle&lt;/th&gt;
    &lt;/tr&gt;
  &lt;/thead&gt;
  &lt;tbody&gt;
    &lt;tr&gt;
      &lt;th scope="row"&gt;1&lt;/th&gt;
      &lt;td&gt;Mark&lt;/td&gt;
      &lt;td&gt;Otto&lt;/td&gt;
      &lt;td&gt;@mdo&lt;/td&gt;
    &lt;/tr&gt;
    &lt;!-- More rows... --&gt;
  &lt;/tbody&gt;
&lt;/table&gt;</code></pre>
                                    </div>
                                    <button class="btn btn-sm btn-outline-secondary" onclick="copyCode(this)">
                                        <i class="bi bi-clipboard me-2"></i>Copy Code
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </main>

            <!-- Footer -->
            <?php include __DIR__ . "/inc/footer.php"; ?>

        </div>
    </div>

    <!-- Scripts -->
    
    <!-- Prism.js for syntax highlighting -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-core.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/autoloader/prism-autoloader.min.js"></script>
    
    <script>
        function copyCode(button) {
            const codeBlock = button.parentElement.querySelector('.element-code-block pre code');
            navigator.clipboard.writeText(codeBlock.textContent).then(() => {
                const originalText = button.innerHTML;
                button.innerHTML = '<i class="bi bi-check me-2"></i>Copied!';
                button.classList.add('btn-success');
                setTimeout(() => {
                    button.innerHTML = originalText;
                    button.classList.remove('btn-success');
                }, 2000);
            });
        }

        function copyAllCode() {
            const allCodeBlocks = document.querySelectorAll('.element-code-block pre code');
            let allCode = '';
            allCodeBlocks.forEach(block => {
                allCode += block.textContent + '\n\n';
            });
            navigator.clipboard.writeText(allCode).then(() => {
                alert('All code copied to clipboard!');
            });
        }

        function initializeSyntaxHighlighting() {
            // Initialize Prism.js highlighting
            if (typeof Prism !== 'undefined') {
                Prism.highlightAll();
            }
        }
            }
            
            // Apply syntax highlighting
            initializeSyntaxHighlighting();
        });
    </script>
</body>
</html>