<div class="p-4 border shadow-md rounded-2xl bg-white/40 backdrop-blur border-white/30">
    <p class="mb-2 text-sm font-semibold text-gray-700">Consentimiento Registrado:</p>
    <ul class="space-y-1 text-sm text-gray-600">
        <li><strong>Versión:</strong> {{ $log['policy_version'] }}</li>
        <li><strong>Fecha:</strong> {{ $log['accepted_at'] }}</li>
        <li><strong>IP:</strong> {{ $log['ip'] }}</li>
        <li><strong>Agente:</strong> <span class="break-all">{{ $log['agent'] }}</span></li>
    </ul>
</div>
