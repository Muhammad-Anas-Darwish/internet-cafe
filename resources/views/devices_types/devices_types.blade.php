<x-layout title="Devices Types">
    <h3>Devices Types</h3>

    @foreach ($devices_types as $device_type)
        <p><a href="{{ route('devices_types.one', $device_type->id) }}">{{ $device_type->name }}</a> - {{ $device_type->price }}</p>
    @endforeach
</x-layout>
