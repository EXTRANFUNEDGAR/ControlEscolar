document.addEventListener('DOMContentLoaded', async () => {
    const materiaSelect = document.getElementById('materia');
    const estudianteSelect = document.getElementById('estudiante');

    // Función para cargar las materias
    async function cargarMaterias() {
        try {
            const response = await fetch('php/obtener_materias.php');
            if (!response.ok) throw new Error('Error al obtener las materias.');

            const materias = await response.json();

            if (materias.length === 0) {
                materiaSelect.innerHTML = '<option value="">No hay materias disponibles</option>';
            } else {
                materiaSelect.innerHTML = materias
                    .map(materia => `<option value="${materia.id}">${materia.nombre}</option>`)
                    .join('');
            }
        } catch (error) {
            console.error(error.message);
            alert('Ocurrió un error al cargar las materias.');
        }
    }

    // Función para cargar los estudiantes
    async function cargarEstudiantes() {
        try {
            const response = await fetch('php/obtener_estudiantes.php');
            if (!response.ok) throw new Error('Error al obtener los estudiantes.');

            const estudiantes = await response.json();

            if (estudiantes.length === 0) {
                estudianteSelect.innerHTML = '<option value="">No hay estudiantes disponibles</option>';
            } else {
                estudianteSelect.innerHTML = estudiantes
                    .map(estudiante => `<option value="${estudiante.id}">${estudiante.nombre}</option>`)
                    .join('');
            }
        } catch (error) {
            console.error(error.message);
            alert('Ocurrió un error al cargar los estudiantes.');
        }
    }

    // Llamar a las funciones de carga
    await cargarMaterias();
    await cargarEstudiantes();
});
