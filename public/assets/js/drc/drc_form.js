$(document).ready(function() {
    // regra no campo Percentual Honorários
    $(function() {
        let inputPercent = $('#percentual_honorarios')

        // aplica máscara de percentual(%)
        inputPercent.mask('00.00%', {
            reverse: true
        })

        // limpa campo caso o input só tenha o valor '%'
        inputPercent.change(function() {
            let value = $(this).val()

            if(value == '%') {
                $(this).val('')
            }
        })
    })

    // função que ativa o menu DRC nas páginas que pertence a esse menu e que não esteja nos submenus
    $(function() {
        // ID do menu DRC
        let menuDrc = $('#drc')

        // se o menu não tiver a classe show
        if(!menuDrc.hasClass('show')) {
            // adiciona a classe show
            menuDrc.addClass('show')
            // remove a classe collapsed do elemento anterior
            menuDrc.prev().removeClass('collapsed')
        }
    })
})
