<x-login.layout>

    <div class="pt-4 pb-2">
        <h5 class="card-title text-center pb-0 fs-4">Login</h5>
    </div>

    @if (session('error'))
        <div class="alert alert-danger fs-13 text-center">
            {{ session('error') }}
        </div>
    @endif

    <form id="formLogin" class="row g-3" method="post" action="{{ route('auth.login') }}">
        @csrf

        <div class="col-12">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control @if($errors->has('email')) is-invalid @endif" id="email" value="{{ old('email') }}">
            @include('includes.errors', ['name' => 'email'])
        </div>

        <div class="col-12">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control @if($errors->has('password')) is-invalid @endif" id="password" value="{{ old('password') }}">
            @include('includes.errors', ['name' => 'password'])
            <div class="text-end">
                <a href="{{ route('auth.reset_password') }}" class="fs-13" title="Clique para recuperar sua senha">Esqueceu sua senha?</a>
            </div>
        </div>

        <div class="col-12">
            <button id="btnLogin" class="btn btn-primary w-100" type="submit">Entrar</button>
        </div>
        <div class="col-12">
            <p class="small mb-0">Não tem conta? <a href="{{ route('auth.register') }}">Registre-se</a></p>
        </div>
    </form>

    @push('js')
        <script>
            $(document).ready(function() {
                $(function() {
                    $('#formLogin').submit(function(e) {
                        // e.preventDefault() // debug
                        let button = $('#btnLogin')

                        button.prop('disabled', true) // desabilita o botão
                        button.text('Entrando...') // altera o texto do botão
                        button.removeClass('btn-primary') // remove a cor azul
                        button.addClass('btn-secondary') // add a cor cinza
                    })
                })
            })
        </script>
    @endpush

</x-login.layout>
