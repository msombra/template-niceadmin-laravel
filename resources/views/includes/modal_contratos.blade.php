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
                    <input type="text" id="contrato" name="contrato" class="form-control form-control-sm">
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
            <tr>
                <th class="text-center">Contrato</th>
                <th class="text-center">Ações</th>
            </tr>
            {{-- <thead>
                <tr>
                    <th class="text-center">Contrato</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td id="output" class="text-center">1</td>
                    <td class="text-center">2</td>
                </tr>
            </tbody> --}}
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
                    
                    $('#contratoLocalizadorNpj').val(value)
                })
            })

            $(function() {
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
                    }

                    $.ajax({
                        type: "POST",
                        url: "{{ route('contrato.store') }}",
                        data: data,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            //$('#output').text(data.response)
                            afterProcessing()
                        },
                        error: function(err) {
                            //$('#output').text('falhou')
                            afterProcessing()
                        }
                    })
                })
            })

            $(function() {
                $.ajax({
                    type: "GET",
                    url: "{{ route('contrato.table') }}",
                    success: function(data) {
                        console.log(data)
                        let qtdContratos = data.contratos.length

                        if(qtdContratos > 0) {
                            for(let i=0; i < qtdContratos; i++) {
                                $('#contratosTable').append(`<tr>
                                    <td>${(qtdContratos[i]['contrato'])}</td>
                                </tr>`)
                            }
                        } else {

                        }
                    },
                    error: function(err) {
                        console.log(err.responseText)
                    }
                })
            })
        })
    </script>
@endpush