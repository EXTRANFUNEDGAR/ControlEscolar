document.addEventListener('DOMContentLoaded', async () => {
    const dashboardOptions = document.getElementById('dashboard-options');

    try {
        const response = await fetch('php/obtener_usuario_actual.php');

        if (!response.ok) {
            throw new Error('Sesión no válida. Por favor, inicia sesión.');
        }

        const usuario = await response.json();

        if (usuario.rol === 'profesor') {
            dashboardOptions.innerHTML = `
                <h2>Bienvenido, Profesor ${usuario.nombre}</h2>
                <ul>
                    <li><a href="subir_calificaciones.html">Subir Calificaciones</a></li>
                    <br>
                    <li><a href="usuarios.html">Gestión de Usuarios</a></li>
                </ul>
            `;
        } else if (usuario.rol === 'estudiante') {
            dashboardOptions.innerHTML = `
                <h2>Bienvenido, Estudiante ${usuario.nombre}</h2>
                <ul>
                    <li><a href="perfil.html">Mi Perfil</a></li>
                    <br>
                    <li><a href="ver_calificaciones.html">Ver Calificaciones</a></li>
                    
                    
                </ul>
            `;
        } else if (usuario.rol === 'admin') {
            dashboardOptions.innerHTML = `
                <h2>Bienvenido, Administrador ${usuario.nombre}</h2>
                <ul>
                    <li><a href="usuarios.html">Gestión de Usuarios</a></li>
                    <br>
                    <li><a href="subir_calificaciones.html">Subir Calificaciones</a></li>
                    
                </ul>
            `;
        } else {
            throw new Error('Rol de usuario desconocido.');
        }
    } catch (error) {
        alert(error.message);
        window.location.href = 'index.html'; // Redirigir al login
    }
});
