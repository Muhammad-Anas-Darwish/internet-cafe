<x-layout>
    <x-slot:title>Device {{ $device->number }}</x-slot:title>
    <x-slot:body_style>background-image: url({{ url('images', 'bg-2.jpg') }});</x-slot:body_style>

    <div class="show-box center">
        <div class="box">
            <div class="center img">
                <img src="{{ $device->device_type->image_url }}">
            </div>
            <div class="content">
                <h2>Device {{ $device->number }}</h2>
                <h3>{{ $device->device_type->name }}</h3>
                <h3>{{ ($device->is_active)? 'Device active' : 'Not Active'}}</h3>
                <div class="down">
                    <a href="{{ route('devices.update', $device->number) }}">Update</a>
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
