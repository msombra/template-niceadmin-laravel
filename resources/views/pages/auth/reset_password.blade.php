<x-login.layout>

    <div class="pt-4 pb-2">
        <h5 class="card-title text-center pb-0 fs-4">Redefinir Senha</h5>
    </div>

    @if (session('success'))
        <div class="alert alert-success fs-13 text-center">
            <b>{{ session('success') }}</b><br>
            Por favor, verifique sua caixa de email.
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger fs-13 text-center">
            <b>{{ session('error') }}</b><br>
            Por favor, entre em contato com seu <b>Ponto Focal</b> ou com o <b>suporte NIT</b>!
        </div>
    @endif

    <form id="formResetPassword" class="row g-3" method="post" action="{{ route('auth.reset_password') }}">
        @csrf

        <div class="col-12">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" required>
        </div>

        <div class="col-12">
            <button class="btn btn-primary w-100" type="submit">Enviar</button>
        </div>
        <div class="col-12 text-end">
            <p class="small mb-0"><a href="{{ route('auth.login') }}">Voltar a tela de login</a></p>
        </div>
    </form>

    @push('js')
        <script>
            $(document).ready(function() {
                $(function() {
                    $('#formResetPassword').submit(function(e) {
                        // e.preventDefault() // debug
                        let button = $('#btnLogin')

                        button.prop('disabled', true) // desabilita o botão
                        button.text('Enviando...') // altera o texto do botão
                        button.removeClass('btn-primary') // remove a cor azul
                        button.addClass('btn-secondary') // add a cor cinza
                    })
                })
            })
        </script>
    @endpush

</x-login.layout>
