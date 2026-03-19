// Forms JavaScript

document.addEventListener('DOMContentLoaded', function() {
    console.log('Forms.js loaded'); // Pour vérifier que le fichier est chargé
    
    // Gestion des boutons de montant (donate.html)
    const amountBtns = document.querySelectorAll('.amount-btn');
    const customAmount = document.getElementById('custom_amount');
    const newsletterForm = document.getElementById('newsletterForm');

    // NE PAS remettre un autre DOMContentLoaded ici !
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            // Ne pas empêcher la soumission - laissez le formulaire se soumettre normalement
            console.log('Newsletter form submitting...');
            // Le formulaire va recharger la page et PHP gérera la redirection
        });
    }
    
    // Gestion des boutons de montant
    if (amountBtns.length) {
        amountBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                amountBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                const amount = this.getAttribute('data-amount');
                if (customAmount) {
                    customAmount.value = amount;
                }
            });
        });
    }
    
    if (customAmount) {
        customAmount.addEventListener('input', function() {
            amountBtns.forEach(b => b.classList.remove('active'));
        });
    }
    
    // Gestion des options Get Involved
    const advocateOption = document.getElementById('advocateOption');
    const fundraiseOption = document.getElementById('fundraiseOption');
    const otherOption = document.getElementById('otherOption');
    const involvementForm = document.getElementById('involvementForm');
    const interestArea = document.getElementById('interest_area');
    
    if (advocateOption) {
        advocateOption.addEventListener('click', function(e) {
            e.preventDefault();
            if (interestArea) interestArea.value = 'advocate';
            if (involvementForm) involvementForm.style.display = 'block';
            window.scrollTo({
                top: involvementForm.offsetTop - 100,
                behavior: 'smooth'
            });
        });
    }
    
    if (fundraiseOption) {
        fundraiseOption.addEventListener('click', function(e) {
            e.preventDefault();
            if (interestArea) interestArea.value = 'fundraise';
            if (involvementForm) involvementForm.style.display = 'block';
            window.scrollTo({
                top: involvementForm.offsetTop - 100,
                behavior: 'smooth'
            });
        });
    }
    
    if (otherOption) {
        otherOption.addEventListener('click', function(e) {
            e.preventDefault();
            if (interestArea) interestArea.value = 'other';
            if (involvementForm) involvementForm.style.display = 'block';
            window.scrollTo({
                top: involvementForm.offsetTop - 100,
                behavior: 'smooth'
            });
        });
    }
});