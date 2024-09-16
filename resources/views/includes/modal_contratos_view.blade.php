<div class="modal fade" id="contratosModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tabela de Contratos</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body table-responsive custom-table">
                <table class="table table-sm table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th class="text-center">Contrato</th>
                        </tr>
                    </thead>
                    <tbody id="contratoTable">
                        @foreach ($contratos as $data)
                            <tr>
                                <td class="text-center">{{ $data->contrato }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('css')
    <style>
        .custom-table {
            font-size: 13px;
            max-height: 37vh;
            overflow-y: auto;
        }
    </style>
@endpush
