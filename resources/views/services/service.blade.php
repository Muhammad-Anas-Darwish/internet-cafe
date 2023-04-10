<x-layout>
    <x-slot:title>{{ $service->name }}</x-slot:title>

    <h3>Service</h3>

    <p>{{ $service->name }}</p>
    <p>{{ $service->price }}</p>

    <a href="{{ route('services.update', $service->id) }}">Edit</a>
    <form method="POST">
        @csrf
        @method('delete')
        <input type="submit" value="delete">
    </form>
</x-layout>
