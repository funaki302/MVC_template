<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alerts - Bootstrap 5 Elements</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Bootstrap 5 alert examples - contextual feedback messages for user actions">
    <meta name="keywords" content="bootstrap, alerts, notifications, feedback, primary, success, danger, warning">
    
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
                            <li class="breadcrumb-item active">Alerts</li>
                        </ol>
                    </nav>

                    <!-- Page Header -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h1 class="h3 mb-0">Alerts</h1>
                            <p class="text-muted mb-0">Contextual feedback messages for user actions</p>
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

                    <!-- Alert Examples -->
                    <div class="row g-4">
                        
                        <!-- Basic Alerts -->
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Basic Alerts</h5>
                                </div>
                                <div class="card-body">
                                    <div class="element-preview-container">
                                        <div class="alert alert-primary" role="alert">
                                            A simple primary alert—check it out!
                                        </div>
                                        <div class="alert alert-secondary" role="alert">
                                            A simple secondary alert—check it out!
                                        </div>
                                        <div class="alert alert-success" role="alert">
                                            A simple success alert—check it out!
                                        </div>
                                        <div class="alert alert-danger" role="alert">
                                            A simple danger alert—check it out!
                                        </div>
                                        <div class="alert alert-warning" role="alert">
                                            A simple warning alert—check it out!
                                        </div>
                                        <div class="alert alert-info" role="alert">
                                            A simple info alert—check it out!
                                        </div>
                                        <div class="alert alert-light" role="alert">
                                            A simple light alert—check it out!
                                        </div>
                                        <div class="alert alert-dark" role="alert">
                                            A simple dark alert—check it out!
                                        </div>
                                    </div>
                                    <div class="element-code-block">
                                        <pre><code class="language-html">&lt;div class="alert alert-primary" role="alert"&gt;
    A simple primary alert—check it out!
&lt;/div&gt;
&lt;div class="alert alert-secondary" role="alert"&gt;
    A simple secondary alert—check it out!
&lt;/div&gt;
&lt;div class="alert alert-success" role="alert"&gt;
    A simple success alert—check it out!
&lt;/div&gt;
&lt;div class="alert alert-danger" role="alert"&gt;
    A simple danger alert—check it out!
&lt;/div&gt;</code></pre>
                                    </div>
                                    <button class="btn btn-sm btn-outline-secondary" onclick="copyCode(this)">
                                        <i class="bi bi-clipboard me-2"></i>Copy Code
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Alerts with Icons -->
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Alerts with Icons</h5>
                                </div>
                                <div class="card-body">
                                    <div class="element-preview-container">
                                        <div class="alert alert-primary d-flex align-items-center" role="alert">
                                            <i class="bi bi-info-circle me-2"></i>
                                            <div>An example alert with an icon</div>
                                        </div>
                                        <div class="alert alert-success d-flex align-items-center" role="alert">
                                            <i class="bi bi-check-circle me-2"></i>
                                            <div>An example success alert with an icon</div>
                                        </div>
                                        <div class="alert alert-warning d-flex align-items-center" role="alert">
                                            <i class="bi bi-exclamation-triangle me-2"></i>
                                            <div>An example warning alert with an icon</div>
                                        </div>
                                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                                            <i class="bi bi-exclamation-octagon me-2"></i>
                                            <div>An example danger alert with an icon</div>
                                        </div>
                                    </div>
                                    <div class="element-code-block">
                                        <pre><code class="language-html">&lt;div class="alert alert-primary d-flex align-items-center" role="alert"&gt;
    &lt;i class="bi bi-info-circle me-2"&gt;&lt;/i&gt;
    &lt;div&gt;An example alert with an icon&lt;/div&gt;
&lt;/div&gt;
&lt;div class="alert alert-success d-flex align-items-center" role="alert"&gt;
    &lt;i class="bi bi-check-circle me-2"&gt;&lt;/i&gt;
    &lt;div&gt;An example success alert with an icon&lt;/div&gt;
