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
        <tbody>
            @foreach ($acordos as $acordo)
                <tr>
                    <td class="text-start">{{ $acordo->localizador_npj }}</td>
                    <td>{{ $acordo->tipoRecuperacaoAux->nome }}</td>
                    <td class="txt-wrap">{{ $acordo->adverso_principal }}</td>
                    <td class="text-center">{{ $acordo->mci }}</td>
                    {{-- <td class="text-center">0</td> --}}
                    <td class="txt-wrap">{{ $acordo->responsavel }}</td>
                    <td class="text-start">{{ date("d/m/Y H:i", strtotime($acordo->updated_at)) }}</td>
                    {{-- Ações --}}
                    <x-button.actions route="drc" :data-id="$acordo->id" btn-show />
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Plugins --}}
    @include('includes.datatable')
    @include('includes.toasts')

    {{-- Script --}}
    @push('js')
        <script>
            $(document).ready(function() {
                // --- Regras no botão de exportar planilha ---
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
        </script>
    @endpush

</x-layout>
