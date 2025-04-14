<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    {{-- <link rel="icon" href="/globe.png"> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    {{-- <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self'">  --}}

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <title>Casino | Dashboard</title>

    <meta name="description" content="Online Casino Dashboard">
    <meta name="keywords" content="HTML, CSS, JavaScript">
    <meta name="author" content="knivez13">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/all.css">

    @vite(['resources/js/app.js'])
    <style type="text/css">
        ::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.5);

        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgba(0, 0, 0, 0.7);
        }
    </style>
</head>

<body>
    <div id="app"></div>
</body>

</html>
