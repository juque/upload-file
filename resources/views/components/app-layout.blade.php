<!doctype html>
<html lang="en">
    <head>
        <title>Upload file demo</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div>
            {{ $slot }}
        </div>
    @stack('scripts')
    </body>
</html>
