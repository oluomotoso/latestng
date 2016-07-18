<!-- Mobile Menu -->
<nav id="mobile-nav">
    <div>
    <ul>
    <li>
        <a href="{{url('/')}}">Home</a>
    </li>
    <!-- .dropdown .menu-color1 -->

    <!-- Fullwith Mega Menu -->
    <!-- Mega Menu -->
    <li>
        <a href="{{url('/category/entertainment')}}">Entertainment</a>
        </li>
    <li class="dropdown mega-full menu-color4">
        <a href="{{url('/category/business')}}">Business</a>
    </li>
    <li>
        <a href="{{url('/category/politics')}}">Politics</a>
        </li>
    <li class="dropdown mega-full menu-color4">
        <a href="{{url('/category/health')}}">Health</a>
        </li>
    <!-- .dropdown .mega-full .menu-color4 -->
    <li>
        <a href="{{url('/category/science')}}">Science
            & Tech</a>

    </li>

    <li>
        <a href="#">Others</a>
        <ul>
            @foreach($others as $other)
            <li>
                <a href="category/{{$other->category->category}}">{{$other->category->category}}</a>
            </li>
            @endforeach
        </ul>
        <!-- dropdown-menu -->
    </li>
    <!-- .dropdown .menu-color1 -->
    <!-- End Dropdown List Menu -->

    </ul>
    </div>
</nav>