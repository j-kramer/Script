<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Y blogs - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="wrapper">
        <header>
            <h1>Y Blogs</h1>
            @include('partials.nav')
        </header>
        <div class="content">
            @yield('content')
        </div>
    </div>
</body>

</html>