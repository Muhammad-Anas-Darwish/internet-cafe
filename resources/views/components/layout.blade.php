<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Internet Cafe'}}</title>
    {{-- CSS Code --}}
    <link rel="stylesheet" href="{{url('css', 'normalize.css')}}">
    <link rel="stylesheet" href="{{url('css', 'master.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{url('css', 'all.min.css')}}">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;700&display=swap" rel="stylesheet">
</head>

<body style="{{ $body_style ?? '' }}">
    @include('components/header')

    @include('components/sessions')

    {{ $slot }}

    @include('components/footer')

    <script src="js/script.js"></script>
</body>
</html>
