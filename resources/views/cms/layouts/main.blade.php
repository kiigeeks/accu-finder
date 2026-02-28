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
		{{-- <link href="./dist/output.css" rel="stylesheet"> --}}

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
		

        {{-- @yield('container') --}}



        <section class="h-screen w-full relative px-0 lg:px-4 py-2 lg:py-3">
            <div class="flex flex-row gap-7 px-0 lg:px-5 py-3 relative lg:absolute z-30 text-black-primary">
            
                @include('cms.includes.sidebar')

                <div class="flex-none flex flex-col justify-start absolute lg:relative px-3 lg:px-2 w-full lg:w-[calc(100vw-350px)]">
                    <div class="w-full pl-3 pr-3 md:pl-7 md:pr-7 lg:pr-0 py-5 flex justify-between bg-gray-900 rounded-lg drop-shadow-md">
                        <div class="text-white font-poppins font-bold text-2xl md:text-3xl capitalize">{{ $menu }}</div>
                    </div>
                    @yield('container')
                </div>
            </div>
        </section>
		

        {{-- script --}}
        @stack('prepend-script')
            @include('cms.includes.script')
        @stack('addon-script')
	</body>
</html>