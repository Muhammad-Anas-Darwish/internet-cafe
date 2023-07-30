<x-layout>
    <x-slot:title>Login</x-slot:title>
    <x-slot:body_style>background-image: url({{url('images', 'bg-1.jpg')}});</x-slot:body_style>

    <!-- Start Form -->
    <div class="form-box center">
        <div class="box">
            <h2>Login</h2>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <input class="field" placeholder="Email" type="email" name="email">
                @error('email')
                    <div>{{ $message }}</div>
                @enderror
                <input class="field" placeholder="Password" type="password" name="password">
                @error('password')
                    <div>{{ $message }}</div>
                @enderror
                <input type="submit" value="Login">
            </form>
            <p>Not a member? <a href="{{route('user.create')}}">Sign Up</a></p>
        </div>
    </div>
    <!-- End Form -->
</x-layout>
