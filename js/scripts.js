// scripts.js

// Obtener usuarios de la base de datos y mostrarlos en una tabla
async function obtenerUsuarios() {
    const response = await fetch('php/obtener_usuarios.php');
    const usuarios = await response.json();
    const tablaUsuarios = document.getElementById('tabla-usuarios');

    usuarios.forEach(usuario => {
        const fila = document.createElement('tr');
        fila.innerHTML = `
            <td>${usuario.nombre}</td>
            <td>${usuario.email}</td>
            <td>${usuario.rol}</td>
        `;
        tablaUsuarios.appendChild(fila);
    });
}

// Ejecutar la función obtenerUsuarios si existe la tabla en la página
document.addEventListener('DOMContentLoaded', () => {
    if (document.getElementById('tabla-usuarios')) {
        obtenerUsuarios();
    }
});
