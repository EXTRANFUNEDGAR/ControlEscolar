// login.js

document.getElementById('loginForm').addEventListener('submit', function(event) {
    // Mostrar la animación de carga
    document.getElementById('loader').style.display = 'block';

    // Prevenir el comportamiento por defecto del formulario
    event.preventDefault();

    // Simular un retraso (esto se puede reemplazar con una llamada AJAX real)
    setTimeout(function() {
        // Obtener los datos del formulario
        const email = document.querySelector('input[name="email"]').value;
        const password = document.querySelector('input[name="password"]').value;

        // Aquí iría la lógica para procesar el login, por ejemplo, con AJAX
        // Este es solo un ejemplo para mostrar la animación.

        fetch('php/login.php', {
            method: 'POST',
            body: JSON.stringify({ email, password }),
            headers: { 'Content-Type': 'application/json' },
        })
        .then(response => response.json())
        .then(data => {
            // Ocultar la animación de carga cuando se recibe la respuesta
            document.getElementById('loader').style.display = 'none';

            if (data.success) {
                // Redirigir al dashboard o a la página de inicio
                window.location.href = 'dashboard.html';
            } else {
                // Mostrar un mensaje de error si el login falla
                alert(data.message);
            }
        })
        .catch(error => {
            document.getElementById('loader').style.display = 'none';
            alert('Error de conexión. Inténtalo de nuevo.');
        });
    }, 2000); // Simula un retraso de 2 segundos antes de hacer la solicitud
});
