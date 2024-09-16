<form id="form" method="post" class="row gy-4 gx-3" action="{{ route($action, $dataId ?? null) }}">
    {{-- token --}}
    @csrf

    {{-- content --}}
    {{ $slot }}

    {{-- buttons --}}
    <div id="buttons" class="text-center card-footer">
        <a href="{{ route($routeList) }}" class="btn btn-secondary rounded-pill shadow-sm">Voltar</a>
        <button type="submit" class="btn btn-primary mx-1 rounded-pill shadow-sm">
            <span id="spinner" class="spinner-border spinner-border-sm d-none"></span>
            <!-- se o nome da rota tiver 'store', o texto do botão será Salvar -->
            <span id="textButton">{{ str_contains($action, 'store') ? 'Salvar' : 'Atualizar' }}</span>
        </button>
    </div>
</form>
