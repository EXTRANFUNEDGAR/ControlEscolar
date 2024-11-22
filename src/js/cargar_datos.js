// Cargar materias y estudiantes dinámicamente
document.addEventListener('DOMContentLoaded', async () => {
    const materiaSelect = document.getElementById('materia');
    const estudianteSelect = document.getElementById('estudiante');

    // Cargar materias
    const materiasResponse = await fetch('php/obtener_materias.php');
    const materias = await materiasResponse.json();
    materias.forEach(materia => {
        const option = document.createElement('option');
        option.value = materia.id;
        option.textContent = materia.nombre;
        materiaSelect.appendChild(option);
    });

    // Cargar estudiantes
    const estudiantesResponse = await fetch('php/obtener_estudiantes.php');
    const estudiantes = await estudiantesResponse.json();
    estudiantes.forEach(estudiante => {
        const option = document.createElement('option');
        option.value = estudiante.id;
        option.textContent = estudiante.nombre;
        estudianteSelect.appendChild(option);
    });
});
