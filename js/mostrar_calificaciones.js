// Mostrar calificaciones del estudiante
document.addEventListener('DOMContentLoaded', async () => {
    const tabla = document.getElementById('tabla-calificaciones').querySelector('tbody');

    const response = await fetch('php/obtener_calificaciones.php');
    const calificaciones = await response.json();

    calificaciones.forEach(item => {
        const fila = document.createElement('tr');
        fila.innerHTML = `
            <td>${item.materia}</td>
            <td>${item.calificacion}</td>
        `;
        tabla.appendChild(fila);
    });
});
