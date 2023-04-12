<x-layout>
    <h3>Create Service</h3>

    <form action="{{ route('services.create') }}" method="post">
        @csrf
        <div>
            <label for="name">Name: </label>
            <input type="text" name="name" value="{{ old('name') }}" required>
            @error('name')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="price">Price: </label>
            <input type="number" name="price" value="{{ old('price') }}" required>
            @error('price')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <input type="submit" value="Save">
    </form>
</x-layout>
