(function () {
    const STORAGE_KEY = 'bs-theme';

    function getPreferredTheme() {
        const stored = localStorage.getItem(STORAGE_KEY);
        if (stored === 'light' || stored === 'dark') return stored;
        return window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
    }

    function applyTheme(theme) {
        const t = theme === 'dark' ? 'dark' : 'light';
        document.documentElement.setAttribute('data-bs-theme', t);
        try {
            localStorage.setItem(STORAGE_KEY, t);
        } catch (_) {}
        updateIcons(t);
    }

    function updateIcons(theme) {
        const sun = document.querySelector('#theme-icon-sun');
        const moon = document.querySelector('#theme-icon-moon');
        if (!sun || !moon) return;
        const isDark = theme === 'dark';
        sun.style.display = isDark ? 'none' : '';
        moon.style.display = isDark ? '' : 'none';
    }

    function toggleTheme() {
        const current = document.documentElement.getAttribute('data-bs-theme') || 'light';
        applyTheme(current === 'dark' ? 'light' : 'dark');
    }

    window.addEventListener('load', () => {
        applyTheme(getPreferredTheme());

        const btn = document.querySelector('#theme-toggle-btn');
        if (!btn) return;
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            toggleTheme();
        });
    });
})();
