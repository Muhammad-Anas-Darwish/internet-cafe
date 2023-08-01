<x-layout title="Devices Types">
    <x-slot:body_style>background-image: url({{ url('images', 'bg-2.jpg') }});backdrop-filter: blur(3px);</x-slot:body_style>

<h1 class="main-title">Devices Types <a href="{{ route('devices_types.create') }}">Create</a></h1>

    <div class="all-cards">
        @foreach ($devices_types as $device_type)
        <div class="box">
            <a href="{{ route('devices_types.one', $device_type->id) }}">
                <div class="center img">
                    <img src="{{ $device_type->image_url }}">
                </div>
                <div class="content">
                    <h2>{{ $device_type->name }}</h2>
                    <h3>Price: {{ $device_type->price }}$</h3>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</x-layout>
