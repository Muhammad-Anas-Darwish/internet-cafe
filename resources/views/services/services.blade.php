<x-layout title="Services">
    <h3>Services</h3>

    @foreach ($services as $service)
        <p><a href="{{ route('services.one', $service->id) }}">{{ $service->name }}</a> - {{ $service->price }}</p>
    @endforeach
</x-layout>
