<x-layout>
    <x-slot:body_style>background-image: url({{ url('images', 'bg-1.jpg') }});</x-slot:body_style>

    <div class="form-box center">
        <div class="box">
            <h2>Device Type</h2>
            <form action="{{ route('devices_types.update', $device_type->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <input class="field" placeholder="Title" type="text" name="name" value="{{ $device_type->name }}" required>
                @error('name')
                    <div class="error"> - {{ $message }}</div>
                @enderror

                <input class="field" placeholder="Price" type="number" name="price" value="{{ $device_type->price }}" required>
                @error('price')
                    <div class="error"> - {{ $message }}</div>
                @enderror
                
                <input class="field" placeholder="Image" type="file" name="image" @error('image') is-invalid @enderror>
                @error('image')
                    <div class="error"> - {{ $message }}</div>
                @enderror
                <input type="submit" value="Create">
            </form>
        </div>
    </div>
</x-layout>