&lt;/div&gt;</code></pre>
                                    </div>
                                    <button class="btn btn-sm btn-outline-secondary" onclick="copyCode(this)">
                                        <i class="bi bi-clipboard me-2"></i>Copy Code
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Dismissible Alerts -->
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Dismissible Alerts</h5>
                                </div>
                                <div class="card-body">
                                    <div class="element-preview-container">
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                                            <i class="bi bi-info-circle me-2"></i>
                                            <strong>Heads up!</strong> This alert needs your attention, but it's not super important.
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <i class="bi bi-check-circle me-2"></i>
                                            <strong>Well done!</strong> You successfully read this important alert message.
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    </div>
                                    <div class="element-code-block">
                                        <pre><code class="language-html">&lt;div class="alert alert-warning alert-dismissible fade show" role="alert"&gt;
    &lt;strong&gt;Holy guacamole!&lt;/strong&gt; You should check in on some of those fields below.
    &lt;button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"&gt;&lt;/button&gt;
&lt;/div&gt;</code></pre>
                                    </div>
                                    <button class="btn btn-sm btn-outline-secondary" onclick="copyCode(this)">
                                        <i class="bi bi-clipboard me-2"></i>Copy Code
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Alerts with Additional Content -->
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Alerts with Additional Content</h5>
                                </div>
                                <div class="card-body">
                                    <div class="element-preview-container">
                                        <div class="alert alert-success" role="alert">
                                            <h4 class="alert-heading">Well done!</h4>
                                            <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
                                            <hr>
                                            <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
                                        </div>
                                        <div class="alert alert-info" role="alert">
                                            <h4 class="alert-heading">
                                                <i class="bi bi-info-circle me-2"></i>
                                                Information
                                            </h4>
                                            <p>This is an info alert with additional content and actions.</p>
                                            <div class="d-flex gap-2">
                                                <button class="btn btn-sm btn-info">Learn More</button>
                                                <button class="btn btn-sm btn-outline-info">Dismiss</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="element-code-block">
                                        <pre><code class="language-html">&lt;div class="alert alert-success" role="alert"&gt;
    &lt;h4 class="alert-heading"&gt;Well done!&lt;/h4&gt;
    &lt;p&gt;Aww yeah, you successfully read this important alert message.&lt;/p&gt;
    &lt;hr&gt;
    &lt;p class="mb-0"&gt;Whenever you need to, be sure to use margin utilities.&lt;/p&gt;
&lt;/div&gt;</code></pre>
                                    </div>
                                    <button class="btn btn-sm btn-outline-secondary" onclick="copyCode(this)">
                                        <i class="bi bi-clipboard me-2"></i>Copy Code
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Alert Examples -->
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Live Alert Examples</h5>
                                </div>
                                <div class="card-body">
                                    <div class="element-preview-container">
                                        <div id="liveAlertPlaceholder"></div>
                                        <div class="d-flex gap-2">
                                            <button type="button" class="btn btn-primary" onclick="showAlert('primary')">Show Primary Alert</button>
                                            <button type="button" class="btn btn-success" onclick="showAlert('success')">Show Success Alert</button>
                                            <button type="button" class="btn btn-warning" onclick="showAlert('warning')">Show Warning Alert</button>
                                            <button type="button" class="btn btn-danger" onclick="showAlert('danger')">Show Danger Alert</button>
                                        </div>
                                    </div>
                                    <div class="element-code-block">
                                        <pre><code class="language-html">const alertPlaceholder = document.getElementById('liveAlertPlaceholder')
const appendAlert = (message, type) => {
    const wrapper = document.createElement('div')
    wrapper.innerHTML = [
        `&lt;div class="alert alert-${type} alert-dismissible" role="alert"&gt;`,
        `   &lt;div&gt;${message}&lt;/div&gt;`,
        '   &lt;button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"&gt;&lt;/button&gt;',
        '&lt;/div&gt;'
    ].join('')
    alertPlaceholder.append(wrapper)
}</code></pre>
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

        // Live alert functionality
        const alertPlaceholder = document.getElementById('liveAlertPlaceholder')
        const appendAlert = (message, type) => {
            const wrapper = document.createElement('div')
            wrapper.innerHTML = [
                `<div class="alert alert-${type} alert-dismissible" role="alert">`,
                `   <div>${message}</div>`,
                '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
                '</div>'
            ].join('')
            alertPlaceholder.append(wrapper)
        }

        function showAlert(type) {
            const messages = {
                'primary': 'This is a primary alert message!',
                'success': 'Success! Your action was completed.',
                'warning': 'Warning! Please check your input.',
                'danger': 'Error! Something went wrong.'
            };
            appendAlert(messages[type] || 'Alert message', type);
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