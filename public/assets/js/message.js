function buildUrl(path) {
    const rawBase = (document.querySelector('meta[name="base-url"]')?.content || '').trim();
    const normalizedPath = (path || '').startsWith('/') ? path : `/${path || ''}`;

    if (!rawBase) return normalizedPath;

    try {
        if (/^https?:\/\//i.test(rawBase)) {
            const base = rawBase.replace(/\/$/, '');
            return new URL(normalizedPath.replace(/^\//, ''), `${base}/`).toString();
        }
        const basePath = rawBase.startsWith('/') ? rawBase : `/${rawBase}`;
        const fullBase = `${window.location.origin}${basePath.replace(/\/$/, '')}/`;
        return new URL(normalizedPath.replace(/^\//, ''), fullBase).toString();
    } catch (e) {
        const base = rawBase.replace(/\/$/, '');
        if (!base) return normalizedPath;
        return normalizedPath.startsWith('/') ? `${base}${normalizedPath}` : `${base}/${normalizedPath}`;
    }
}

function getSelectedConversationId() {
    const meta = document.querySelector('meta[name="idConv"]');
    const id = meta ? parseInt(meta.content || '0', 10) : 0;
    return Number.isFinite(id) ? id : 0;
}

function startPolling(userId) {
    if (window.__messagesPollingStarted) return;
    window.__messagesPollingStarted = true;

    // Poll léger: badge + liste conversations + conversation ouverte
    setInterval(async () => {
        try {
            await updateUnreadBadge(userId);

            const list = await getListConv(userId);
            loadListConv(list, userId);

            const idConv = getSelectedConversationId();
            if (idConv) {
                await refresh_Mess(idConv, userId);
                await updateUnreadBadge(userId);
            }
        } catch (e) {
            console.warn('Polling messages échoué:', e);
        }
    }, 4000);
}

function getCurrentUserId() {
    const meta = document.querySelector('meta[name="user-id"]');
    const id = meta ? parseInt(meta.content || '0', 10) : 0;
    return Number.isFinite(id) ? id : 0;
}

window.addEventListener('load', async function () {
    vider();
    try {
        const userId = getCurrentUserId();
        if (!userId) {
            throw new Error('user-id manquant');
        }
        await updateUnreadBadge(userId);
        const listCov = await getListConv(userId);
        loadListConv(listCov, userId);
    } catch (err) {
        console.error('Erreur chargement conversations:', err);
    }
});

document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.querySelector('.search');
    const newConv = document.querySelector('#newConv');
    const userId = getCurrentUserId();

    // Recherche
    if (!searchInput) {
        console.error('Input introuvable');
        return;
    }
    searchInput.addEventListener('input', async function () {
        await search(searchInput.value, userId);
    });

    // Nouvelle conversation
    if (!newConv) {
        console.error('NewConv introuvable');
        return;
    }
    newConv.addEventListener('click', async function(e){
        e.preventDefault();
        try {
            const contact = await noConversation(userId);
            loadNewConv(contact);
        } catch (error) {
            alert("Error load no conve : " +error);
        }
    });

});

async function getUnreadTotal(userId) {
    const response = await fetch(buildUrl(`/api/unread/${userId}`));
    if (!response.ok) {
        const body = await response.text().catch(() => '');
        throw new Error(`Erreur ${response.status} sur /api/unread/${userId}${body ? `: ${body}` : ''}`);
    }
    return await response.json();
}

async function updateUnreadBadge(userId) {
    const badge = document.querySelector('#menu-unread-badge');
    if (!badge) return;
    try {
        const data = await getUnreadTotal(userId);
        const total = parseInt(data?.unread_total ?? 0, 10) || 0;
        badge.textContent = String(total);
        badge.style.display = total > 0 ? '' : 'none';
    } catch (e) {
        console.warn('Impossible de charger le badge non lu:', e);
        badge.style.display = 'none';
    }
}

async function getMessages(id_conversation) {
    const response = await fetch(buildUrl(`/api/messages/${id_conversation}`));
    if (!response.ok) {
        const body = await response.text().catch(() => '');
        throw new Error(`Erreur ${response.status} sur /api/messages/${id_conversation}${body ? `: ${body}` : ''}`);
    }
    try {
        return await response.json();
    } catch (e) {
        const body = await response.text().catch(() => '');
        throw new Error(`Réponse JSON invalide sur /api/messages/${id_conversation}${body ? `: ${body}` : ''}`);
    }
}

async function getUser2(id_conversation) {
    const response = await fetch(buildUrl(`/api/user2/${id_conversation}`));

    if (!response.ok) {
        const body = await response.text().catch(() => '');
        throw new Error(`Erreur ${response.status} sur /api/user2/${id_conversation}${body ? `: ${body}` : ''}`);
    }

    try {
        return await response.json();
    } catch (e) {
        const body = await response.text().catch(() => '');
        throw new Error(`Réponse JSON invalide sur /api/user2/${id_conversation}${body ? `: ${body}` : ''}`);
    }
}

function loadmessages(message,userId) {
    // log message
    console.log(message);
    console.log(userId);

    const chatMessages = document.querySelector('.chat-messages');
    if (chatMessages) {
        chatMessages.innerHTML = '';
        message.forEach((msg) => {
            const msgElement = document.createElement('div');
            msgElement.classList.add('message');
            const isMine = (msg.id_sender == userId);
            if (isMine) {
                msgElement.classList.add('sent');
            } else {
                msgElement.classList.add('received');
            }

            // Statut "envoyé / vu" à la Facebook:
            // - 1 check: message envoyé (seen_at NULL)
            // - 2 checks: message vu (seen_at non NULL)
            // On n'affiche le statut que pour les messages envoyés par l'utilisateur courant.
            const seen = !!msg.seen_at;
            const statusIcon = isMine ? (seen ? '<i class="bi bi-check-all"></i>' : '<i class="bi bi-check"></i>') : '';
            msgElement.innerHTML = `
            <i class="bi bi-person-circle"></i>
            <div class="message-bubble">
                
                    <p x-text="message.text">${msg.contenue}</p>
              
                <div class="message-info">
                    <span class="message-time">${msg.date_envoie}</span>
                    <span class="message-status">${statusIcon}</span>
                </div>
            </div>
            `;
            chatMessages.appendChild(msgElement);
        });
    }
    
}

async function sendMessage(message, idConv, userId){
    const url = buildUrl("/api/messages/send");
    const data = {
        contenue: message,
        id_discussion: idConv,
        id_sender: userId
    };
    const options = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    };
    const send = await fetch(url, options);
    if (send.ok) {
        // console log
        console.log(message);
        console.log(idConv);
        console.log(userId);

        // rafraichir
        try {
            refresh_Mess(idConv,userId);
        } catch (err) {
            alert('Erreur chargement messages:', err);
        }
    } else{
        alert("Message non envoyé");
    }
}

function loadinput(idConv,userId, draftValue = ''){
    const chatInput = document.querySelector('.chat-input');
    chatInput.innerHTML = "";
    chatInput.innerHTML = `
    <div class="input-container">
        <div class="input-actions">
            <button class="btn" @click="toggleAttachment()" title="Attach file">
                <i class="bi bi-paperclip"></i>
            </button>
        </div>
        <div class="message-input">
            <textarea class="form-control"
                      placeholder="Type a message..." 
                      rows="1"
                      x-model="newMessage"
                      @keydown.enter.prevent="sendMessage()"
                      @input="handleTyping(); autoResize($event)"
                      style="resize: none;"></textarea>
        </div>
        <div class="input-actions">
            <button class="btn" @click="toggleEmojiPicker()" title="Add emoji">
                <i class="bi bi-emoji-smile"></i>
            </button>
        </div>
    </div>
    <div class="emoji-picker" x-show="showEmojiPicker" x-transition>
        <div class="emoji-grid">
            <template x-for="emoji in emojis" :key="emoji">
                <button class="emoji-btn" @click="addEmoji(emoji)" x-text="emoji"></button>
            </template>
        </div>
    </div>
    `;

    const bouton = document.createElement('button');
    bouton.classList = 'btn btn-primary';
    bouton.id = 'send';
    bouton.innerHTML = '<i class="bi bi-send"></i>';
    bouton.addEventListener('click', async function (e) {
        e.preventDefault();
        sendMessage(document.querySelector('.message-input textarea').value, idConv, userId);
    });
    
    // Ajouter le bouton à la fin du conteneur input-actions
    const inputAction = document.querySelector('.input-actions');
    if (inputAction) {
        inputAction.appendChild(bouton);
    }

    // Restaurer le brouillon en cours (utile avec le polling)
    const textarea = document.querySelector('.message-input textarea');
    if (textarea && typeof draftValue === 'string' && draftValue.length > 0) {
        textarea.value = draftValue;
    }
}

function loadheader(user2_name, user2_status, idConv){
    const header = document.querySelector('.chat-header');
    header.innerHTML = "";
    let status = 'Deconnecter';
    let classe = '';

    if (user2_status == 'active') {
        status = 'En ligne';
        classe = 'online-indicator';
    }
    header.innerHTML = `
        <div class="chat-info">
            <div class="chat-avatar">
                <img src="/assets/images/avatar-placeholder.svg" alt="User">
            </div>
            <div class="chat-details">
                <h5>${user2_name}</h5>
                <div class="${classe}" title="${status}"></div>
            </div>
            <meta name="idConv" content="${idConv}">
        </div>
        <div class="chat-actions">
            <button class="btn" @click="videoCall()" title="Video Call">
                <i class="bi bi-camera-video"></i>
            </button>
            <button class="btn" @click="voiceCall()" title="Voice Call">
                <i class="bi bi-telephone"></i>
            </button>
            <div class="dropdown">
                <button class="btn dropdown-toggle" data-bs-toggle="dropdown" title="More Options">
                    <i class="bi bi-three-dots-vertical"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#" @click.prevent="muteConversation()">
                        <i class="bi bi-bell-slash me-2"></i>Mute notifications
                    </a></li>
                    <li><a class="dropdown-item" href="#" @click.prevent="archiveConversation()">
                        <i class="bi bi-archive me-2"></i>Archive chat
                    </a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger" id="deleteChat" href="#" @click.prevent="deleteConversation()">
                        <i class="bi bi-trash me-2"></i>Delete chat
                    </a></li>
                </ul>
            </div>
        </div>
    `;

    const deleteChat = document.querySelector('#deleteChat');
    deleteChat.addEventListener('click', function(e){
        e.preventDefault();
        console.log("Delete Conversation ID = "+idConv);
    });
}

async function markConversationSeen(idConv, userId) {
    const url = buildUrl("/api/messages/seen");
    const data = {
        id_discussion: idConv,
        viewer_id: userId
    };
    const options = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    };
    const res = await fetch(url, options);
    if (!res.ok) {
        const body = await res.text().catch(() => '');
        throw new Error(`Erreur ${res.status} sur /api/messages/seen${body ? `: ${body}` : ''}`);
    }
    return await res.json().catch(() => ({}));
}

