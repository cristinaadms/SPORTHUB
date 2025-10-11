@props(['local', 'horario', 'data', 'participantes'])

<div class="grid grid-cols-2 gap-4 p-6">
    <x-info-item icon="local" label="Local" :value="$local" />
    <x-info-item icon="clock" label="Horário" :value="$horario" />
    <x-info-item icon="calendar" label="Data" :value="$data" />
    <x-info-item icon="users" label="Participantes" :value="$participantes" />
</div>
