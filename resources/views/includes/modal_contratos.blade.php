<div class="modal fade" id="contratosModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Tabela de Contratos</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="mb-2">
                    <label for="contrato" class="form-label custom-label">Contrato</label>
                    <input type="text" id="contrato" name="contrato" class="form-control form-control-sm numeric-input" placeholder="Preencha o campo">
                    <input hidden type="text" id="idContrato">
                </div>
                <div class="text-end">
                    <button type="button" id="contratoSubmit" class="btn btn-sm btn-warning">
                        <span id="contratoSubmitText">Inserir</span>
                        <span id="contratoSubmitSpinner" class="spinner-border spinner-border-sm d-none"></span>
                    </button>
                </div>
            </div>
        </div>
        <div class="modal-footer table-responsive custom-table">
            <table class="table table-sm table-hover text-nowrap">
                <thead>
                    <tr>
                        <th class="text-center">Contrato</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody id="contratoTable">
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
                // Lógica para habilitar/desabilitar botão que abre a modal dos contratos
                function habilitaBtnContratos() {
                    let npj = $('#localizador_npj').val()

                    if(npj.length === 11) {
                        $('#btnContratos').prop('disabled', false)
                    } else {
                        $('#btnContratos').prop('disabled', true)
                    }

                    carregaContratos()
                }

                habilitaBtnContratos()

                $('#localizador_npj').on('input', function() {
                    habilitaBtnContratos()
                })

                // Função que vai carregar os contratos na tabela
                function carregaContratos() {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('contrato.list') }}",
                        success: function(data) {
                            // console.log(data)
                            let localizadorNpj = $('#localizador_npj').val()
                            let contratos = data.contratos.filter(item => item.localizador_npj === localizadorNpj)
                            let qtdContratos = contratos.length
                            let btnContratos = $('#btnContratos')
                            let table = $('#contratoTable')

                            $('#qtdContratos').text(qtdContratos)
                            table.empty()

                            // se tiver contratos faça o corpo da tabela
                            if(qtdContratos > 0) {
                                for(let i=0; i < qtdContratos; i++) {
                                    table.append(`
                                        <tr>
                                            <td>${(contratos[i]['contrato'])}</td>
                                            <td class='text-center'>
                                                <div class="d-flex justify-content-center align-items-center">

                                                    <button type="button" data-id="${(contratos[i]['id'])}" data-contrato="${(contratos[i]['contrato'])}" class="contrato-edit contrato-buttons-crud text-primary fs-6" title="Clique para editar o contrato">
                                                        <i class="fa fa-pencil"></i>
                                                    </button>

                                                    <button type="button" data-id="${(contratos[i]['id'])}" class="contrato-delete contrato-buttons-crud text-danger fs-6" title="Clique para remover o contrato">
                                                            <i class="fa fa-minus-circle"></i>
                                                    </button>

                                                </div>
                                            </td>
                                        </tr>
                                    `)
                                }

                                // muda a cor do botão
                                btnContratos.removeClass('btn-secondary').addClass('btn-success')
                            }
                            // se não, exiba essa mensagem
                            else {
                                table.append("<tr><td colspan='2'>Não existe contrato cadastrado.</td></tr>")

                                // reverte a cor do botão
                                if(btnContratos.hasClass('btn-success')) {
                                    btnContratos.removeClass('btn-success').addClass('btn-secondary')
                                }
                            }
                        }
                    })
                }

                carregaContratos()

                // ========== ÍNICIO CRUD AJAX ==========
                $('#contratoSubmit').click(function() {
                    const typeButton = $('#contratoSubmitText').text()
                    let contrato = $('#contrato').val()
                    let npj = $('#localizador_npj').val()
                    let token = $('meta[name="csrf-token"]').attr('content')

                    function contratoSubmit(boolValue) {
                        let button = $('#contratoSubmit')
                        let textButton = $('#contratoSubmitText')
                        let spinner = $('#contratoSubmitSpinner')

                        if(boolValue) {
                            button.prop('disabled', true)
                            textButton.addClass('d-none')
                            spinner.removeClass('d-none')
                        } else {
                            $('#contrato').val('')
                            button.prop('disabled', false)
                            textButton.removeClass('d-none')
                            spinner.addClass('d-none')
                            carregaContratos()
                        }
                    }

                    function validaContrato() {
                        alert('O contrato deve conter entre 5 e 10 dígitos')
                        $('#contrato').focus()
                        $('#contratoSubmit').prop('disabled', false)
                        $('#contratoSubmitText').removeClass('d-none')
                        $('#contratoSubmitSpinner').addClass('d-none')
                    }

                    // CREATE / INSERT
                    if(typeButton === 'Inserir') {
                        contratoSubmit(true)

                        if(contrato.length < 5 || contrato.length > 10) {
                            validaContrato()
                        } else {
                            $.ajax({
                                type: "POST",
                                url: "{{ route('contrato.store') }}",
                                data: {
                                    contrato: contrato,
                                    localizador_npj: npj,
                                    _token: token
                                },
                                success: function(data) {
                                    // console.log(data)
                                    contratoSubmit(false)
                                },
                                error: function(err) {
                                    console.error(err.responseText)
                                    contratoSubmit(false)
                                }
                            })
                        }
                    }
                    // EDIT / UPDATE
                    else {
                        let id = $('#idContrato').val()

                        contratoSubmit(true)

                        if(contrato.length < 5 || contrato.length > 10) {
                            validaContrato()
                        } else {
                            $.ajax({
                                type: "POST",
                                url: "{{ route('contrato.update') }}",
                                data: {
                                    id: id,
                                    contrato: contrato,
                                    localizador_npj: npj,
                                    _token: token
                                },
                                success: function(data) {
                                    // console.log(data)
                                    contratoSubmit(false)
                                    $('#idContrato').val('')
                                    $('#contratoSubmitText').text('Inserir')
                                },
                                error: function(err) {
                                    console.error(err.responseText)
                                    contratoSubmit(false)
                                }
                            })
                        }
                    }
                })

                setInterval(() => {
                    let contratoEdit = $('.contrato-edit')
                    let contratoDelete = $('.contrato-delete')

                    // Evento clique do botão de editar
                    if(contratoEdit) {
                        contratoEdit.off('click').click(function() {
                            let id = $(this).data('id')
                            let contrato = $(this).data('contrato')

                            $('#contrato').val(contrato).focus()
                            $('#idContrato').val(id)
                            $('#contratoSubmitText').text('Editar')
                        })
                    }

                    // DELETE
                    if(contratoDelete) {
                        contratoDelete.off('click').click(function() {
                            let id = $(this).data('id')
                            let token = $('meta[name="csrf-token"]').attr('content')

                            if(confirm('Deseja remover esse contrato?')) {
                                $.ajax({
                                    type: "POST",
                                    url: "{{ route('contrato.destroy') }}",
                                    data: {
                                        id: id,
                                        _token: token
                                    },
                                    success: function(data) {
                                        // console.log(data)
                                        carregaContratos()
                                    },
                                    error: function(err) {
                                        console.error(err.responseText)
                                        carregaContratos()
                                    }
                                })
                            }
                        })
                    }
                }, 1000)
                // ========== FIM CRUD AJAX ==========
            })
        })
    </script>
@endpush

@push('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@push('css')
    <style>
        .contrato-buttons-crud {
            background: transparent;
            border: none;
        }

        .custom-table {
            font-size: 13px;
            max-height: 30vh;
            overflow-y: auto;
        }
    </style>
@endpush