async function refresh_Mess(idConv,userId){
    // Quand l'utilisateur ouvre une conversation, on marque comme "vu"
    // tous les messages qu'il a reçus dans cette conversation.
    try {
        await markConversationSeen(idConv, userId);
    } catch (e) {
        console.warn('Impossible de marquer les messages comme vus:', e);
    }

    // Préserver ce que l'utilisateur est en train de taper (polling)
    const existingTextarea = document.querySelector('.message-input textarea');
    const draftValue = existingTextarea ? existingTextarea.value : '';

    const messages = await getMessages(idConv);
    const conversation = await getUser2(idConv);
    if (!conversation || typeof conversation !== 'object') {
        console.error('refresh_Mess: conversation invalide (null) pour idConv=', idConv, conversation);
        const header = document.querySelector('.chat-header');
        if (header) {
            header.innerHTML = '<div class="chat-info"><div class="chat-details"><h5>Conversation</h5><p class="text-muted mb-0">Impossible de charger les infos</p></div></div>';
        }
        loadmessages(messages, userId);
        loadinput(idConv,userId, draftValue);
        return;
    }
    if (conversation.id_user1 == userId) {
        loadheader(conversation.user2_name, conversation.user2_status, idConv);
    } else {
        loadheader(conversation.user1_name, conversation.user1_status, idConv);
    }
    loadmessages(messages, userId);
    loadinput(idConv,userId, draftValue);
}

