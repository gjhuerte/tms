<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">{{ config('app.name') }}</a>
    <button 
        class="navbar-toggler" 
        type="button" 
        data-toggle="collapse" 
        data-target="#navbarText" 
        aria-controls="navbarText"
        aria-expanded="false" 
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
            @php
                $appNavigations = \App\Http\Packages\Navigation\Navigation::all();
            @endphp

            @foreach($appNavigations as $navigation)
                @if($navigation->hasSubNavigation)
                    <li class="nav-item dropdown">
                        <a 
                            class="nav-link dropdown-toggle" 
                            href="#" 
                            id="maintenance-navbar-dropdown" 
                            role="button" 
                            data-toggle="dropdown"
                            aria-haspopup="true" 
                            aria-expanded="false">
                            {{ $navigation->name }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="maintenance-navbar-dropdown">
                            @foreach($navigation->subNavigation as $subNavigation)
                                <a class="dropdown-item" href="{{ $subNavigation->url }}">
                                    {{ $subNavigation->name }}
                                </a>
                            @endforeach
                        </div>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ $navigation->url }}">
                            {{ $navigation->name }}
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>

        @include('layouts.partials.right_navigation')
    </div>
</nav>
