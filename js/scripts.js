async function obtenerUsuarios() {
    const response = await fetch('php/obtener_usuarios.php');
    const usuarios = await response.json();
    const tablaUsuarios = document.getElementById('tabla-usuarios');

    usuarios.forEach(usuario => {
        const fila = document.createElement('tr');
        fila.innerHTML = `
            <td>${usuario.nombre}</td>
            <td>${usuario.email}</td>            
            <td>${usuario.carrera}</td>
            <td>${usuario.telefono}</td>
            <td>${usuario.sangre}</td>
            <td>${usuario.edad}</td>
            <td>${usuario.genero}</td>
            <td>${usuario.rol}</td>
            <td>
                <button class="btn-editar" data-id="${usuario.id}">Editar</button>
            </td>
        `;
        tablaUsuarios.appendChild(fila);
    });

    
    
    document.querySelectorAll('.btn-editar').forEach(boton => {
        boton.addEventListener('click', (e) => {
            const idUsuario = e.target.getAttribute('data-id');
            window.location.href = `editar_usuario.html?id=${idUsuario}`;
        });
    });
}
document.addEventListener('DOMContentLoaded', () => {
    if (document.getElementById('tabla-usuarios')) {
        obtenerUsuarios();
    }
});
