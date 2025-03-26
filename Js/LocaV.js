document.addEventListener("DOMContentLoaded", function() {
    // Fonction pour valider le formulaire d'inscription
    const inscriptionForm = document.querySelector('form[action="processus_inscription.php"]');

    if (inscriptionForm) {
        inscriptionForm.addEventListener('submit', function(event) {
            const password = inscriptionForm.querySelector('input[name="mot_passe"]').value;
            const confirmPassword = inscriptionForm.querySelector('input[name="confirm_mot_passe"]').value; // Correction ici

            if (password !== confirmPassword) {
                alert("Les mots de passe ne correspondent pas !");
                event.preventDefault(); // Empêche l'envoi du formulaire
            }
        });
    }

    // Fonction pour afficher une alerte lors de l'envoi d'un message
    const contactForm = document.querySelector('form[action="contact_process.php"]');
    if (contactForm) {
        contactForm.addEventListener('submit', function() {
            alert("Votre message a été envoyé !");
        });
    }

    // Gestion du slider d'images
    const slides = document.querySelector('.slides');
    const images = document.querySelectorAll('.slides img');
    let index = 0;

    function showNextSlide() {
        index++;
        if (index >= images.length) {
            index = 0; // Revenir au début
        }
        const offset = -index * 100; // Calculer le décalage
        slides.style.transform = `translateX(${offset}vw)`; // Appliquer le décalage
    }

    setInterval(showNextSlide, 3000); // Changer d'image toutes les 3 secondes

    // Appliquer la classe fade à l'élément body
    const body = document.body;
    body.classList.add('fade');

    // Une fois que le contenu est chargé, ajoutez la classe 'in' pour l'animation
    setTimeout(() => {
        body.classList.add('in');
    }, 100); // Délai pour permettre l'ajout de la classe

    // Gestion des liens pour l'animation de transition
    const links = document.querySelectorAll('nav ul li a');

    links.forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault(); // Empêcher le comportement par défaut du lien
            const href = this.getAttribute('href');

            // Ajoutez la classe fade pour l'animation
            body.classList.remove('in');
            body.classList.add('fade');

            // Rediriger après la fin de l'animation
            setTimeout(() => {
                window.location.href = href;
            }, 500); // Correspond à la durée de l'animation
        });
    });
});


function filterCars() {
    const marque = document.getElementById('marque').value;
    const modele = document.getElementById('modele').value;
    const annee = document.getElementById('annee').value;
    const plaque = document.getElementById('plaque').value;
    const statut = document.getElementById('statut').value;

    fetch('filter_cars.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ marque, modele, annee, plaque, statut })
    })
    .then(response => response.json())
    .then(data => {
        const carImagesDiv = document.getElementById('car-images');
        carImagesDiv.innerHTML = ''; // Effacer les images existantes

        data.forEach(car => {
            carImagesDiv.innerHTML += `
                <div class='image-box'>
                    <img src='Images/${car.image}' alt='Voiture ${car.id_voiture}'>
                    <div class='info'>
                        <p>ID: ${car.id_voiture}</p>
                        <p>Marque: ${car.marque}</p>
                        <p>Modèle: ${car.modele}</p>
                        <p>Année: ${car.annee}</p>
                        <p>Plaque: ${car.plaque}</p>
                        <p>Statut: ${car.statut}</p>
                        <p><a href='reservation.php?id=${car.id_voiture}'>Réserver</a></p>
                    </div>
                </div>
            `;
        });
    })
    .catch(error => console.error('Erreur:', error));
}

function toggleAnswer(element) {
    const answer = element.nextElementSibling; // Sélectionne la réponse suivante

    if (answer.classList.contains('show')) {
        // Si la réponse est déjà visible, on la cache
        answer.classList.remove('show');
        setTimeout(() => {
            answer.style.display = 'none'; // Masquer après l'animation
        }, 500); // Correspond à la durée de l'animation
    } else {
        answer.style.display = 'block'; // Afficher la réponse
        setTimeout(() => {
            answer.classList.add('show'); // Ajouter la classe show pour l'animation
        }, 10); // Un léger délai pour permettre l'affichage
    }
}
