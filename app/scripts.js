document.getElementById('registerForm').addEventListener('submit', function (e) {
    e.preventDefault(); // Empêche l'envoi du formulaire si des erreurs sont présentes.

    // Réinitialiser les messages d'erreur
    document.querySelectorAll('.error-message').forEach(el => el.textContent = '');

    let isValid = true;

    // Validation du nom d'utilisateur
    const username = document.getElementById('username').value.trim();
    if (username.length < 3 || username.length > 20) {
        setError('username', 'Username must be between 3 and 20 characters.');
        isValid = false;
    }

    // Validation de l'email
    const email = document.getElementById('email').value.trim();
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        setError('email', 'Please enter a valid email address.');
        isValid = false;
    }

    // Validation du mot de passe
    const password = document.getElementById('password').value.trim();
    if (password.length < 8) {
        setError('password', 'Password must be at least 8 characters long.');
        isValid = false;
    }

    // Si toutes les validations sont bonnes, soumettre le formulaire
    if (isValid) {
        alert('Form submitted successfully!');
        // Tu peux décommenter la ligne suivante pour soumettre réellement le formulaire.
        // this.submit();
    }
});

function setError(fieldId, message) {
    const field = document.getElementById(fieldId);
    const errorMessage = field.parentElement.querySelector('.error-message');
    errorMessage.textContent = message;
    errorMessage.style.color = 'red';
}