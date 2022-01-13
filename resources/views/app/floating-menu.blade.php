<nav class="floating-menu">

    <input type="checkbox" href="#" class="menu-open" name="menu-open" id="menu-open">

    <label class="menu-open-button" for="menu-open">
        <span class="lines line-1"></span>
        <span class="lines line-2"></span>
        <span class="lines line-3"></span>
    </label>
    
    <a href="{{ route('admin.dashboard') }}" class="menu-item item-1" data-toggle="tooltip" data-placement="top" title="Admin Dashboard">
        <i class="fas fa-user-shield"></i>
    </a>
    
    @stack('floatMenuItems')

</nav>