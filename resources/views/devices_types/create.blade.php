<x-layout>
    <x-slot:body_style>background-image: url({{ url('images', 'bg-1.jpg') }});</x-slot:body_style>

    <div class="form-box center">
        <div class="box">
            <h2>Device Type</h2>
            <form action="{{ route('devices_types.create') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input class="field" placeholder="Title" type="text" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="error"> - {{ $message }}</div>
                @enderror

                <input class="field" placeholder="Price" type="number" name="price" value="{{ old('price') }}" required>
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
