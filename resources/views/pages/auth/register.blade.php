<x-login.layout>

    <div class="pt-4 pb-2">
        <h5 class="card-title text-center pb-0 fs-4">Crie uma Conta</h5>
    </div>

    @if (session('success'))
        <div class="alert alert-success fs-13 text-center">
            {{ session('success') }}<br>
            <a href="{{ route('auth.login') }}" class="login-link-after-register">Clique aqui</a> para realizar o login!
        </div>
    @endif

    <form id="formRegister" class="row g-3" method="post" action="{{ route('auth.register') }}">
        @csrf

        <div class="col-12">
            <label for="name" class="form-label">Nome</label>
            <input type="text" name="name" class="form-control @if($errors->has('name')) is-invalid @endif" id="name" value="{{ old('name') }}">
            @include('includes.errors', ['name' => 'name'])
        </div>

        <div class="col-12">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control @if($errors->has('email')) is-invalid @endif" id="email" value="{{ old('email') }}">
            @include('includes.errors', ['name' => 'email'])
        </div>

        <div class="col-12">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control @if($errors->has('password')) is-invalid @endif" id="password" value="{{ old('password') }}">
            @include('includes.errors', ['name' => 'password'])
        </div>

        <div class="col-12">
            <button id="btnRegister" class="btn btn-primary w-100" type="submit">Registrar</button>
        </div>
        <div class="col-12">
            <p class="small mb-0">Já tem uma conta? <a href="{{ route('auth.login') }}">Login</a></p>
        </div>
    </form>

    @push('css')
        <style>
            .login-link-after-register {
                font-weight: bold;
                text-decoration: underline;
                color: #0A3622;
            }
            .login-link-after-register:hover {
                color: #0A3622;
            }
        </style>
    @endpush

    @push('js')
        <script>
            $(document).ready(function() {
                $(function() {
                    $('#formRegister').submit(function(e) {
                        // e.preventDefault() // debug
                        let button = $('#btnRegister')

                        button.prop('disabled', true) // desabilita o botão
                        button.text('Registrando...') // altera o texto do botão
                        button.removeClass('btn-primary') // remove a cor azul
                        button.addClass('btn-secondary') // add a cor cinza
                    })
                })
            })
        </script>
    @endpush
</x-login.layout>
