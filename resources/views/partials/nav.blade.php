<?php
?>
<nav class="navbar navbar-expand-md navbar-light shadow-sm">
    <div class="container">
        <button class="navbar-toggler toggler-dark" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                @foreach($nav['links']['left'] ?? [] as $url => $name)
                    <li class="nav-item">
                        <a class="nav-alink" href="{{ $url }}">{{ $name }}</a>
                    </li>
                @endforeach
            </ul>
            <a class="islewalk-brand" href="{{ url('/') }}">
                Islewalk
            </a>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @foreach($nav['links']['right'] ?? [] as $url => $name)
                    <li class="nav-item">
                        <a class="nav-alink" href="{{ $url }}">{{ $name }}</a>
                    </li>
                @endforeach
                @if($nav['dropdown'] ?? [])
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-alink dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ $nav['dropdown']['title'] }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right drop-transition" aria-labelledby="navbarDropdown">
                            @foreach($nav['dropdown']['links'] as $url => $name)
                                @if($url !== route('logout'))
                                <a class="dropdown-item" href="{{ $url }}">{{ $name }}</a>
                                @else
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Log out') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                @endif
                            @endforeach
                        </div>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
