<x-layout>
    <h3>Create Service</h3>

    <form action="{{ route('services.update', $service->id) }}" method="post">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Name: </label>
            <input type="text" name="name" value="{{ $service->name }}" required>
        </div>
        <div>
            <label for="price">Price: </label>
            <input type="number" name="price" value="{{ $service->price }}" required>
        </div>
        <input type="submit" value="Update">
    </form>
</x-layout>
