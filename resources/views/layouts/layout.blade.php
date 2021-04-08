<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FirstLaravelProject</title>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mx-auto">
        <div style="background:Aquamarine">
            <a href={{ route('index') }}>部落格首頁</a>
        </div>
        @yield('content')
    </div>
</body>

</html>
