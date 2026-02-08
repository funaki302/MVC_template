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

function getCurrentUserId() {
    const meta = document.querySelector('meta[name="user-id"]');
    const id = meta ? parseInt(meta.content || '0', 10) : 0;
    return Number.isFinite(id) ? id : 0;
}

async function fetchJsonOrThrow(url) {
    const res = await fetch(url);
    if (!res.ok) {
        const body = await res.text().catch(() => '');
        throw new Error(`HTTP ${res.status}${body ? `: ${body}` : ''}`);
    }
    return await res.json();
}

async function updateHeaderNotificationsBadge(userId) {
    const badge = document.querySelector('#header-notifications-badge');
    if (!badge) return;

    try {
        const data = await fetchJsonOrThrow(buildUrl(`/api/unread/${userId}`));
        const total = parseInt(data?.unread_total ?? 0, 10) || 0;
        badge.textContent = String(total);
        badge.style.display = total > 0 ? '' : 'none';
    } catch (e) {
        console.warn('Notifications badge error:', e);
        badge.style.display = 'none';
    }
}

async function loadHeaderNotificationsItems(userId) {
    const container = document.querySelector('#header-notifications-items');
    if (!container) return;

    container.innerHTML = '';

    try {
        const items = await fetchJsonOrThrow(buildUrl(`/api/notifications/messages/${userId}`));
        if (!Array.isArray(items) || items.length === 0) {
            container.innerHTML = '<div class="dropdown-item text-muted">Aucune notification</div>';
            return;
        }

        items.forEach((n) => {
            const convId = n.id_discussion;
            const name = n.other_user_name || 'Conversation';
            const count = parseInt(n.unread_count ?? 0, 10) || 0;

            const a = document.createElement('a');
            a.className = 'dropdown-item d-flex justify-content-between align-items-center';
            a.href = './messages';
            a.innerHTML = `
                <span>${name}</span>
                <span class="badge bg-danger rounded-pill">${count}</span>
            `;
            a.addEventListener('click', () => {
                try {
                    sessionStorage.setItem('openConversationId', String(convId));
                } catch (_) {}
            });
            container.appendChild(a);
        });
    } catch (e) {
        console.warn('Notifications items error:', e);
        container.innerHTML = '<div class="dropdown-item text-muted">Erreur chargement notifications</div>';
    }
}

function wireNotificationsDropdown(userId) {
    const btn = document.querySelector('#header-notifications-btn');
    if (!btn) return;

    btn.addEventListener('click', async () => {
        await updateHeaderNotificationsBadge(userId);
        await loadHeaderNotificationsItems(userId);
    });
}

window.addEventListener('load', async () => {
    const userId = getCurrentUserId();
    if (!userId) return;

    await updateHeaderNotificationsBadge(userId);
    wireNotificationsDropdown(userId);
});
