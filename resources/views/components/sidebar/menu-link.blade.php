<li class="nav-item">
    <a class="nav-link  {{ Route::is($route) ? '' : 'collapsed' }}" href="{{ route($route) }}">
        <i class="{{ $icon }}"></i>
        <span>{{ $item }}</span>
    </a>
</li>
