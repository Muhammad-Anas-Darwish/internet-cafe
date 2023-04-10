<x-layout>
    <h3>Create Device Type</h3>

    <form action="{{ route('devices_types.create') }}" method="post">
        @csrf
        <div>
            <label for="name">Name: </label>
            <input type="text" name="name" required>
        </div>
        <div>
            <label for="price">Price: </label>
            <input type="number" name="price" required>
        </div>
        <input type="submit" value="Save">
    </form>
</x-layout>
