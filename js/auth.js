// js/auth.js - Authentication logic using localStorage

const Auth = {
    /**
     * Get all registered users from localStorage
     */
    getUsers: function() {
        const users = localStorage.getItem('animeUsers');
        return users ? JSON.parse(users) : [];
    },

    /**
     * Register a new user
     */
    register: function(name, email, password) {
        let users = this.getUsers();
        
        // Check if user already exists
        if (users.find(u => u.email === email)) {
            return { success: false, message: 'Este e-mail já está cadastrado.' };
        }

        const newUser = {
            id: Date.now(),
            name: name,
            email: email,
            password: password, // In a real app, this should be hashed
            createdAt: new Date().toISOString()
        };

        users.push(newUser);
        localStorage.setItem('animeUsers', JSON.stringify(users));
        return { success: true, message: 'Cadastro realizado com sucesso!' };
    },

    /**
     * Login a user
     */
    login: function(email, password) {
        const users = this.getUsers();
        const user = users.find(u => u.email === email && u.password === password);

        if (user) {
            // Save current session (exclude password for security)
            const sessionUser = { ...user };
            delete sessionUser.password;
            localStorage.setItem('animeCurrentUser', JSON.stringify(sessionUser));
            return { success: true, user: sessionUser };
        }

        return { success: false, message: 'E-mail ou senha incorretos.' };
    },

    /**
     * Logout the current user
     */
    logout: function() {
        localStorage.removeItem('animeCurrentUser');
        window.location.reload();
    },

    /**
     * Get the currently logged in user
     */
    getCurrentUser: function() {
        const user = localStorage.getItem('animeCurrentUser');
        return user ? JSON.parse(user) : null;
    },

    /**
     * Check if a user is logged in
     */
    isLoggedIn: function() {
        return !!this.getCurrentUser();
    },

    /**
     * Protect a page - redirect to login if not authenticated
     */
    requireAuth: function() {
        if (!this.isLoggedIn()) {
            const isSubPage = window.location.pathname.includes('/pages/');
            const loginPath = isSubPage ? 'login.html' : 'pages/login.html';
            window.location.href = loginPath;
        }
    }
};

// Export to window
window.AnimeAuth = Auth;
