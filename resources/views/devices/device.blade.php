<x-layout>
    <x-slot:title>Device {{ $device->number }}</x-slot:title>

    <h3>Device</h3>

    <p>{{ $device->device_type_id }}</p>
    <p>{{ $device->number }}</p>
    <p>{{ $device->is_active }}</p>

    <a href="{{ route('devices.update', $device->number) }}">Edit</a>
    <form method="POST">
        @csrf
        @method('delete')
        <input type="submit" value="delete">
    </form>
</x-layout>