async function search(input,userId){
    const url = buildUrl("/api/recherche");
    const trimmed = (input || '').trim();
    if (!trimmed) {
        const listCov = await getListConv(userId);
        loadListConv(listCov, userId);
        return;
    }
    const data = {
        id_user: userId,
        input: trimmed
    };
    const options = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    };
    const result = await fetch(url, options);
    if (!result.ok) {
        throw new Error(`Erreur recherche: ${result.status}`);
    }
    const listCov = await result.json();
    loadListConv(Array.isArray(listCov) ? listCov : (listCov ? [listCov] : []), userId);
}

function loadListConv(listCov,userId){
    const convList = document.querySelector('.conversations-list');
    if (!convList) return;
    convList.innerHTML = '';
    if (Array.isArray(listCov) && listCov.length > 0) {
        listCov.forEach((conv) => {
            const idConv = conv.id_discussion;
            const a = document.createElement('a');
            a.className = 'conversation-item';
            a.href = '#';
            a.dataset.conversationId = String(idConv);
            a.dataset.userId = String(userId);

            const convName = conv.name || 'Conversation';
            const convTitle = conv.title || 'Discussion directe';
            let status = 'Deconnecter';
            let classe = '';
            const unreadCount = parseInt(conv.unread_count ?? 0, 10) || 0;
            const preview = (conv.last_message ?? '').toString();
            const previewText = preview.length > 60 ? (preview.slice(0, 60) + '…') : preview;

            if (conv.status == 'active') {
                status = 'En ligne';
                classe = 'online-indicator';
            }

            a.innerHTML = `
                <div class="conversation-avatar">
                    <div class="avatar-placeholder">
                        <i class="bi bi-person-circle"></i>
                    </div>
                    <div class="${classe}" title="${status}"></div>
                </div>
                <div class="conversation-info">
                    <div class="conversation-header">
                        <h6 class="conversation-name"></h6>
                    </div>
                    <p class="conversation-preview">
                        <span class="message-preview"></span>
                    </p>
                    <div class="conversation-footer">
                        <span class="conversation-type"></span>
                        <span class="unread-badge" style="display: none;">0</span>
                    </div>
                </div>
            `;

            a.querySelector('.conversation-name').textContent = convName;
            a.querySelector('.conversation-type').textContent = convTitle;
            a.querySelector('.message-preview').textContent = previewText || 'Cliquez pour voir la conversation';
            const unreadBadge = a.querySelector('.unread-badge');
            if (unreadBadge) {
                unreadBadge.textContent = String(unreadCount);
                unreadBadge.style.display = unreadCount > 0 ? '' : 'none';
            }

            a.addEventListener('click', async function (e) {
                e.preventDefault();
                try {
                    await refresh_Mess(idConv, userId);
                    await updateUnreadBadge(userId);
                } catch (err) {
                    console.error('Erreur chargement messages:', err);
                }
            });

            convList.appendChild(a);
        });
    } else {
        convList.innerHTML = `
        <div class="empty-conversations">
            <i class="bi bi-chat-dots"></i>
            <h6>Aucune conversation</h6>
            <p>Commencez une nouvelle conversation pour discuter avec vos contacts</p>
            <button class="btn btn-primary btn-sm mt-3" id="newConv" onclick="newConversation()">
                <i class="bi bi-plus-lg me-2"></i>Nouvelle conversation
            </button>
        </div>
        `;

        const btn_newConv = convList.querySelector('#newConv');
        btn_newConv.addEventListener('click', async function(e){
            e.preventDefault();
            try {
                const contact = await noConversation(userId);
                loadNewConv(contact);
            } catch (error) {
                alert("Error load no conve : " +error);
            }
        });
    }
}

