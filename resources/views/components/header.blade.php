<!-- Start Header -->
<div class="header" id="header">
    <div class="container">
        <a href="{{ route('bookings.main') }}" class="logo">Internet Cafe</a>
        <ul class="main-nav">
            <li><a href="{{route('devices_types.list')}}">Devices Types</a></li>
            <li><a href="{{route('devices.list')}}">Devices</a></li>
            <li><a href="{{route('services.list')}}">Services</a></li>
            <li><a href="{{route('taxes.list')}}">Taxes</a></li>
            <li>
                @auth
                <a href="{{route('logout')}}">Logout</a>

                @endauth
                @guest
                    <a href="{{route('login')}}">Login</a>
                @endguest
            </li>
        </ul>
    </div>
</div>
<!-- End Header -->
