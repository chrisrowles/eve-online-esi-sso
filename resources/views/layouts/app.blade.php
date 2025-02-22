<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} | New Eden's Premier Industry Corporation</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('additional_styles')
</head>
<body>
@include('partials.navbar')
<main class="bg-sakagami bg-space">
    @yield('content')
</main>
<footer class="footer py-2">
    <div class="container text-center">
        <span>Copyright © {{ date('Y') }} {{ config('app.name') }}. All Rights Reserved</span>
    </div>
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
@yield('additional_scripts')
</body>
</html>
