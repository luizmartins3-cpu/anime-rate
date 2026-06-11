// js/profile.js - Profile page logic

document.addEventListener('DOMContentLoaded', () => {
    // Check Auth
    AnimeAuth.requireAuth();

    // Initialize Navbar
    AnimeUtils.createNavbar();

    const countFavs = document.getElementById('count-favorites');
    const countReviews = document.getElementById('count-reviews');
    const userRank = document.getElementById('user-rank');
    const reviewsList = document.getElementById('user-reviews-list');
    
    // Auth info
    const currentUser = AnimeAuth.getCurrentUser();
    const profileName = document.querySelector('.profile-info h1');
    const profileMeta = document.querySelector('.profile-info p');
    const avatarContainer = document.getElementById('profile-avatar-container');
    
    // UI Elements for Avatar Modal
    const modal = document.getElementById('avatar-modal');
    const openModalBtn = document.getElementById('open-avatar-modal');
    const closeModalBtn = document.getElementById('close-avatar-modal');
    const saveAvatarBtn = document.getElementById('save-avatar-btn');
    const avatarGrid = document.getElementById('avatar-options-grid');
    
    let selectedAvatarUrl = currentUser ? currentUser.profileImage : null;
    const basePath = '../';

    /**
     * Update Profile Header with User Data
     */
    function updateProfileHeader() {
        if (currentUser) {
            profileName.textContent = currentUser.name;
            profileMeta.innerHTML = `${currentUser.email} <br> <span style="font-size: 0.8rem; opacity: 0.7;">Membro desde ${new Date(currentUser.createdAt).getFullYear()}</span>`;
            
            // Set Avatar
            if (currentUser.profileImage) {
                const fullImageUrl = currentUser.profileImage.startsWith('http') ? currentUser.profileImage : basePath + currentUser.profileImage;
                avatarContainer.innerHTML = `
                    <img src="${fullImageUrl}" alt="Profile Avatar">
                    <button class="edit-avatar-btn" id="open-avatar-modal">Alterar Foto</button>
                `;
            } else {
                avatarContainer.innerHTML = `
                    <i class="fas fa-user"></i>
                    <button class="edit-avatar-btn" id="open-avatar-modal">Alterar Foto</button>
                `;
            }

            // Re-attach event listener to the new button
            document.getElementById('open-avatar-modal').addEventListener('click', openAvatarModal);
        }
    }

    updateProfileHeader();

    /**
     * Modal Logic
     */
    function openAvatarModal() {
        modal.classList.add('active');
        renderAvatarOptions();
    }

    function closeAvatarModal() {
        modal.classList.remove('active');
    }

    function renderAvatarOptions() {
        avatarGrid.innerHTML = '';
        profileAvatars.forEach(avatar => {
            const isSelected = selectedAvatarUrl === avatar.url;
            const fullUrl = avatar.url.startsWith('http') ? avatar.url : basePath + avatar.url;
            const avatarHtml = `
                <div class="avatar-option ${isSelected ? 'selected' : ''}" data-url="${avatar.url}">
                    <img src="${fullUrl}" alt="${avatar.name}">
                </div>
            `;
            avatarGrid.insertAdjacentHTML('beforeend', avatarHtml);
        });

        // Add event listeners to options
        document.querySelectorAll('.avatar-option').forEach(option => {
            option.addEventListener('click', () => {
                document.querySelectorAll('.avatar-option').forEach(opt => opt.classList.remove('selected'));
                option.classList.add('selected');
                selectedAvatarUrl = option.dataset.url;
            });
        });
    }

    saveAvatarBtn.addEventListener('click', () => {
        if (currentUser && selectedAvatarUrl) {
            // Update current user object
            currentUser.profileImage = selectedAvatarUrl;
            
            // Update in localStorage
            localStorage.setItem('animeCurrentUser', JSON.stringify(currentUser));
            
            // Update all users list to persist the change
            const allUsers = AnimeAuth.getUsers();
            const userIndex = allUsers.findIndex(u => u.id === currentUser.id);
            if (userIndex !== -1) {
                allUsers[userIndex].profileImage = selectedAvatarUrl;
                localStorage.setItem('animeUsers', JSON.stringify(allUsers));
            }

            updateProfileHeader();
            closeAvatarModal();
            
            // Notify user
            alert('Foto de perfil atualizada com sucesso!');
            
            // Reload page to update navbar (or we could update navbar manually)
            window.location.reload();
        }
    });

    openModalBtn.addEventListener('click', openAvatarModal);
    closeModalBtn.addEventListener('click', closeAvatarModal);
    
    // Close modal on outside click
    window.addEventListener('click', (e) => {
        if (e.target === modal) closeAvatarModal();
    });

    const favorites = AnimeUtils.getFavorites();
    const reviews = AnimeUtils.getReviews();

    // Update stats
    countFavs.textContent = favorites.length;
    countReviews.textContent = reviews.length;

    // Update Rank
    if (reviews.length > 20) {
        userRank.textContent = 'Mestre dos Animes';
    } else if (reviews.length > 10) {
        userRank.textContent = 'Veterano';
    } else if (reviews.length > 5) {
        userRank.textContent = 'Apreciador';
    } else {
        userRank.textContent = 'Iniciante';
    }

    // Render Recent Reviews
    if (reviews.length === 0) {
        reviewsList.innerHTML = '<p style="color: var(--text-muted); text-align: center;">Você ainda não fez nenhuma avaliação.</p>';
    } else {
        // Show last 5 reviews
        const recentReviews = [...reviews].reverse().slice(0, 5);
        
        recentReviews.forEach(review => {
            const anime = animeData.find(a => a.id === review.animeId);
            const reviewHtml = `
                <div class="review-card fade-in">
                    <div class="review-meta">
                        <span class="review-user" style="color: var(--text-light);">${anime ? anime.name : 'Anime Desconhecido'}</span>
                        <span class="review-date">${review.date}</span>
                    </div>
                    <div class="stars" style="margin-bottom: 0.5rem;">
                        ${Array(5).fill(0).map((_, i) => `<i class="${i < review.stars ? 'fas' : 'far'} fa-star"></i>`).join('')}
                    </div>
                    <p class="review-text">${review.comment}</p>
                    <a href="details.html?id=${review.animeId}" class="btn btn-outline" style="margin-top: 1rem; padding: 0.4rem 1rem; font-size: 0.8rem;">Ver Anime</a>
                </div>
            `;
            reviewsList.insertAdjacentHTML('beforeend', reviewHtml);
        });
    }
});
