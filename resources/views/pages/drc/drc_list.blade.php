<x-layout pagetitle="DRC - Acordos">

    <div class="d-flex justify-content-end mb-4">
        <a href="{{ route('drc.create') }}" class="btn btn-sm btn-primary shadow-sm mx-2">Inserir Novo Acordo</a>
        <form method="get" action="{{ route('drc.export') }}" id="exportBtn">
            <button type="submit" class="btn btn-sm btn-success shadow-sm">
                <span id="exportBtnSpinner" class="spinner-border spinner-border-sm d-none"></span>
                <span id="exportBtnText">
                    Exportar Planilha <i class="bi bi-file-earmark-excel-fill"></i>
                </span>
            </button>
        </form>
    </div>

    {{-- Tabela --}}
    <table class="table table-sm table-hover text-nowrap text-center datatable" style="width: 100%; cursor: default;">
        <thead>
            <tr>
                <th class="text-center">Localizador (NPJ)</th>
                <th class="text-center">Tipo Recuperação</th>
                <th class="text-center">Adverso Principal</th>
                <th class="text-center">MCI</th>
                {{-- <th class="text-center">Contratos</th> --}}
                <th class="text-center">Responsável</th>
                <th class="text-center order-by">Data Inserção</th>
                <th class="text-center">Ações</th>
            </tr>
        </thead>
    </table>

    {{-- Plugins --}}
    {{-- @include('includes.datatable') --}}
    @include('includes.toasts')

    @push('plugin_css')
        <link href="{{ asset('plugins/DataTables/datatables.min.css') }}" rel="stylesheet">
    @endpush

    {{-- Script --}}
    @push('js')
        <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                // ---  ---
                $(function() {
                    $('.datatable').DataTable({
                        serverSide: true,
                        ajax: "{{ route('drc.getAcordosDrc') }}",
                        columns: [
                            { data: 'localizador_npj' },
                            { data: 'tipo_recuperacao' },
                            { data: 'adverso_principal', className: 'txt-wrap' },
                            { data: 'mci' },
                            { data: 'responsavel', className: 'txt-wrap' },
                            { data: 'updated_at', type: 'date' },
                            { data: 'acoes', orderable: false, searchable: false },
                        ],
                        language: {
                            lengthMenu: "Mostrar _MENU_ registros por página",
                            search: "Pesquisar:",
                            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                            infoEmpty: "Mostrando 0 a 0 de 0 registros",
                            infoFiltered: "(filtrado de _MAX_ registros totais)",
                            zeroRecords: "Nenhum registro encontrado",
                            emptyTable: "Nenhum dado disponível na tabela",
                            loadingRecords: "Carregando acordos..."
                        },
                        // order: [orderBy, 'desc']
                    })
                })

                // --- Regras no botão de exportar planilha ---
                $(function() {
                    $('#exportBtn').submit(function(e) {
                        // e.preventDefault()
                        let btn = $(this).find('button')
                        let btnText = $('#exportBtnText')
                        let spinner = $('#exportBtnSpinner')

                        btn.prop('disabled', true) // aplica disabled no botão
                        btnText.text('Exportando...') // altera o texto do botão
                        spinner.removeClass('d-none') // mostra um spinner no botão

                        // recarrega a página logo após a execução do evento
                        setTimeout(() => {
                            location.reload();
                        }, 500)
                    })
                })
            })
        </script>
    @endpush

</x-layout>
