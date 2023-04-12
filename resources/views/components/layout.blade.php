<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Internet Cafe'}}</title>
</head>
<body>
    <h1>Header</h1>
    @if (session()->has('status'))
        <div>
            {{ session('status') }}
        </div>
        @endif
    <div>
        {{-- @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}
    </div>
    {{ $slot }}
    <h1>Footer</h1>
</body>
</html>
