<x-layout>
    <h3>Update Service</h3>

    <form action="{{ route('services.update', $service->id) }}" method="post">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Name: </label>
            <input type="text" name="name" value="{{ $service->name }}" required>
            @error('name')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="price">Price: </label>
            <input type="number" name="price" value="{{ $service->price }}" required>
            @error('price')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <input type="submit" value="Update">
    </form>
</x-layout>
