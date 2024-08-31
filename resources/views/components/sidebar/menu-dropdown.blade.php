@php
    # Para entender essa lógica, consulte o arquivo: NOTAS/IS_ACTIVE
    $isActive = str_contains($slot->toHtml(), 'class="active"');
@endphp

<li class="nav-item">
    <a class="nav-link {{ $isActive ? '' : 'collapsed' }}" data-bs-target="#{{ $id }}" data-bs-toggle="collapse" href="#">
        <i class="{{ $icon }}"></i>
        <span>{{ $item }}</span>
        <i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <!-- Dropdown -->
    <ul id="{{ $id }}" class="menu-item nav-content collapse @if($isActive) show @endif">
        <!-- component submenu-link -->
        {{ $slot }}
    </ul>
</li>
