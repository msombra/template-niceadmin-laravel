<div class="modal fade" id="contratosModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tabela de Contratos</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="contratosForm">
                @csrf
                <div class="mb-3 row">
                  <div class="col-md-8">
                    <label for="contrato" class="form-label custom-label">Contrato</label>
                    <input type="text" id="contrato" name="contrato" class="form-control form-control-sm numeric-input" placeholder="Preencha o campo">
                    <input hidden type="text" id="contratoLocalizadorNpj" name="localizador_npj" class="numeric-input">
                  </div>
                  <div class="col-md-2 d-flex align-self-end">
                    <button class="btn btn-sm btn-warning">
                        <span id="inserirContrato">Inserir</span>
                        <span id="spinnerContrato" class="spinner-border spinner-border-sm d-none"></span>
                    </button>
                  </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <table id="contratosTable" class="table table-sm table-hover text-nowrap" style="font-size: 13px;">
            <thead>
                <tr>
                    <th class="text-center">Contrato</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody id="listaContratos">
                {{-- Aqui carrega os contratos via ajax --}}
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
                $('#localizador_npj').change(function() {
                    let value = $(this).val()

                    if(value.length === 11) {
                        $('#btnContratos').prop('disabled', false)
                    } else {
                        $('#btnContratos').prop('disabled', true)
                    }

                    $('#contratoLocalizadorNpj').val(value)
                })
            })

            $(function() {
                function carregaContratos() {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('contrato.list') }}",
                        success: function(data) {
                            let npj = $('#localizador_npj').val()
                            let contratos = data.contratos.filter(item => item.localizador_npj === npj)
                            let qtdContratos = contratos.length

                            $('#listaContratos').empty()

                            if(qtdContratos > 0) {
                                for(let i=0; i < qtdContratos; i++) {
                                    $('#listaContratos').append(`
                                        <tr>
                                            <td>${(contratos[i]['contrato'])}</td>
                                            <td class='text-center'>
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <button type="button" class="contrato-edit contrato-buttons-crud text-primary fs-6" title="Editar contrato"><i class="fa fa-pencil"></i></button>
                                                    <form action="#" method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <button type="submit" class="contrato-buttons-crud text-danger fs-6" title="Deletar contrato" onclick="return confirm('Deseja excluir esse contrato?')">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    `)
                                }
                            }

                            $('.contrato-edit').click(function() {
                                let contrato = $(this).closest('tr').find('td:first').text()

                                $('#contrato').val(contrato)
                                $('#inserirContrato').text('Editar')
                            })
                        },
                        error: function(err) {
                            console.log(err.responseText)
                        }
                    })
                }

                carregaContratos()

                $('#contratosForm').submit(function(e) {
                    e.preventDefault()

                    let form = $(this)[0]
                    let data = new FormData(form)
                    let button = $(this).find('button')

                    button.prop('disabled', true)
                    $('#inserirContrato').addClass('d-none')
                    $('#spinnerContrato').removeClass('d-none')

                    function afterProcessing() {
                        $('#contrato').val('')
                        button.prop('disabled', false)
                        $('#inserirContrato').removeClass('d-none')
                        $('#spinnerContrato').addClass('d-none')
                        carregaContratos()
                    }

                    $.ajax({
                        type: "POST",
                        url: "{{ route('contrato.store') }}",
                        data: data,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            afterProcessing()
                        },
                        error: function(err) {
                            afterProcessing()
                        }
                    })
                })

            })

        })
    </script>
@endpush

@push('plugin_css')
    <style>
        .contrato-buttons-crud {
            background: transparent;
            border: none;
        }
    </style>
@endpush