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
                    <li><?php echo link_to_route('member_area', 'Home');?></li>
                    <li><?php echo link_to_route('logout', 'Logout ' . Auth::user()->username);?></li>
                @else
                    <li><?php echo link_to_route('home', 'Home');?></li>
                    <li><?php echo link_to_route('login', 'Login');?></li>
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