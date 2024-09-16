$(document).ready(function() {
    // funções que serão aplicadas no momento que os dados forem enviados para o servidor
    $(function() {
        $('#form').submit(function() {
            // remove o botão de voltar
            let btnVoltar = $('#buttons').find('a')
            btnVoltar.addClass('d-none')

            // desabilita o botão de Salvar/Atualizar e mostra um spinner
            let btnSubmit = $('#buttons').find('button')
            btnSubmit.prop('disabled', true)
            $('#spinner').removeClass('d-none')

            // altera o texto do botão de Salvar/Atualizar
            let element = $('#textButton')
            let btnSubmitText = element.text()
            let newText = btnSubmitText === 'Salvar' ? 'Salvando...' : 'Atualizando...'
            element.text(newText)
        })
    })

    // remove os espaços do começo e final de um valor
    // $(function() {
    //     // função aplicada para todos os elementos que tenha a classe trim
    //     $('.trim').on('input', function() {
    //         let value = $(this).val().trim()

    //         $(this).val(value)
    //     })
    // })

    // bloqueia o teclado para os inputs do tipo data
    $(function() {
        $('input[type="date"').keydown((e) => {
            e.preventDefault()
        })
    })

    // aceita apenas caracteres numéricos
    $(function() {
        // função aplicada para todos os elementos que tenha a classe numeric-input
        $('.numeric-input').on('input', function() {
            let value = $(this).val().replace(/[^0-9]/g, '')

            $(this).val(value)
        })
    })

    // aplica máscara cpf ou cnpj
    $(function() {
        $('#cpf_cnpj').on('input', function() {
            let value = $(this).val().replace(/\D/g, '');

            if(value.length > 11) {
                // se tiver mais de 11 dígitos, trata como CNPJ
                $(this).mask('##.###.###/####-##')
            } else {
                // se tiver 11 dígitos, trata como CPF
                $(this).mask('###.###.###-##')
            }
        })//.trigger('input')
    })

    // aplica máscara monetária
    $(function() {
        $('.money-mask').mask('000.000.000.000.000,00', {
            reverse: true
        })
    })

    // aplica o atributo readonly somente no formulário de visualização
    $(function() {
        const URL = window.location.href

        // pega a url da página e verifica se contém a palavra 'show'
        if(URL.includes('show')) {
            $('#show input, textarea').prop('readonly', true)
            $('#show select').prop('disabled', true).addClass('bg-white')
        }
    })
})
