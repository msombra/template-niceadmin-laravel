<div class="modal fade" id="historicoModal" tabindex="-1" aria-labelledby="historicoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="historicoModalLabel">Histórico de Alterações</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="max-height: 80vh; overflow-y: auto">
                <ul class="nav nav-tabs" style="font-size: 14px;">
                    <li id="tabCamposPrincipais" class="nav-item">
                        <a href="#" class="nav-link active">Campos Principais</a>
                    </li>
                    <li id="tabContratos" class="nav-item">
                        <a href="#" class="nav-link">Contratos</a>
                    </li>
                </ul>
                <table class="table border border-top-0" style="font-size: 12px;">
                    <thead>
                        <tr>
                            <th id="colCampo">Campo</th>
                            <th>Valor Antigo</th>
                            <th>Novo Valor</th>
                            <th>Responsável</th>
                            <th>Data</th>
                            <th>Hora</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            // Separando e formatando o valor da Data de Inserção
                            function dateTime($value) {
                                $dateTime = new DateTime($value);
                                $dataInsert = $dateTime->format('d/m/Y'); // traz a data separada
                                $horaInsert = $dateTime->format('H:i'); // traz a hora separada

                                echo "<td>$dataInsert</td>\n<td>$horaInsert</td>";
                            }
                        @endphp

                        {{-- ===== HISTÓRICO CONTROLE ACORDOS ===== --}}
                        @if ($historico->isNotEmpty())
                            @foreach ($historico as $log)
                                <tr class="historico-table">
                                    <td>{{ $log->campo }}</td>
                                    <td>{{ $log->valor_antigo }}</td>
                                    <td>{{ $log->valor_novo }}</td>
                                    <td>{{ $log->responsavel }}</td>
                                    {{ dateTime($log->created_at) }}
                                </tr>
                            @endforeach
                        @else
                            <tr class="historico-table">
                                <td colspan="5" class="text-center">
                                    Nenhum campo foi alterado.
                                </td>
                            </tr>
                        @endif
                        {{-- ===== FIM HISTÓRICO 1 ===== --}}

                        {{-- ===== HISTÓRICO CONTRATOS ===== --}}
                        @if($contratoHistorico->isNotEmpty())
                            @foreach ($contratoHistorico as $log)
                                <tr class="contrato-historico-table d-none">
                                    <td>{{ $log->valor_antigo }}</td>
                                    <td>{{ $log->valor_novo }}</td>
                                    <td>{{ $log->responsavel }}</td>
                                    {{ dateTime($log->created_at) }}
                                </tr>
                            @endforeach
                        @else
                            <tr class="contrato-historico-table d-none">
                                <td colspan="4" class="text-center">
                                    Nenhum contrato foi alterado.
                                </td>
                            </tr>
                        @endif
                        {{-- ===== FIM HISTÓRICO 2 ===== --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        $(document).ready(function() {
            $(function() {
                let historicoCamposPrincipais = $('.historico-table')
                let historicoContratos = $('.contrato-historico-table')

                // Evento clique na tab Campos Principais
                $('#tabCamposPrincipais').click(function() {
                    $('#tabContratos a').removeClass('active') // remove o active da tab Contratos
                    $(this).find('a').addClass('active') // add o active na tab Campos Principais
                    $('#colCampo').removeAttr('class') // remove o d-none da coluna Campo da tabela

                    if(historicoCamposPrincipais) {
                        historicoContratos.addClass('d-none') // oculta a tabela dos campos principais
                        historicoCamposPrincipais.removeClass('d-none') // e mostra a tabela de contratos
                    }
                })

                // Evento clique na tab Contratos
                $('#tabContratos').click(function() {
                    $('#tabCamposPrincipais a').removeClass('active') // remove o active da tab Campos Principais
                    $(this).find('a').addClass('active') // add o active na tab Contratos
                    $('#colCampo').addClass('d-none') // add o d-none na coluna Campo da tabela

                    if(historicoContratos) {
                        historicoCamposPrincipais.addClass('d-none') // oculta a tabela dos contratos
                        historicoContratos.removeClass('d-none') // e mostra a tabela dos campos principais
                    }
                })
            })
        })
    </script>
@endpush
