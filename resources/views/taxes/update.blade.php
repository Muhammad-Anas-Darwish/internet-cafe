<x-layout>
    <h3>Update taxe</h3>

    <form action="{{ route('taxes.update', $taxe->id) }}" method="post">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Name: </label>
            <input type="text" name="name" value="{{ $taxe->name }}" required>
            @error('name')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="price">Price: </label>
            <input type="number" name="price" value="{{ $taxe->price }}" required>
            @error('price')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <input type="submit" value="Update">
    </form>
</x-layout>
