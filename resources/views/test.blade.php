<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Styles -->
</head>
<body>
<div id="app">
    <order-notification user_id="{{auth()->user()->id}}"></order-notification>

</div>
</body>
</html>