async function getListConv(userId){
    const response = await fetch(buildUrl(`/api/conversations/${userId}`));

    if (!response.ok) {
        const body = await response.text().catch(() => '');
        throw new Error(`Erreur ${response.status} sur /api/conversations/${userId}${body ? `: ${body}` : ''}`);
    }

    try {
        return await response.json();
    } catch (e) {
        const body = await response.text().catch(() => '');
        throw new Error(`Réponse JSON invalide sur /api/conversations/${userId}${body ? `: ${body}` : ''}`);
    }
}

async function addConversation(userId, user2, titre){
    const url = buildUrl("/api/newConversation");
    const data = {
        title: titre,
        id_user1: userId,
        id_user2: user2
    };
    const options = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    };
    const send = await fetch(url, options);
    if (send.ok) {
        // console log
        console.log("User actuel = "+userId);
        console.log("User2 = "+user2);
        console.log("Titre = "+titre);

        // rafraichir
        try {
            // liste des conversations
            const listCov = await getListConv(userId);
            loadListConv(listCov, userId);

            // liste de new contact
            const contact = await noConversation(userId);
            loadNewConv(contact);
        } catch (err) {
            console.error('Erreur chargement list conversation:', err);
            alert('Erreur chargement list conversation: ' + (err?.message || String(err)));
        }
    } else{
        alert("Add new conversation error");
    }
}

