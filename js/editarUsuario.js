document.addEventListener('DOMContentLoaded', async () => {
    const urlParams = new URLSearchParams(window.location.search);
    const idUsuario = urlParams.get('id');
    
    if (idUsuario) {
        const response = await fetch(`php/obtener_usuario.php?id=${idUsuario}`);
        const usuario = await response.json();
        
        document.getElementById('id-usuario').value = usuario.id;
        document.getElementById('nombre').value = usuario.nombre;
        document.getElementById('email').value = usuario.email;
        document.getElementById('carrera').value = usuario.carrera;
        document.getElementById('telefono').value = usuario.telefono;
        document.getElementById('sangre').value = usuario.sangre;
        document.getElementById('edad').value = usuario.edad;
        document.getElementById('genero').value = usuario.genero;
    }
});
