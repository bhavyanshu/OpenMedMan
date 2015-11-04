<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title')</title>

        {!! Html::style('css/app.css') !!}
        {!! Html::style('css/style.css') !!}

        {!! Html::script('js/jquery.min.js') !!}
        {!! Html::script('js/bootstrap.min.js') !!}
    </head>
    
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            @if(Auth::check()) 
                {!! Html::linkRoute('dashboard', 'Hi, '.Auth::user()->name, array(), array('class' => 'navbar-brand')) !!}
            @else
                {!!Html::link('users/dashboard', 'OpenMedMan',array('class'=>'navbar-brand'))!!} 
            @endif
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    @if(Auth::check())
                    <li><a href="/dashboard">Home</a></li>
                    <li><a href="/about">About</a></li>
                    @else
                    <li><a href="/">Home</a></li>
                    <li><a href="/about">About</a></li>
                    @endif
                </ul>
                @if(Auth::check())
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Settings <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li>{!! HTML::link('users/profile/'.Auth::user()->id, 'View Profile') !!}</li>
                            <li>{!! HTML::link('profile/edit', 'Edit Profile') !!}</li>
                            <li>{!! HTML::link('users/settings/password', 'Change Password') !!}</li>
                        </ul>
                    </li>
                    <li>{!!Html::link('users/logout', 'Logout')!!} </li>
                </ul>
                @endif
            </div><!--/.nav-collapse -->
        </div>
    </nav>

    <body>
        <div class="container">
            @yield('content')
        </div><!-- /.container -->
    </body>
</html>