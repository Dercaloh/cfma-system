<form method="POST" action="{{ route('politicas.store') }}">
    @csrf
    <input type="hidden" name="policy_name" value="privacidad">
    <input type="hidden" name="policy_version" value="v1.0">

    <button type="submit" class="btn-aceptar">Acepto la política</button>
</form>
