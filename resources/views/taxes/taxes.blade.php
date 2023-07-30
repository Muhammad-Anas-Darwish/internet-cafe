<x-layout title="Taxes">
    <x-slot:body_style>background-image: url({{ url('images', 'bg-2.jpg') }});backdrop-filter: blur(3px);</x-slot:body_style>

    <h1 class="main-title">Taxes</h1>

    <div class="all-cards">
        @foreach ($taxes as $taxe)
        <div class="box">
            <a href="{{ route('taxes.one', $taxe->id) }}">
                <h2>{{ $taxe->name }}</h2>
                <h3>Price: {{ $taxe->price }}$</h3>
            </a>
        </div>
        @endforeach
    </div>
</x-layout>
