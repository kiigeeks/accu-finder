<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ACCU Finder</title>

        <meta name="title" content="ACCU Finder" />
        <meta name="description" content="ACCU Finder adalah aplikasi untuk menentukan type accu untuk berbagai kendaraan bermotor." />
        <meta name="keywords" content="ACCU Finder, accu, cars, aki" />
        <meta name="author" content="BIT" />

        <link rel="shortcut icon" href="/assets/BIT.jpg" type="image/x-icon" />
        <link rel="icon" href="/assets/BIT.jpg" type="image/x-icon"/>

        {{-- style --}}
        @stack('prepend-style')
            @include('cms.includes.style')
        @stack('addon-style')

        {{-- local --}}
        {{-- @vite('resources/css/app.css') --}}

        {{-- production --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])
	</head>
	<body>
        @include('sweetalert::alert')
		
        @yield('container')
		
        {{-- script --}}
        @stack('prepend-script')
            @include('cms.includes.script')
        @stack('addon-script')
	</body>
</html>