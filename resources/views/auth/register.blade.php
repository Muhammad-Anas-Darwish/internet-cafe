<x-layout>
    <x-slot:title>Create User</x-slot:title>
    <x-slot:body_style>background-image: url({{url('images', 'bg-1.jpg')}});</x-slot:body_style>

    <div class="form-box center">
        <div class="box">
            <h2>Register</h2>
            <form action="{{ route('user.create') }}" method="POST">
                @csrf
                <input class="field" placeholder="Name" type="text" name="name">
                @error('name')
                    <div>{{ $message }}</div>
                @enderror
                <input class="field" placeholder="Email" type="email" name="email">
                @error('email')
                    <div>{{ $message }}</div>
                @enderror
                <input class="field" placeholder="Password" type="password" name="password">
                @error('password')
                    <div>{{ $message }}</div>
                @enderror
                <input class="field" placeholder="Password Confirmation" type="password" name="password_confirmation">
                @error('password_confirmation')
                    <div>{{ $message }}</div>
                @enderror
                <input type="submit" value="Register">
            </form>
            <p>I have an account? <a href="{{ route('login') }}">Sign In</a></p>
        </div>
    </div>
</x-layout>
