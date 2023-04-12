<x-layout>
    <h3>Update Device Type</h3>

    <form action="{{ route('devices_types.update', $device_type->id) }}" method="post">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Name: </label>
            <input type="text" name="name" value="{{ $device_type->name }}" required>
            @error('name')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="price">Price: </label>
            <input type="number" name="price" value="{{ $device_type->price }}" required>
            @error('price')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <input type="submit" value="Update">
    </form>
</x-layout>
