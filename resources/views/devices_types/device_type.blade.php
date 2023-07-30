<x-layout>
    <x-slot:title>{{ $device_type->name }}</x-slot:title>
    <x-slot:body_style>background-image: url({{ url('images', 'bg-2.jpg') }});</x-slot:body_style>

    <div class="show-box center">
        <div class="box">
            <div class="center img">
                <img src="{{ $device_type->image_url }}">
            </div>
            <div class="content">
                <h2>{{ $device_type->name }}</h2>
                <h3>Price: {{ $device_type->price }}$</h3>
                <div class="down">
                    <a href="{{ route('devices_types.update', $device_type->id) }}">Update</a>
                    <form method="POST">
                        @csrf
                        @method('delete')
                        <input type="submit" value="Delete">
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>
