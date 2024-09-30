<x-login.layout>

    <div class="pt-4 pb-2">
        <h5 class="card-title text-center pb-0 fs-4">Criar Senha de Acesso</h5>
    </div>

    @if (session('success'))
        <div class="alert alert-success fs-13 text-center">
            {{ session('success') }}<br>
            <a href="{{ route('auth.login') }}" class="login-link-after-register">Clique aqui</a> para realizar o login!
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger fs-13 text-center">
            <b>{{ session('error') }}</b><br>
            Por favor, entre em contato com seu <b>Ponto Focal</b> ou com o <b>suporte NIT</b>!
        </div>
    @endif

    <form class="row g-3" method="post" action="{{ route('auth.create_password') }}">
        @csrf

        <input type="hidden" name="email" value="{{ Crypt::decrypt($email) }}">

        <div class="col-12">
            <label for="password" class="form-label">Senha</label>
            <input type="password" name="password" class="form-control" id="password" required>
        </div>

        {{-- <div class="col-12">
            <label for="password" class="form-label">Confirmar Senha</label>
            <input type="password" class="form-control" id="confirmPassword" required>
        </div> --}}

        <div class="col-12">
            <button class="btn btn-primary w-100" type="submit">Enviar</button>
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

</x-login.layout>
