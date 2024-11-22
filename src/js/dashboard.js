document.addEventListener('DOMContentLoaded', async () => {
    const dashboardOptions = document.getElementById('dashboard-options');

    // Obtener datos del usuario desde el servidor
    const response = await fetch('php/obtener_usuario_actual.php');
    const usuario = await response.json();

    if (usuario.rol === 'profesor') {
        dashboardOptions.innerHTML = `
            <h2>Bienvenido, Profesor ${usuario.nombre}</h2>
            <ul>
                <li><a href="subir_calificaciones.html">Subir Calificaciones</a></li>
                <li><a href="usuarios.html">Gestión de Usuarios</a></li>
            </ul>
        `;
    } else if (usuario.rol === 'estudiante') {
        dashboardOptions.innerHTML = `
            <h2>Bienvenido, Estudiante ${usuario.nombre}</h2>
            <ul>
                <li><a href="ver_calificaciones.html">Ver Calificaciones</a></li>
                <li><a href="perfil.html">Mi Perfil</a></li>
            </ul>
        `;
    } else {
        dashboardOptions.innerHTML = `<p>Error: No se pudo determinar el rol del usuario.</p>`;
    }

    // Logout
    const logoutBtn = document.getElementById('logout-btn');
    logoutBtn.addEventListener('click', async () => {
        await fetch('php/logout.php');
        window.location.href = 'index.html';
    });
});
