<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Forum Application</title>
    <!-- Load in the css -->
    {{ HTML::style('/css/bootstrap.css') }}
    {{ HTML::style('/css/bootstrap-theme.css') }}
</head>
<body>
    <div class="container">
        <div class="nav">
            <ul class="nav nav-pills">
                @if(Auth::check())
                    <li>{{ link_to_route('topics.index', 'View Forums') }}</li>
                    <li>{{ link_to_route('topics.create', 'Create Forum') }}</li>
                    <li>{{ link_to_route('register', 'Register') }} </li>
                    @if(Auth::user()->id == 1)
                    <li>{{ link_to_route('user.index', 'User Page') }} </li>
                    @endif
                    <li>{{ link_to_route('logout', 'Logout ' . Auth::user()->username) }} </li>
                @else
                    <li>{{ link_to_route('home', 'Home/Login') }} </li>
                    <li>{{ link_to_route('register', 'Register') }} </li>
                @endif
            </ul>
        </div><!-- end nav -->

        <!-- check for flash notification message from filters.php -->
        @if(Session::has('flash_notice'))
            <div class="flash_notice alert alert-info">{{ Session::get('flash_notice') }}</div>
        @endif

        @yield('content')
    </div><!-- end container -->
</body>
</html>