<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{url('/index')}}">Phone shop</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

                <li class="nav-item">
                    <a class="nav-link" href="{{url('/posts')}}">Posts</a>
                </li>
                @guest
            
                    
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{route('posts.myposts')}}">My Posts</a>
                </li>
                @endguest
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Categories
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">



                        <a class="dropdown-item" href="/Ruddit/public/edit/{{Auth::id()}}">
                            <a class="dropdown-item" href="{{route('posts.cheap')}}">
                            {{ __('Cheap IPhones') }}
                        </a>

                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item" href="{{ route('posts.gaming') }}">
                            {{ __('For Gaming') }}
                        </a>
                        @php($books = App\Models\queries::all())
                        @if(count($books)> 0)
                              @foreach($books as $book)
                              @if ($book->userid == Auth::id())
                               <a class="dropdown-item" href="{{ route('posts.bookfilter', [$book->id]) }}">
                                {{ __($book->bookname) }}
                              </a>
                                @endif
                              @endforeach
                         @endif
                        </form>
                    </div>
                </li>
            </ul>





            <!-- Left Side Of Navbar -->


            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{route('posts.bookmarks')}}">Bookmarks</a>
                </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            @if(Auth::user()->isadmin == 1)
 
                            @endif
                            <a class="dropdown-item" href="/Ruddit/public/edit/{{Auth::id()}}">

                            <!--<a class="dropdown-item" href="/Ruddit/public/edit/{{Auth::id()}}"> -->
                                <a class="dropdown-item" href="{{url('/edit/'.Auth::id())}}">
                                {{ __('Edit profile') }}
                            </a>

                    @if (Auth::user()->el_pasto_patvirtinimas == 0)


                                <a class="dropdown-item" href="{{url('/sendVerify/'.Auth::id())}}">{{ __('Confirm email') }}</a>
                    @endif

                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">


                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>

    </div>
</nav>
