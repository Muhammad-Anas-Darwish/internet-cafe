<x-layout title="Taxes">
    <h3>Taxes</h3>

    @foreach ($taxes as $taxe)
        <p><a href="{{ route('taxes.one', $taxe->id) }}">{{ $taxe->name }}</a> - {{ $taxe->price }}</p>
    @endforeach
</x-layout>
