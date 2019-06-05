<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/app.css">
    <title>@yield('title','FU-LINE')</title>
</head>
<body>
    <div id="app">
        <main class="py-4">
            <div class="container">
{{--                <h1>@yield('title','FU-LINE')</h1>--}}
                <div class="content">
                    @yield('content')
                </div>
            </div>
            <footer class="footer">
                <div class="container">
                    <p class="text-muted">@yield('footer')</p>
                </div>
            </footer>
        </main>
    </div>
</body>
</html>
