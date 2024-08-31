<li>
    <a href="{{ route($route) }}" @if (Route::is($route)) class="active" @endif>
        <i class="bi bi-circle">
        </i><span>{{ $subItem }}</span>
    </a>
</li>
