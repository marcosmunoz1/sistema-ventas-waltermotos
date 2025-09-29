<aside class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}">

    {{-- Sidebar brand logo --}}
    @if(config('adminlte.logo_img_xl'))
        @include('adminlte::partials.common.brand-logo-xl')
    @else
        @include('adminlte::partials.common.brand-logo-xs')
    @endif

    {{-- Sidebar menu --}}
    <div class="sidebar">
        <nav class="pt-2">
            <ul class="nav nav-pills nav-sidebar flex-column {{ config('adminlte.classes_sidebar_nav', '') }}"
                data-widget="treeview" role="menu"
                @if(config('adminlte.sidebar_nav_animation_speed') != 300)
                    data-animation-speed="{{ config('adminlte.sidebar_nav_animation_speed') }}"
                @endif
                @if(!config('adminlte.sidebar_nav_accordion'))
                    data-accordion="false"
                @endif>
                {{-- Configured sidebar links --}}
                @each('adminlte::partials.sidebar.menu-item', $adminlte->menu('sidebar'), 'item')
            </ul>
        </nav>
    </div>
     <li class="nav-item">
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="margin: 0;">
            @csrf
            <div class="logout-wrapper">
                <button type="submit" class="logout-button">
                    <i class="nav-icon fas fa-power-off text-danger"></i>
                    <span class="ml-2">Cerrar Sesión</span>
                </button>
            </div>
        </form>
     </li>




</aside>
<style>
.logout-wrapper {
    margin-left: 9px;
    margin-right: 9px;
    transition: transform 0.3s ease;
}

.logout-wrapper:hover {
    background-color: rgba(255, 255, 255, 0.1);
    border-radius: 4px; /* se extiende hacia la derecha */
}

.logout-button {
    display: flex;
    align-items: center;
    font-size: 17px;
    background-color: transparent;
    border: none;
    color: rgba(255, 255, 255, 0.719);
    padding: 7px 15px;
    border-radius: 8px;
    width: 100%;
}

</style>
