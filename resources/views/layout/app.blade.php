<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Course Manager</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    {{-- toast css cdn --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>

<body>
    <div class="container">
        @yield('content')
    </div>



    {{-- Toastify JS --}}
    <script src="{{ asset('https://cdn.jsdelivr.net/npm/toastify-js') }}"></script>

    {{-- custom js --}}
    <script src="{{ asset('js/custom.js') }}"></script>
</body>

</html>
