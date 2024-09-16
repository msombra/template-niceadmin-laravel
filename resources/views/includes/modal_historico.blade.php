<div class="modal fade" id="historicoModal" tabindex="-1" aria-labelledby="historicoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="historicoModalLabel">Histórico de Alterações</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($historico->isNotEmpty())
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
                            @foreach ($historico as $log)
                                @php
                                    // Separando e formatando o valor da Data de Inserção
                                    $dateTime = new DateTime($log->created_at);
                                    $dataInsert = $dateTime->format('d/m/Y'); // traz a data separada
                                    $horaInsert = $dateTime->format('H:i'); // traz a hora separada
                                @endphp
                                <tr>
                                    <td>{{ $camposAcordo[$log->campo] ?? $log->campo }}</td>
                                    <td>{{ $log->valor_antigo }}</td>
                                    <td>{{ $log->valor_novo }}</td>
                                    <td>{{ $dataInsert }}</td>
                                    <td>{{ $horaInsert }}</td>
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
