<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Buku Digital</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- FONT AWESOME -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
</head>

<body class="bg-slate-100 text-slate-700">

<div class="container mx-auto p-6">

    @yield('content')

</div>

</body>
</html>