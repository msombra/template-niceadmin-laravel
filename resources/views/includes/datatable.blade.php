@push('plugin_css')
    <link href="{{ asset('plugins/DataTables/datatables.min.css') }}" rel="stylesheet">
@endpush

@push('plugin_js')
    <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // a ordenação será aplicada na coluna que terá a classe order-by
            const orderBy = $('.order-by').index()

            $('.datatable').DataTable({
                language: {
                    lengthMenu: "Mostrar _MENU_ registros por página",
                    search: "Pesquisar:",
                    info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                    infoEmpty: "Mostrando 0 a 0 de 0 registros",
                    infoFiltered: "(filtrado de _MAX_ registros totais)",
                    zeroRecords: "Nenhum registro encontrado",
                    emptyTable: "Nenhum dado disponível na tabela"
                },
                order: [orderBy, 'desc']
            });
        });
    </script>
@endpush
