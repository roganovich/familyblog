<!DOCTYPE html>
<html lang="{{ $locale }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="shortcut icon"  href="favicon.ico">

    <!-- Scripts
    <script src="{{ asset('js/app.js') }}" defer></script>
-->
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/blog.css') }}" rel="stylesheet">
    <link href="{{ asset('package/open-iconic/font/css/open-iconic-bootstrap.css')}}" rel="stylesheet">
    <!-- include libraries(jQuery, bootstrap) -->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">




                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!--<a class="nav-link" href="{{ route('locale.blog.posts.index',['locale'=>$locale]) }}">@lang('messages.articles')</a>
                    <a class="nav-link" href="{{ route('locale.blog.categories.index',['locale'=>$locale]) }}">@lang('messages.category')</a>
                    -->

                        <div id="author_1" class="author">
                            <div class="authorblock">
                                <div class="avatar">
                                    @php ($author1 = SettingsHelper::getUser(1))

                                    <a class="post_avatar_link" href="{{ route('locale.blog.posts.author',['author_id'=>$author1->id,'locale'=>$locale]) }}" title="@lang('messages.show') {{ $author1->name }}">
                                        <div class="post_author_img" style="background-image: url('{{$author1->avatar}}')"> </div>
                                    </a>
                                </div>
                                <div class="autor_name">
                                    <span>{{$author1->name}}</span>
                                </div>
                            </div>
                            <div class="sosiallist">
                                <a class="social" href="{{SettingsHelper::getParram('INSTA_R')}}"><img src="/images/icons/instagram.png"></a>
                                <a class="social" href="{{SettingsHelper::getParram('VK_R')}}"><img src="/images/icons/vkcom.png"></a>
                                <a class="social" href="{{SettingsHelper::getParram('VK_R')}}"><img src="/images/icons/facebook.png"></a>
                                <a class="social" href="{{SettingsHelper::getParram('YOUTUBE')}}"><img src="/images/icons/youtube.png"></a>
                            </div>
                        </div>
                        <div class="navbar-brand">
                            <div>
                                <a href="{{ url('/') }}">
                                    <img class="logo" src="/images/r_r_logo.png"/>
                                </a>
                            </div>
                            <div>
                                <a  href="{{ url('/') }}">
                                    <span class="specword">r</span>oganovich.<span class="specword">r</span>u
                                </a>
                            </div>
                            <div>
                                <ul class="navbar-nav ml-auto">
                                    @if (!$auth)
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('admin.login') }}">{{ __('Login') }}</a>
                                        </li>
                                        @if (Route::has('register'))
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('admin.register') }}">{{ __('Register') }}</a>
                                            </li>
                                        @endif
                                    @else
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">
                                                {{ $auth->name }}
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('admin.logout') }}">
                                                {{ __('Logout') }}
                                            </a>
                                        </li>
                                    @endguest
                                </ul>
                            </div>
                        </div>


                        <div id="author_2" class="author">
                            <div class="authorblock">
                                <div class="avatar">
                                    @php ($author2 = SettingsHelper::getUser(2))
                                    <a class="post_avatar_link" href="{{ route('locale.blog.posts.author',['author_id'=>$author2->id,'locale'=>$locale]) }}" title="@lang('messages.show') {{ $author2->name }}">
                                        <div class="post_author_img" style="background-image: url('{{$author2->avatar}}')"> </div>
                                    </a>
                                </div>
                                <div class="autor_name">
                                    <span>{{$author2->name}}</span>
                                </div>
                            </div>
                            <div class="sosiallist">
                                <a class="social" href="{{SettingsHelper::getParram('INSTA_R')}}"><img src="/images/icons/instagram.png"></a>
                                <a class="social" href="{{SettingsHelper::getParram('VK_R')}}"><img src="/images/icons/vkcom.png"></a>
                                <a class="social" href="{{SettingsHelper::getParram('VK_R')}}"><img src="/images/icons/facebook.png"></a>
                                <a class="social" href="{{SettingsHelper::getParram('YOUTUBE')}}"><img src="/images/icons/youtube.png"></a>
                            </div>
                        </div>
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>
    </div>
    <script src="{{ asset('js/app.js') }}" defer></script>
    @stack('scripts')
    @stack('jscroll')

    <!--<img class="logo p1" src="/images/r_r_logo.png"/>
    <img class="logo p2" src="/images/r_r_logo.png"/>

    <img class="logo p3" src="/images/r_r_logo.png"/>
    <img class="logo p4" src="/images/r_r_logo.png"/>-->
</body>
</html>
