  {{-- JS accesible --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const selectAll = document.getElementById('select-all');
            const checkboxes = document.querySelectorAll('.select-user');
            const userIdsInput = document.getElementById('user-ids-input');
            const exportForm = document.getElementById('export-form');
            const exportType = document.getElementById('export_type');

            const actualizarSeleccionados = () => {
                const seleccionados = Array.from(checkboxes)
                    .filter(c => c.checked)
                    .map(c => c.value);
                userIdsInput.value = seleccionados.join(',');
            };

            // Deseleccionar todos por defecto
            checkboxes.forEach(c => c.checked = false);
            actualizarSeleccionados();

            // Click en fila selecciona/desmarca (excepto botones, enlaces, inputs)
            document.querySelectorAll('tr[data-user-id]').forEach(fila => {
                fila.addEventListener('click', e => {
                    const esInteractivo = ['BUTTON', 'A', 'INPUT', 'LABEL', 'SELECT'].includes(e.target.tagName);
                    if (!esInteractivo) {
                        const checkbox = fila.querySelector('.select-user');
                        checkbox.checked = !checkbox.checked;
                        actualizarSeleccionados();
                    }
                });
            });

            checkboxes.forEach(c => c.addEventListener('change', actualizarSeleccionados));

            selectAll.addEventListener('change', (e) => {
                checkboxes.forEach(c => c.checked = e.target.checked);
                actualizarSeleccionados();
            });

            exportForm.addEventListener('submit', (e) => {
                if (exportType.value === 'current' && userIdsInput.value === '') {
                    e.preventDefault();
                    alert('Debe seleccionar al menos un usuario.');
                }
            });

            // Mostrar u ocultar detalles
            document.querySelectorAll('.toggle-details').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.stopPropagation(); // Prevenir selección al hacer clic en "Ver más"
                    const id = btn.dataset.user;
                    const fila = document.getElementById(`details-${id}`);
                    const expanded = btn.getAttribute('aria-expanded') === 'true';
                    fila.classList.toggle('hidden');
                    btn.setAttribute('aria-expanded', (!expanded).toString());
                    btn.textContent = expanded ? 'Ver más' : 'Ocultar';
                });
            });
        });
    </script>

