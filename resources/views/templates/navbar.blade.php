<nav class="navbar is-dark">
    <div class="container">
        <div class="navbar-brand">
            <a class="navbar-item" href="{{ urls('/') }}">Michael Bitokhov</a>
            <div id="navbarBurger" class="navbar-burger burger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <div id="navbarMenu" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item {{ Route::getActive('home') }}" href="{{ urls('/') }}">
                    Home
                </a>
                <a class="navbar-item {{ Route::getActive('blags') }}" href="{{ urls('blags') }}">
                    Blags
                </a>
                <a class="navbar-item {{ Route::getActive('about-me') }}" href="{{ urls('about-me') }}">
                    About me
                </a>
                <a class="navbar-item {{ Route::getActive('resume') }}" href="{{ urls('resume') }}">
                    Resume
                </a>
                <div class="navbar-item has-dropdown is-hoverable">
                    <div class="navbar-link">
                        Tools
                    </div>
                    <div class="navbar-dropdown is-boxed">
                        <a class="navbar-item" href="{{ route('tools.nutrition-calculator') }}">
                            Nutrition calculator
                        </a>
                    </div>
                </div>
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
