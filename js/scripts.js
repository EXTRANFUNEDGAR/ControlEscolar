async function obtenerUsuarios() {
    const response = await fetch('php/obtener_usuarios.php');
    const usuarios = await response.json();
    const tablaUsuarios = document.getElementById('tabla-usuarios');

    tablaUsuarios.innerHTML = `
        <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Carrera</th>
            <th>Teléfono</th>
            <th>Sangre</th>
            <th>Edad</th>
            <th>Género</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>
    `;

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
                <button class="btn-eliminar" data-id="${usuario.id}">Eliminar</button>
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

    document.querySelectorAll('.btn-eliminar').forEach(boton => {
        boton.addEventListener('click', async (e) => {
            const idUsuario = e.target.getAttribute('data-id');

            if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
                try {
                    const response = await fetch('php/eliminar_usuario.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ id: idUsuario }),
                    });
                    const result = await response.json();

                    if (result.success) {
                        alert(result.message);
                        obtenerUsuarios(); 
                    } else {
                        alert('Error: ' + result.message);
                    }
                } catch (error) {
                    console.error('Error al eliminar el usuario:', error);
                }
            }
        });
    });
}

document.addEventListener('DOMContentLoaded', () => {
    if (document.getElementById('tabla-usuarios')) {
        obtenerUsuarios();
    }
});
