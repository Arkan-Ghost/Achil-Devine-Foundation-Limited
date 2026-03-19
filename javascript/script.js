// Carousel
let currentSlideIndex = 0;
const slides = document.querySelectorAll('.carousel-slide');
const indicators = document.querySelectorAll('.indicator');
let autoSlideInterval;

function showSlide(index) {
    if (index < 0) index = slides.length - 1;
    if (index >= slides.length) index = 0;

    slides.forEach(slide => slide.classList.remove('active'));
    slides[index].classList.add('active');

    indicators.forEach(indicator => indicator.classList.remove('active'));
    indicators[index].classList.add('active');

    currentSlideIndex = index;
}

function changeSlide(direction) {
    showSlide(currentSlideIndex + direction);
    resetAutoSlide();
}

function currentSlide(index) {
    showSlide(index);
    resetAutoSlide();
}

function startAutoSlide() {
    autoSlideInterval = setInterval(() => {
        showSlide(currentSlideIndex + 1);
    }, 5000);
}

function resetAutoSlide() {
    clearInterval(autoSlideInterval);
    startAutoSlide();
}

window.addEventListener('load', () => {
    startAutoSlide();
});

const hero = document.querySelector('.hero');
if (hero) {
    hero.addEventListener('mouseenter', () => {
        clearInterval(autoSlideInterval);
    });

    hero.addEventListener('mouseleave', () => {
        startAutoSlide();
    });
}

// Navbar scroll effect
window.addEventListener('scroll', function() {
    const navbar = document.getElementById('navbar');
    if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
});

// Mobile menu toggle - CORRIGÉ
const menuToggle = document.getElementById('menuToggle');
const navMenu = document.getElementById('navMenu');

if (menuToggle) {
    menuToggle.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        navMenu.classList.toggle('active');
        
        // Changer l'icône entre bars et times
        const icon = menuToggle.querySelector('i');
        if (navMenu.classList.contains('active')) {
            icon.classList.remove('fa-bars');
            icon.classList.add('fa-times');
        } else {
            icon.classList.remove('fa-times');
            icon.classList.add('fa-bars');
        }
    });
}

// Dropdown management on mobile - CORRIGÉ
const navItems = document.querySelectorAll('.nav-item');

navItems.forEach(item => {
    const link = item.querySelector('.nav-link');
    
    link.addEventListener('click', function(e) {
        if (window.innerWidth <= 768) {
            // Vérifier si cet item a un dropdown
            if (item.querySelector('.dropdown-menu')) {
                e.preventDefault(); // Empêche la navigation
                
                // Fermer les autres dropdowns
                navItems.forEach(otherItem => {
                    if (otherItem !== item) {
                        otherItem.classList.remove('active');
                    }
                });
                
                // Ouvrir/fermer le dropdown actuel
                item.classList.toggle('active');
            } else {
                // Si pas de dropdown, on peut naviguer et fermer le menu
                navMenu.classList.remove('active');
                const icon = menuToggle.querySelector('i');
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        }
    });
});

// Fermer le menu quand on clique sur un vrai lien (pas sur un dropdown)
const dropdownItems = document.querySelectorAll('.dropdown-item');
dropdownItems.forEach(item => {
    item.addEventListener('click', function() {
        if (window.innerWidth <= 768) {
            navMenu.classList.remove('active');
            const icon = menuToggle.querySelector('i');
            icon.classList.remove('fa-times');
            icon.classList.add('fa-bars');
            
            // Réinitialiser tous les dropdowns
            navItems.forEach(navItem => {
                navItem.classList.remove('active');
            });
        }
    });
});

// Fermer le menu quand on clique en dehors
document.addEventListener('click', function(e) {
    if (window.innerWidth <= 768) {
        if (!navMenu.contains(e.target) && !menuToggle.contains(e.target)) {
            navMenu.classList.remove('active');
            const icon = menuToggle.querySelector('i');
            icon.classList.remove('fa-times');
            icon.classList.add('fa-bars');
            
            // Fermer aussi tous les dropdowns
            navItems.forEach(item => {
                item.classList.remove('active');
            });
        }
    }
});

// Gestion du redimensionnement
window.addEventListener('resize', function() {
    if (window.innerWidth > 768) {
        navMenu.classList.remove('active');
        const icon = menuToggle.querySelector('i');
        icon.classList.remove('fa-times');
        icon.classList.add('fa-bars');
        navItems.forEach(item => {
            item.classList.remove('active');
        });
    }
});

