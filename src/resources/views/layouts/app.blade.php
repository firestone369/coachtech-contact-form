<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>

    <header class="header">
        <div class="site-header__inner">
                <h1 class="header-title">FashionablyLate</h1>
            <div class="site-header__right">
                @yield('header-right')
            </div>
        </div>
    </header>

    @yield('content')

</body>

</html>