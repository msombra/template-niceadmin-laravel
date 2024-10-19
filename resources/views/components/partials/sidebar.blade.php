<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        {{-- Dashboard --}}
        <x-sidebar.menu-link item="Dashboard" icon="bi bi-grid" route="index" />

        {{-- DRC --}}
        <x-sidebar.menu-dropdown id="drc" item="DRC" icon="fa fa-handshake-o">

            <x-sidebar.submenu-link sub-item="Lista de Acordos" route="drc.list" />

            <x-sidebar.submenu-link sub-item="Cadastrar Acordo" route="drc.create" />

        </x-sidebar.menu-dropdown>

        {{-- Usuários --}}
        {{-- <x-sidebar.menu-link item="Usuários" icon="bi bi-people" route="user.index" /> --}}
        @can('admin_only')
            <x-sidebar.menu-link item="Usuários" icon="bi bi-people" route="user.index" />
        @endcan

    </ul>

</aside>
