<x-layout title="Devices">
    <h3>Devices</h3>

    @foreach ($devices as $device)
        <p><a href="{{ route('devices.one', $device->number) }}">{{ $device->device_type_id }} - {{ $device->number }}</a> - {{ $device->is_active }}</p>
    @endforeach
</x-layout>
