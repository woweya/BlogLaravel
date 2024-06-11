
<nav class="navbar navbar-expand-lg" style="background-color:var(--primary-color);z-index: 1;">
    <div class="container-fluid" style="position: relative;">

        <div class="d-flex align-items-center w-100">
            <div class="logo-image" style="border-radius: 50%;; max-width: 50px; margin-right: 5px">
            </div>
            <div style="border-right: 1px solid var(--secondary-color); height:50px; display: flex; align-items: center">

                <a class="navbar-brand me-auto"
                    style="font-weight: 500; text-transform: uppercase; padding-right: 1rem; color:white;"
                    href="{{ route('welcome') }}">Presto.it</a>
            </div>



            <ul class="navbar-nav d-flex align-items-center justify-content-space-center mb-2 mb-lg-0" style="margin-right: 39%;">

                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('welcome') }}">Home</a>
                </li>
                <div class="dropdown show d-flex align-items-center justify-content-center" style="position: relative">
                    <a class="btn dropdown-toggle p-0 px-2 text-center"
                        style="width:100%; back-drop-filter: blur(10px);" type="button" href="#" role="button"
                        id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ __('ui.navCategories') }}
                    </a>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="position: absolute; top: 100%">

                        @if (config('app.locale') == 'gb')
                        @foreach ($categories->where('nationality', 'gb') as $category)
                        <a class="dropdown-item" href="{{ route('category.show', compact('category')) }}" style="text-transform: capitalize">{{ $category->name }}</a>
                    @endforeach
                    @elseif (config('app.locale') == 'it')
                    @foreach ($categories->where('nationality', 'it') as $category)
                    <a class="dropdown-item" href="{{ route('category.show', compact('category')) }}" style="text-transform: capitalize">{{ $category->name }}</a>
                @endforeach
                    @elseif (config('app.locale') == 'es')
                    @foreach ($categories->where('nationality', 'es') as $category)
                    <a class="dropdown-item" href="{{ route('category.show', compact('category')) }}" style="text-transform: capitalize">{{ $category->name }}</a>
                @endforeach
                    @endif


                    </div>
                </div>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('announcements.index') }}">{{ __('ui.navAnnouncements') }}</a>
                </li>
                @if (Auth::check() && Auth::user()->is_revisor)
                    <div class="d-flex align-items-center justify-content-center">
                        <ul class="d-flex align-items-start justify-content-start" style="padding:0px">
                       @livewire('notifica-revisor')
                        </ul>
                    </div>
                @endif

            </ul>
            @if (request()->url() !== route('announcements.index'))

            <form action="{{ route('announcements.search') }}" method="GET"
                class="d-flex justify-content-center align-items-center;" style="">
                <svg viewBox="0 0 24 24" aria-hidden="true" class="icon">
                    <g>
                        <path
                            d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z">
                        </path>
                    </g>
                </svg>
                <input class="input" type="search" placeholder="Search" name="searched" />
            </form>
            @endif
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent" style="margin-left:25%;">
            <ul class="navbar-nav d-flex align-items-center justify-content-center  mb-2 mb-lg-0">
                <div class="dropdown show d-flex align-items-center justify-content-end navRight" style="position: relative">
                    <a class="btn dropdown-toggle p-0 px-2 text-center"
                        style="width:50%; back-drop-filter: blur(10px);" type="button" href="#" role="button"
                        id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ __('ui.navLang') }}
                    </a>

                    <div class="dropdown-menu flag" aria-labelledby="dropdownMenuLink" style="position: absolute; top: 100%; color:black;">
                        <div class="d-flex flex-column align-items-center justify-content-center">
                        <x-locale lang1='it' style="width:30px"><x-flag-country-it
                                style=" width:30px" /> <span style="color: var(--primary-color)">Italiano</span></x-locale>
                        <x-locale lang1='es' style="width:30px"><x-flag-country-es
                                style=" width:30px;" /><span style="color: var(--primary-color)">Espanol</span></x-locale>
                        <x-locale lang1='gb' style="width:30px"><x-flag-country-gb
                                style=" width:30px;" /><span style="color: var(--primary-color)">English</span></x-locale>
                            </div>
                    </div>
                </div>

                @auth
                    <li class="nav-item d-flex  align-items-center ">

                        <button class="btn crea-articolo px-2 mx-2 navRight"
                            style="padding: 0.5px 0px 0.5px 0px; font-size: 12px;"><a
                                style="text-decoration: none; color:white;"
                                href="{{ route('announcements.create') }}">{{__('ui.navMakeAnnouncement')}}</a></button>
                    </li>
                    <form action="/logout" method="POST" style="display: flex; align-items: center">
                        @csrf
                        <button class="btn Logout px-2 mx-2 navRight"
                            style="padding: 0.5px 0px 0.5px 0px; font-size: 12px">{{ __('ui.logout') }}</button>
                    </form>

                @endauth

                @guest
                    <li class="nav-item" style="padding:0px!important">
                        <a class="nav-link" style="margin-right:10px" href="/register">{{ __('ui.register') }}</a>
                    </li>
                    <li class="nav-item" style="padding:0px!important">
                        <a class="nav-link" style="padding:0px;" href="/login">{{ __('ui.login') }}</a>
                    </li>
                @endguest

            </ul>



        </div>
    </div>
</nav>
