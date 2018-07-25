<div class="dropdown">
    <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
        <span class="ml-2 d-none d-lg-block">
            <span class="text-default">{{ $USER->name }}</span>
            <small class="text-muted d-block mt-1">
                {{ $USER->role == 1 ? 'Super Administrador' : ($USER->role == 2 ? 'Admin' : ($USER->role == 3 ? 'Gestor' : ('Observador') ) ) }}
            </small>
        </span>
    </a>
    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
        <a class="dropdown-item" href="{!! url(config('tabler.urls.logout')) !!}" id="logout-button">
            <i class="dropdown-icon fe fe-log-out"></i> Salir
        </a>
    </div>
</div>
