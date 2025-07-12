@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Mostrar u ocultar detalles
        document.querySelectorAll('.toggle-details').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
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
@endpush
