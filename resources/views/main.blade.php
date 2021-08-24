<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">

                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @if (Route::currentRouteName() == 'welcome')
                            @if($errors->any())
                            @foreach ($errors->all() as $error)
                                <p class="m-3">{{ $error }}</p>
                            @endforeach
                            @endif

                        <p class="m-3">Введите в адресную строку адрес артиста на SoundCloud, чтобы отобразить доступные данные и сохранить их. Например: https://test.loc <b>/lakeyinspired </b></p>
                    @else

                    <div class="card-header"> {!! $artist['name'] !!} </div>

                        <div class="card-body">
                                <div class="media">
                                  @if(isset($artist['userpic']))
                                        <img src=" {{'storage/avatars/'. $artist['userpic'] }} " class="mr-3" >
                                  @endif
                                  <div class="media-body">
                                    <h5 class="mt-0"></h5>
                                  </div>
                                </div>


                                @if($tracks)
                                    <ul class="list-group">
                                    @foreach($tracks as $track)
                                            <li class="list-group-item">{{$track['name']}}</li>
                                    @endforeach
                                    </ul>
                                @endif


                        @endif


                        </div>

                    </div>
                  </div>
            </div>
        </div>

        </main>
    </div>


</body>
</html>
