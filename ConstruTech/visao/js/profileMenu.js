function toggleWelcomeMessage() {
    const welcomeMessage = document.getElementById('welcomeMessage');
    welcomeMessage.style.display = welcomeMessage.style.display === 'none' || welcomeMessage.style.display === '' ? 'block' : 'none';
}