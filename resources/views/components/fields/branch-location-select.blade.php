@props([
    'branchId' => old('branch_id'),
    'locationId' => old('location_id'),
    'branches' => [],
])

@php
    $componentId = 'branch-location-' . uniqid(); // para aislar múltiples instancias
@endphp

<div x-data="branchLocationSelector('{{ $componentId }}')" x-init="init()"
     class="grid grid-cols-1 gap-4 sm:grid-cols-2">

    {{-- Sede --}}
    <div>
        <label for="{{ $componentId }}-branch" class="block text-sm font-medium text-gray-700">Sede</label>
        <select
            id="{{ $componentId }}-branch"
            name="branch_id"
            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            x-model="branch"
            @change="loadLocations()"
            required
        >
            <option value="">Seleccione una sede</option>
            @foreach($branches as $id => $name)
                <option value="{{ $id }}" @selected($branchId == $id)>{{ $name }}</option>
            @endforeach
        </select>
    </div>

    {{-- Ubicación --}}
    <div>
        <label for="{{ $componentId }}-location" class="block text-sm font-medium text-gray-700">Ubicación interna</label>
        <select
            id="{{ $componentId }}-location"
            name="location_id"
            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
            :disabled="loading || !branch"
            x-model="location"
            required
        >
            <option value="">Seleccione una ubicación interna</option>
            <template x-for="loc in locations" :key="loc.id">
                <option :value="loc.id" x-text="loc.name" :selected="loc.id == '{{ $locationId }}'"></option>
            </template>
        </select>
    </div>

</div>

@push('scripts')
<script>
    function branchLocationSelector(idPrefix) {
        return {
            branch: '{{ $branchId }}',
            location: '{{ $locationId }}',
            locations: [],
            loading: false,

            init() {
                if (this.branch) {
                    this.loadLocations(true);
                }
            },

            async loadLocations(initial = false) {
                if (!this.branch) {
                    this.locations = [];
                    return;
                }

                this.loading = true;

                try {
                    const res = await fetch(`/admin/sedes/${this.branch}/ubicaciones`);
                    const data = await res.json();

                    if (data.success) {
                        this.locations = data.locations;

                        // Restaura la ubicación si viene de un old()
                        if (initial && this.location) {
                            const found = this.locations.find(l => l.id == this.location);
                            if (!found) {
                                this.location = '';
                            }
                        }
                    } else {
                        this.locations = [];
                    }
                } catch (e) {
                    console.error("Error al cargar ubicaciones:", e);
                    this.locations = [];
                } finally {
                    this.loading = false;
                }
            }
        };
    }
</script>
@endpush
