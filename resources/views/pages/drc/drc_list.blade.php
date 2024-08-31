<x-layout pagetitle="DRC - Acordos">

    <div class="d-flex justify-content-end mb-4">
        <a href="{{ route('drc.create') }}" class="btn btn-sm btn-primary shadow-sm mx-2">Inserir Novo Acordo</a>
        <a href="{{ route('drc.export') }}" class="btn btn-sm btn-success shadow-sm">Exportar Planilha <i class="bi bi-file-earmark-excel-fill"></i></a>
    </div>

    {{-- Tabela --}}
    <table class="table table-sm table-hover text-nowrap text-center datatable" style="width: 100%; cursor: default;">
        <thead>
            <tr>
                {{-- <th hidden class="text-center">ID</th> --}}
                <th class="text-center">Localizador (NPJ)</th>
                <th class="text-center">Tipo Recuperação</th>
                <th class="text-center">Adverso Principal</th>
                <th class="text-center">MCI</th>
                <th class="text-center">Contratos</th>
                <th class="text-center order-by">Data Inserção</th>
                <th class="text-center">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($acordos as $acordo)
                <tr>
                    {{-- <td hidden class="text-start">{{ $acordo->id }}</td> --}}
                    <td class="text-start">{{ $acordo->localizador_npj }}</td>
                    <td>{{ $acordo->tipo_recuperacao }}</td>
                    <td>{{ $acordo->adverso_principal }}</td>
                    <td class="text-center">{{ $acordo->mci }}</td>
                    <td class="text-center">0</td>
                    <td class="text-start">{{ date("d/m/Y H:i", strtotime($acordo->updated_at)) }}</td>
                    {{-- Ações --}}
                    <x-button.actions route="drc" :data-id="$acordo->id" />
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Plugins --}}
    @include('includes.datatable')
    @include('includes.toasts')

</x-layout>
