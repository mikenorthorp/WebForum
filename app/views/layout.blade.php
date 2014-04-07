<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <title>Laravel Authentication Demo</title>
    <!-- Load in the css -->
    {{ HTML::style('/css/bootstrap.css') }}
    {{ HTML::style('/css/bootstrap-theme.css') }}
</head>
<body>
    <div id="container">
        <div id="nav">
            <ul>
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
            <div id="flash_notice">{{ Session::get('flash_notice') }}</div>
        @endif

        @yield('content')
    </div><!-- end container -->
</body>
</html>