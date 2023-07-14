<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    @if (! app()->environment('production'))
        <meta name="robots" content="noindex">
    @endif

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> G-Board</title>
    <script src="{{ mix('/js/app.js') }}" defer></script>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
          integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
          crossorigin="anonymous"
          referrerpolicy="no-referrer" />
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    @stack('css')
    @stack('js')
</head>

<body>
<div id="app"></div>
</body>
</html>
