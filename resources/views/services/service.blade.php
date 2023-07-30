<x-layout>
    <x-slot:title>{{ $service->name }}</x-slot:title>
    <x-slot:body_style>background-image: url({{ url('images', 'bg-2.jpg') }});</x-slot:body_style>

    <div class="show-box center">
        <div class="box">
            <h2>{{ $service->name }}</h2>
            <h3>Price: {{ $service->price }}</h3>

            <div class="down">
                <a href="{{ route('services.update', $service->id) }}">Update</a>
                <form method="POST">
                    @csrf
                    @method('delete')
                    <input type="submit" value="Delete">
                </form>
            </div>
        </div>
    </div>
</x-layout>
