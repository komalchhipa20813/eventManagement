
<nav class="sidebar">
    <div class="sidebar-header">
        <img  src="{{ asset('assets/images/logo.jpg') }}" class="header-logo" height="50px" width="130px" alt="" style="display: none">
        <div class="sidebar-toggler active">
        <span></span>
        <span></span>
        <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item {{ active_class(['/']) }}">
                <a href="{{ route('dashboard') }}" class="nav-link">
                <i class="link-icon" data-feather="box"></i>
                <span class="link-title">Dashboard</span>
                </a>
            </li>
            <li
                class="nav-item {{ active_class(['event']) }}">
                <a href="{{ route('event.index') }}" class="nav-link {{ active_class(['event']) }}">
                    <i class="link-icon" data-feather="file-text"></i>
                    <span class="link-title">Event</span>
                </a>
            </li>
            <li
                class="nav-item {{ active_class(['event-gallary']) }}">
                <a href="{{ route('event-gallery.index') }}" class="nav-link {{ active_class(['event-gallary']) }}">
                    <i class="link-icon" data-feather="grid"></i>
                    <span class="link-title">Photos</span>
                </a>
            </li>
            @if(Auth::user()->role == 1)
            <li
                class="nav-item {{ active_class(['user']) }}">
                <a href="{{ route('user.index') }}" class="nav-link {{ active_class(['user']) }}">
                    <i class="link-icon" data-feather="user"></i>
                    <span class="link-title">User</span>
                </a>
            </li>
            @endif
             <!-- <li class="nav-item nav-category">Retinue <MAIN></MAIN>aster</li> -->
            
        </ul>
    </div>
</nav>
