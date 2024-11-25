document.addEventListener('DOMContentLoaded', async () => {
    const tablaCalificaciones = document.getElementById('tabla-calificaciones').getElementsByTagName('tbody')[0];

    
    async function cargarCalificaciones() {
        try {
            const response = await fetch('php/obtener_calificaciones.php');
            if (!response.ok) throw new Error('Error al obtener las calificaciones.');

            const calificaciones = await response.json();
            console.log('Respuesta JSON:', calificaciones);  

            if (calificaciones.length === 0) {
                const row = tablaCalificaciones.insertRow();
                const cell = row.insertCell();
                cell.colSpan = 3;
                cell.textContent = 'No hay calificaciones disponibles.';
            } else {
                calificaciones.forEach(calificacion => {
                    const row = tablaCalificaciones.insertRow();
                    row.insertCell().textContent = calificacion.estudiante;
                    row.insertCell().textContent = calificacion.materia;
                    row.insertCell().textContent = calificacion.calificacion;
                });
            }
        } catch (error) {
            console.error('Error:', error.message);
            alert('Ocurrió un error al cargar las calificaciones.');
        }
    }

    await cargarCalificaciones(); 
});

