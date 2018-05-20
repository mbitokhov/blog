<nav class="navbar is-dark">
    <div class="container">
        <div class="navbar-brand">
            <a class="navbar-item" href="{{ url('/') }}">Michael Bitokhov</a>
            <div id="navbarBurger" class="navbar-burger burger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <div id="navbarMenu" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item{{$navigation === 'home' ? ' is-active' : ''}}" href="{{ url('/') }}">
                    Home
                </a>
                <a class="navbar-item{{$navigation === 'blags' ? ' is-active' : ''}}" href="{{ url('blags') }}">
                    Blags
                </a>
                <a class="navbar-item{{$navigation === 'about-me' ? ' is-active' : ''}}" href="{{ url('about-me') }}">
                    About me
                </a>
                <a class="navbar-item{{$navigation === 'resume' ? ' is-active' : ''}}" href="{{ url('resume') }}">
                    Resume
                </a>
                <a class="navbar-item" href="https://github.com/mbitokhov">
                    Github
                </a>
            </div>
            <div class="navbar-end">
                <p class="navbar-item has-text-grey-lighter">
                    {{ Illuminate\Foundation\Inspiring::quote() }}
                </p>
            </div>
        </div>
    </div>
</nav>
