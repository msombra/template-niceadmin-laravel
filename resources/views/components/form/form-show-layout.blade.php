<div id="show" class="row gy-4 gx-3">
    {{-- content --}}
    {{ $slot }}

    {{-- button --}}
    <div class="text-center card-footer">
        <a href="{{ route($routeList) }}" class="btn btn-secondary rounded-pill shadow-sm">Voltar</a>
    </div>
</div>
