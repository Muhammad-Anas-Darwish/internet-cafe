<x-layout title="Services">
    <x-slot:body_style>background-image: url({{ url('images', 'bg-2.jpg') }});backdrop-filter: blur(3px);</x-slot:body_style>


    {{-- <p><a href="{{ route('services.one', $service->id) }}">{{ $service->name }}</a> - {{ $service->price }}</p> --}}

    <h1 class="main-title">Services <a href="{{ route('services.create') }}">Create</a></h1>

    <div class="all-cards">
        @foreach ($services as $service)
        <div class="box">
            <a href="{{ route('services.one', $service->id) }}">
                <h2>{{ $service->name }}</h2>
                <h3>Price: {{ $service->price }}$</h3>
            </a>
        </div>
        @endforeach
    </div>
</x-layout>
