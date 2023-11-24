<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | Limike Olshop</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">    
    <link rel="stylesheet" href="{{ asset('assets/css/custom-template.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    @livewireStyles
    <script src="https://cdn.jsdelivr.net/cleave.js/1.6.0/cleave.min.js"></script>    

    @stack('css')
</head>
<body>
    <div id="app">
        <x-navbar></x-navbar>
        <main>
            @yield('content')
        </main>
    </div>
    <x-footer></x-footer>
    {{-- <x-footer></x-footer> --}}
    <!-- JavaScript -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    {{-- <script>
        window.livewire.on('login_status', (eventData) => {
            alertify.set('notifier', 'position', 'top-right');
            alertify.error(eventData.text);
        });
    </script> --}}
    {{-- <script>
        window.addEventListener('livewire:load', function() {
            Livewire.on('login_status', (eventData) => {

                alertify.set('notifier','position', 'top-right');
                alertify.error(eventData.text);
            })
            // event => {
            // const text = event.detail.text;
            // const type = event.detail.type;
            // const status = event.detail.status;

            // console.log(text,type,status);
            
        })
    </script> --}}
    <!-- Tambahkan di bagian head atau sebelum tag body ditutup -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    @stack('js')
    @livewireScripts
</body>
</html>
