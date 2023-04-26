<x-layout>
    <x-slot:title>Create User</x-slot:title>

    <h3>Create User</h3>

    <form action="{{ route('user.create') }}" method="POST">
        @csrf

        <label for="name">Name: </label>
        <input type="text" name="name" value="{{old('name')}}" required>
        @error('name')
            <div>{{ $message }}</div>
        @enderror
        <br>

        <label for="email">Email: </label>
        <input type="email" name="email" value="{{old('email')}}" required>
        @error('email')
            <div>{{ $message }}</div>
        @enderror
        <br>

        <label for="password">Password: </label>
        <input type="password" name="password" required>
        @error('password')
            <div>{{ $message }}</div>
        @enderror

        <label for="password_confirmation">Password: </label>
        <input type="password" name="password_confirmation" required>
        @error('password_confirmation')
            <div>{{ $message }}</div>
        @enderror

        <input type="submit" value="Register">
    </form>
</x-layout>
