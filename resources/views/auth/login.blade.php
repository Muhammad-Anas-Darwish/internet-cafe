<x-layout>
    <x-slot:title>Login</x-slot:title>

    <h3>Login</h3>

    <form action="{{ route('login') }}" method="POST">
        @csrf

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

        <input type="submit" value="Login">
    </form>
</x-layout>
