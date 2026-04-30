// ============================================
//  FONCTIONS COMMUNES À TOUTES LES PAGES
// ============================================

// --- Effet de scroll sur la navbar ---
window.addEventListener('scroll', function() {
    const navbar = document.getElementById('navbar');
    if (navbar) {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    }
});

// --- Menu mobile (toggle) ---
document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.getElementById('menuToggle');
    const navMenu = document.getElementById('navMenu');

    if (menuToggle && navMenu) {
        menuToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            navMenu.classList.toggle('active');
        });
    }

    // Fermer le menu quand on clique sur un lien
    const navLinks = document.querySelectorAll('.nav-link, .dropdown-item');
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            if (window.innerWidth <= 768 && navMenu) {
                navMenu.classList.remove('active');
            }
        });
    });

    // Gestion des dropdowns sur mobile (clic au lieu de hover)
    const navItems = document.querySelectorAll('.nav-item');
    navItems.forEach(item => {
        const link = item.querySelector('.nav-link');
        if (link) {
            link.addEventListener('click', function(e) {
                if (window.innerWidth <= 768 && item.querySelector('.dropdown-menu')) {
                    e.preventDefault();
                    // Fermer les autres dropdowns
                    navItems.forEach(other => {
                        if (other !== item) other.classList.remove('active');
                    });
                    item.classList.toggle('active');
                }
            });
        }
    });

    // Fermer le menu en cliquant en dehors
    document.addEventListener('click', function(e) {
        if (window.innerWidth <= 768 && navMenu && menuToggle) {
            if (!navMenu.contains(e.target) && !menuToggle.contains(e.target)) {
                navMenu.classList.remove('active');
                navItems.forEach(item => item.classList.remove('active'));
            }
        }
    });

    // Réinitialiser sur redimensionnement
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768 && navMenu) {
            navMenu.classList.remove('active');
            navItems.forEach(item => item.classList.remove('active'));
        }
    });
});

// --- Carrousel de la page d'accueil (si présent) ---
let slideIndex = 0;
let autoSlideInterval;

function showSlide(index) {
    const slides = document.querySelectorAll('.carousel-slide');
    const indicators = document.querySelectorAll('.indicator');
    if (!slides.length) return;

    if (index >= slides.length) slideIndex = 0;
    if (index < 0) slideIndex = slides.length - 1;

    slides.forEach((slide, i) => {
        slide.classList.remove('active');
        if (indicators[i]) indicators[i].classList.remove('active');
    });
    slides[slideIndex].classList.add('active');
    if (indicators[slideIndex]) indicators[slideIndex].classList.add('active');
}

function changeSlide(direction) {
    clearInterval(autoSlideInterval);
    slideIndex += direction;
    showSlide(slideIndex);
    startAutoSlide();
}

function currentSlide(index) {
    clearInterval(autoSlideInterval);
    slideIndex = index;
    showSlide(slideIndex);
    startAutoSlide();
}

function startAutoSlide() {
    if (document.querySelector('.carousel-slide')) {
        autoSlideInterval = setInterval(() => {
            slideIndex++;
            showSlide(slideIndex);
        }, 5000);
    }
}

// Initialisation du carrousel si présent
document.addEventListener('DOMContentLoaded', function() {
    if (document.querySelector('.carousel-slide')) {
        showSlide(0);
        startAutoSlide();
    }
});

// --- Animation de défilement (scroll reveal) pour certaines pages ---
function handleScrollAnimation() {
    const revealElements = document.querySelectorAll('.scroll-reveal');
    if (revealElements.length) {
        const elementInView = (el, offset = 100) => {
            const elementTop = el.getBoundingClientRect().top;
            return elementTop <= (window.innerHeight - offset);
        };
        revealElements.forEach(el => {
            if (elementInView(el, 100)) {
                el.classList.add('revealed');
            }
        });
    }
}
window.addEventListener('scroll', handleScrollAnimation);
document.addEventListener('DOMContentLoaded', () => setTimeout(handleScrollAnimation, 100));