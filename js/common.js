// js/common.js - Shared logic and utilities

/**
 * Get favorites from localStorage
 */
function getFavorites() {
    const favorites = localStorage.getItem('animeFavorites');
    return favorites ? JSON.parse(favorites) : [];
}

/**
 * Toggle favorite status of an anime
 */
function toggleFavorite(animeId) {
    let favorites = getFavorites();
    const index = favorites.indexOf(animeId);
    
    if (index > -1) {
        favorites.splice(index, 1);
    } else {
        favorites.push(animeId);
    }
    
    localStorage.setItem('animeFavorites', JSON.stringify(favorites));
    return favorites.indexOf(animeId) > -1;
}

/**
 * Check if an anime is favorited
 */
function isFavorite(animeId) {
    return getFavorites().includes(animeId);
}

/**
 * Get reviews from localStorage
 */
function getReviews() {
    const reviews = localStorage.getItem('animeReviews');
    return reviews ? JSON.parse(reviews) : [];
}

/**
 * Add a review to localStorage
 */
function addReview(review) {
    let reviews = getReviews();
    review.id = Date.now();
    review.date = new Date().toLocaleDateString('pt-BR');
    reviews.push(review);
    localStorage.setItem('animeReviews', JSON.stringify(reviews));
}

/**
 * Get reviews for a specific anime
 */
function getReviewsByAnime(animeId) {
    return getReviews().filter(review => review.animeId === animeId);
}

/**
 * Create a common navbar for all pages
 */
function createNavbar() {
    const isSubPage = window.location.pathname.includes('/pages/');
    const basePath = isSubPage ? '../' : './';
    const pagesPath = isSubPage ? 'pages/' : 'pages/';

    const navHtml = `
        <nav class="navbar">
            <div class="nav-container">
                <a href="${basePath}index.html" class="nav-logo">Anime<span>Rate</span></a>
                <ul class="nav-links">
                    <li><a href="${basePath}index.html">Início</a></li>
                    <li><a href="${isSubPage ? 'favorites.html' : 'pages/favorites.html'}">Favoritos</a></li>
                    <li><a href="${isSubPage ? 'profile.html' : 'pages/profile.html'}">Perfil</a></li>
                </ul>
                <div class="nav-mobile-btn">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </nav>
    `;
    
    document.body.insertAdjacentHTML('afterbegin', navHtml);

    // Mobile menu toggle
    const mobileBtn = document.querySelector('.nav-mobile-btn');
    const navLinks = document.querySelector('.nav-links');
    if (mobileBtn) {
        mobileBtn.addEventListener('click', () => {
            navLinks.classList.toggle('active');
            mobileBtn.classList.toggle('active');
        });
    }
}

/**
 * Get URL parameters
 */
function getUrlParam(param) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(param);
}

// Export functions for use in other scripts
window.AnimeUtils = {
    getFavorites,
    toggleFavorite,
    isFavorite,
    getReviews,
    addReview,
    getReviewsByAnime,
    createNavbar,
    getUrlParam
};
