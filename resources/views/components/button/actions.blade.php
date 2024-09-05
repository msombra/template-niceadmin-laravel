<td class="text-center">
    <div class="d-flex justify-content-center align-items-center">
        {{-- view --}}
        <a href="{{ route("$route.show", $dataId) }}" class="btn btn-sm btn-warning shadow-sm" title="Visualizar registro"><i class="bi bi-eye-fill"></i></a>
        {{-- edit --}}
        <a href="{{ route("$route.edit", $dataId) }}" class="btn btn-sm btn-success shadow-sm mx-1" title="Editar registro"><i class="fa fa-pencil-square-o"></i></a>
        {{-- delete --}}
        <form action="{{ route("$route.destroy", $dataId) }}" method="post">
            @method('delete')
            @csrf
            <button type="submit" class="btn btn-sm btn-danger shadow-sm" title="Deletar registro" onclick="return confirm('Deseja excluir esse registro?')">
                <i class="bi bi-trash"></i>
            </button>
        </form>
    </div>
</td>
