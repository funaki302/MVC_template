<!-- En tete -->
<?php include __DIR__ . "/inc/entete.php"; ?>
<body data-page="messages" class="messages-page">
    <!-- Admin App Container -->
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
                <div class="container-fluid p-4 p-lg-4">
                    
                    <!-- Page Header -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h1 class="h3 mb-0">Messages</h1>
                            <p class="text-muted mb-0">Centre de communication</p>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-outline-secondary d-lg-none" @click="toggleSidebar()">
                                <i class="bi bi-list me-2"></i>Conversations
                            </button>
                            <button type="button" class="btn btn-outline-secondary" @click="markAllRead()">
                                <i class="bi bi-check-all me-2"></i>Mark All Read
                            </button>
                            <button type="button" class="btn btn-primary" @click="newConversation()">
                                <i class="bi bi-plus-lg me-2"></i>New Message
                            </button>
                        </div>
                    </div>

                    <!-- Messages Container -->
                    <div x-data="messagesComponent" x-init="init()" class="messages-container">
                        <div class="messages-layout">
                            
                            <!-- Conversations Sidebar -->
                            <div class="messages-sidebar" :class="{ 'mobile-show': sidebarVisible }">
                                <!-- Sidebar Header -->
                                <div class="messages-header">
                                    <h5 class="header-title mb-0">Messages</h5>
                                    <div class="d-flex gap-2 mt-3">
                                        <div class="search-container flex-grow-1">
                                            <input type="search" 
                                                   class="form-control search" 
                                                   placeholder="Search conversations..."
                                                   x-model="searchQuery">
                                            <i class="bi bi-search search-icon"></i>
                                        </div>
                                        <button class="btn btn-primary btn-sm" id="newConv" title="New Message">
                                            <i class="bi bi-plus-lg"></i>
                                        </button>
                                    </div>
                                </div>
                                
                                <!-- Conversations List -->
                                <div class="conversations-list">
                                </div>
                            </div>

                            <!-- Chat Area -->
                            <div class="chat-area">
                                <!-- Active Chat -->
                                <div class="active-chat" x-show="selectedConversation">
                                    <!-- Chat Header -->
                                    <div class="chat-header">
                                    </div>

                                    <!-- Messages -->
                                    <div class="chat-messages" id="chatMessages">

                                    </div>

                                    <!-- Message Input -->
                                    <div class="chat-input">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </main>

            <!-- Footer -->
			<?php include __DIR__ . "/inc/footer.php"; ?>

            <!-- Scripts -->
            <script nonce="<?= htmlspecialchars($cspNonce) ?>" src="<?= $baseUrl ?>/assets/js/message.js"></script>
                                    
        </div> 
	</div>

</body>
</html>