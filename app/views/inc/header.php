<header class="admin-header">
            <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
                <div class="container-fluid">
                    <!-- Logo/Brand - Now first on the left -->
                    <a class="navbar-brand d-flex align-items-center" href="./home">
                        <img src="<?= BASE_URL ?>/assets/images/logo.svg" alt="" height="32" class="d-inline-block align-text-top me-2">
                        <h1 class="h4 mb-0 fw-bold text-primary">Metis</h1>
                    </a>

                    <!-- Sidebar Toggle -->
                    <button class="hamburger-menu" type="button" data-sidebar-toggle aria-label="Toggle sidebar">
                        <i class="bi bi-list"></i>
                    </button>

                    <!-- Search Bar with Alpine.js -->
                    <div class="search-container flex-grow-1 mx-4" x-data="searchComponent">
                        <div class="position-relative">
                            <input type="search" 
                                   class="form-control" 
                                   placeholder="Search... (Ctrl+K)"
                                   x-model="query"
                                   @input="search()"
                                   data-search-input
                                   aria-label="Search">
                            <i class="bi bi-search position-absolute top-50 end-0 translate-middle-y me-3"></i>
                            
                            <!-- Search Results Dropdown -->
                            <div x-show="results.length > 0" 
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 class="position-absolute top-100 start-0 w-100 bg-white border rounded-2 shadow-lg mt-1 z-3">
                                <template x-for="result in results" :key="result.title">
                                    <a :href="result.url" class="d-block px-3 py-2 text-decoration-none text-dark border-bottom">
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-file-text me-2 text-muted"></i>
                                            <span x-text="result.title"></span>
                                            <small class="ms-auto text-muted" x-text="result.type"></small>
                                        </div>
                                    </a>
                                </template>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side Icons -->
                    <div class="navbar-nav flex-row">
                        <!-- Theme Toggle with Alpine.js -->
                        <div x-data="themeSwitch">
                            <button id="theme-toggle-btn" class="btn btn-outline-secondary me-2" 
                                    type="button" 
                                    @click="toggle()"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="bottom"
                                    title="Toggle theme">
                                <i id="theme-icon-sun" class="bi bi-sun-fill" x-show="currentTheme === 'light'"></i>
                                <i id="theme-icon-moon" class="bi bi-moon-fill" x-show="currentTheme === 'dark'"></i>
                            </button>
                        </div>

                        <!-- Fullscreen Toggle (hidden on phones) -->
                        <button class="btn btn-outline-secondary me-2 d-none d-md-inline-block"
                                type="button"
                                data-fullscreen-toggle
                                data-bs-toggle="tooltip"
                                data-bs-placement="bottom"
                                title="Toggle fullscreen">
                            <i class="bi bi-arrows-fullscreen icon-hover"></i>
                        </button>

                        <!-- Notifications -->
                        <div class="dropdown me-2">
                            <button id="header-notifications-btn" class="btn btn-outline-secondary position-relative" 
                                    type="button" 
                                    data-bs-toggle="dropdown" 
                                    aria-expanded="false">
                                <i class="bi bi-bell"></i>
                                <span id="header-notifications-badge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="display: none;">0</span>
                            </button>
                            <ul id="header-notifications-menu" class="dropdown-menu dropdown-menu-end">
                                <li><h6 class="dropdown-header">Notifications</h6></li>
                                <li><div id="header-notifications-items"></div></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-center" href="./messages">Voir les messages</a></li>
                            </ul>
                        </div>

                        <!-- User Menu -->
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary d-flex align-items-center" 
                                    type="button" 
                                    data-bs-toggle="dropdown" 
                                    aria-expanded="false">
                                <i class="bi bi-person-circle"></i>
                                <span class="d-none d-md-inline"><?= $_SESSION['user_name'] ?></span>
                                <i class="bi bi-chevron-down ms-1"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profile</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Settings</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="post" action="/logout" class="m-0">
                                        <button type="submit" class="dropdown-item">
                                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <!-- Les choses dont les scripts ont besoin -->
<meta name="user-id" content="<?= htmlspecialchars($_SESSION['user_id'] ?? 0) ?>">
<meta name="base-url" content="<?= htmlspecialchars(BASE_URL) ?>">