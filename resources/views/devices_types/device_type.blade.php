<x-layout>
    <x-slot:title>{{ $device_type->name }}</x-slot:title>

    <h3>Device Type</h3>

    <p>{{ $device_type->name }}</p>
    <p>{{ $device_type->price }}</p>

    <a href="{{ route('devices_types.update', $device_type->id) }}">Edit</a>
    <form method="POST">
        @csrf
        @method('delete')
        <input type="submit" value="delete">
    </form>
</x-layout>
