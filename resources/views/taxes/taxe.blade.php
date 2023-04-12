<x-layout>
    <x-slot:title>{{ $taxe->name }}</x-slot:title>

    <h3>Taxe</h3>

    <p>{{ $taxe->name }}</p>
    <p>{{ $taxe->price }}</p>

    <a href="{{ route('taxes.update', $taxe->id) }}">Edit</a>
    <form method="POST">
        @csrf
        @method('delete')
        <input type="submit" value="delete">
    </form>
</x-layout>
