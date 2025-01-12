document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('form');
    const inputs = form.querySelectorAll('input');

    form.addEventListener('submit', (event) => {
        let isValid = true;
        let errorMessage = '';

        inputs.forEach((input) => {
            if (input.required && !isInputValid(input)) {
                isValid = false;
                errorMessage += `O campo "${input.previousElementSibling.textContent}" está inválido. Preencha corretamente.\n`;
            }
        });

        if (!isValid) {
            event.preventDefault();
            alert(errorMessage);
        }
    });

    function isInputValid(input) {
        const value = input.value.trim();
        return value !== '';
    }
});