<x-layout title="Devices">
    <x-slot:body_style>background-image: url({{ url('images', 'bg-2.jpg') }});backdrop-filter: blur(3px);</x-slot:body_style>

    <h1 class="main-title">Devices</h1>

    <div class="all-cards">
        @foreach ($devices as $device)
        <div class="box">
            <a href="{{ route('devices.one', $device->number) }}">
                <div class="center img">
                    <img src="{{ $device->device_type->image_url }}">
                </div>
                <div class="content">
                    <h2>Device {{ $device->number }}</h2>
                    <h3>{{ ($device->is_active)? "is active": "not active"}}</h3>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</x-layout>
