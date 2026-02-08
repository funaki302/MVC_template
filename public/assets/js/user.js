function buildUrl(path) {
    const baseUrl = (document.querySelector('meta[name="base-url"]')?.content || '').replace(/\/$/, '');
    if (!baseUrl) return path;
    if (path.startsWith('/')) return `${baseUrl}${path}`;
    return `${baseUrl}/${path}`;
}

function getCurrentUserId() {
    const meta = document.querySelector('meta[name="user-id"]');
    const id = meta ? parseInt(meta.content || '0', 10) : 0;
    return Number.isFinite(id) ? id : 0;
}

window.addEventListener('load', async function () {
    console.log("Afficher les users !!!");
    try {
        const userId = getCurrentUserId();
        if (!userId) {
            throw new Error('user-id manquant');
        }
        const Users = await getAllUsers();
        loadTable(Users);
    } catch (err) {
        console.error('Erreur chargement des Users:', err);
    }
});

function loadTable(users){
    const tbody = document.querySelector('tbody');
    if (!tbody) {
        console.error('loadTable: tbody introuvable');
        return;
    }
    tbody.innerHTML = "";

    users.forEach(user => {
        const template = document.createElement('template');
        template.innerHTML = `
            <tr :class="{ 'selected': selectedUsers.includes(${user.id}) }">
                <td>
                    <input type="checkbox" 
                           class="form-check-input user-select-checkbox" 
                           :value="${user.id}"
                           x-model="selectedUsers">
                </td>
                <td>
                    <div class="d-flex align-items-center">
                        <img :src="user.avatar" 
                             class="rounded-circle me-2" 
                             width="32" 
                             height="32"
                             :alt="${user.name}">
                        <div>
                            <div class="fw-medium" x-text="${user.name}"></div>
                            <small class="text-muted" x-text="'ID: ' + ${user.id}"></small>
                        </div>
                    </div>
                </td>
                <td x-text="${user.email}"></td>
                <td>
                    <span class="badge" 
                          :class="{
                              'bg-danger': ${user.role} === 'admin',
                              'bg-primary': ${user.role} === 'user', 
                              'bg-warning': ${user.role} === 'moderator'
                          }"
                          x-text="${user.role}"></span>
                </td>
                <td>
                    <span class="badge" 
                          :class="{
                              'bg-success': ${user.status} === 'active',
                              'bg-secondary': ${user.status} === 'inactive',
                              'bg-warning': ${user.status} === 'pending'
                          }"
                          x-text="${user.status}"></span>
                </td>
                <td x-text="user.lastActive"></td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" 
                                type="button" 
                                data-bs-toggle="dropdown">
                            <i class="bi bi-three-dots"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#" @click="editUser(${user})">
                                <i class="bi bi-pencil me-2"></i>Edit
                            </a></li>
                            <li><a class="dropdown-item" href="#" @click="viewUser(${user})">
                                <i class="bi bi-eye me-2"></i>View Profile
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="#" @click="deleteUser(${user})">
                                <i class="bi bi-trash me-2"></i>Delete
                            </a></li>
                        </ul>
                    </div>
                </td>
            </tr>
        `;

        tbody.appendChild(template);
    });

}

async function getAllUsers() {
    const response = await fetch(buildUrl(`/api/AllUsers`));

    if (!response.ok) {
        throw new Error("Erreur " + response.status);
    }

    const data = await response.json();
    return data;
}