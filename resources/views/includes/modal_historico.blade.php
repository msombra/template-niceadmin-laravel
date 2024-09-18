<div class="modal fade" id="historicoModal" tabindex="-1" aria-labelledby="historicoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="historicoModalLabel">Histórico de Alterações</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="max-height: 80vh; overflow-y: auto">
                @if ($historico->isNotEmpty() || $contratoHistorico->isNotEmpty())
                    <table class="table table-bordered" style="font-size: 12px;">
                        <thead>
                            <tr>
                                <th>Campo</th>
                                <th>Valor Antigo</th>
                                <th>Novo Valor</th>
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
                            @foreach ($historico as $log)
                                <tr>
                                    <td>{{ $log->campo }}</td>
                                    <td>{{ $log->valor_antigo }}</td>
                                    <td>{{ $log->valor_novo }}</td>
                                    {{ dateTime($log->created_at) }}
                                </tr>
                            @endforeach
                            @foreach ($contratoHistorico as $log)
                                <tr>
                                    <td>{{ $log->campo }}</td>
                                    <td>{{ $log->valor_antigo }}</td>
                                    <td>{{ $log->valor_novo }}</td>
                                    {{ dateTime($log->created_at) }}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    Não existe histórico para esse acordo.
                @endif
            </div>
        </div>
    </div>
</div>