async function noConversation(userId) {
    const response = await fetch(buildUrl(`/api/noConv/${userId}`));
    if (!response.ok) {
        throw new Error("Erreur noConversation " + response.status);
    }

    const data = await response.json();
    return data;
}

function loadNewConv(newContact){
    const chatMessages = document.querySelector('.chat-messages');
    vider();

    if (!chatMessages) {
        console.error('loadNewConv: .chat-messages introuvable');
        return;
    }
    chatMessages.innerHTML = "";

    const userId = getCurrentUserId();

    const grand_div = document.createElement('div');
    grand_div.classList.add('newConv');

    const contacts = Array.isArray(newContact) ? newContact : (newContact ? [newContact] : []);
    if (contacts.length === 0) {
        const empty = document.createElement('div');
        empty.className = 'newConv-empty text-muted';
        empty.textContent = 'Aucun contact disponible';
        grand_div.appendChild(empty);
        chatMessages.appendChild(grand_div);
        return grand_div;
    }

    contacts.forEach(person => {
        const div = document.createElement('div');
        div.classList.add('personCard');

        const safeName = person?.name ?? '';
        const safeEmail = person?.email ?? '';
        const safePhone = person?.phone ?? '';

        div.innerHTML = `
            <div class="personCard-left">
                <div class="personCard-avatar">
                    <div class="avatar-placeholder">
                        <i class="bi bi-person-circle"></i>
                    </div>
                </div>
                <div class="personCard-meta">
                    <div class="personCard-name"></div>
                    <div class="personCard-sub text-muted small"></div>
                </div>
            </div>
            <div class="personCard-right">
                <input type="text" class="form-control form-control-sm" name="title" placeholder="Titre">
                <button type="button" class="btn btn-primary btn-sm">Ajouter</button>
            </div>
        `;

        div.querySelector('.personCard-name').textContent = safeName;
        div.querySelector('.personCard-sub').textContent = `${safeEmail}${safePhone ? ' · ' + safePhone : ''}`;

        const btn_ajouter = div.querySelector('button');
        btn_ajouter.addEventListener('click', function (e) {
            e.preventDefault();

            const input = div.querySelector('input');
            addConversation(userId, person.id_user, input.value);
        });

        grand_div.appendChild(div);
    });

    chatMessages.appendChild(grand_div);
    return grand_div;
}

function vider() {
    const chatMessages = document.querySelector('.chat-messages');
    const header = document.querySelector('.chat-header');
    const input = document.querySelector('.chat-input');
    chatMessages.innerHTML = "";
    header.innerHTML = "";
    input.innerHTML = "";
}

