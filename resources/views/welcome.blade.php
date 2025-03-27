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
    <title>WCC | Dashboard</title>
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.2/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css" rel="stylesheet">

    @vite(['resources/js/app.js'])
    <style type="text/css">
        /* Hide scrollbar for WebKit browsers */
        ::-webkit-scrollbar {
            width: 5px;
            /* Width of the scrollbar */
            height: 5px;
            /* Height of the scrollbar for horizontal scrolling */
        }

        /* Style the track (part of the scrollbar not covered by the handle) */
        ::-webkit-scrollbar-track {
            background: transparent;
            /* Make the track transparent */
        }

        /* Style the handle (the draggable part of the scrollbar) */
        ::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.5);
            /* Color of the scrollbar handle */
            /* border-radius: 10px; */
            /* Optional: rounded corners for the scrollbar handle */
        }

        /* Optional: Add hover effect to the scrollbar handle */
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(0, 0, 0, 0.7);
            /* Darker color when hovering */
        }

        .v-toast__text {
            z-index: 9999;
            /* Adjust this value if needed */
        }
    </style>
</head>

<body>
    <div id="app"></div>
</body>

</html>
