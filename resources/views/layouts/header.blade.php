
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="{{ url('room/all') }}">All Rooms <span class="sr-only">(current)</span></a>
            </li>
            @if(auth()->user()->hasRole('admin'))
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('room/new') }}">New Room <span class="sr-only">(current)</span></a>
                </li>
            @else
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('booking/all') }}">My Bookings <span class="sr-only">(current)</span></a>
                </li>
            @endif
        </ul>
        <span class="navbar-text">
            {{ auth()->user()->getFullName() }} ({{ auth()->user()->role }})
        </span>
        <a href="{{ url('logout') }}" style="margin-left: 13px">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Logout</button>
        </a>
    </div>
</nav>
