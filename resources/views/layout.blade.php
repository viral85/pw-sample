<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>User Card - {{ $title }}</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href={{ asset('assets/css/main.css') }} />
        <noscript><link rel="stylesheet" href={{ asset('assets/css/noscript.css') }} /></noscript>
        @yield('styles')
    </head>
    <body class="is-preload">
        <div id="wrapper">
            <section id="main">
                @yield('content')
            </section>
        </div>
        <footer id="footer">
            <ul class="copyright">
                <li>&copy; Pictureworks</li>
            </ul>
        </footer>
        <script>
            if ('addEventListener' in window) {
                window.addEventListener('load', function() { document.body.className = document.body.className.replace(/\bis-preload\b/, ''); });
                document.body.className += (navigator.userAgent.match(/(MSIE|rv:11\.0)/) ? ' is-ie' : '');
            }
        </script>
        @yield('scripts')
    </body>
</html>