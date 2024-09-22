<x-login.layout>

    <div class="pt-4 pb-2">
        <h5 class="card-title text-center pb-0 fs-4">Login</h5>
    </div>

    @if (session('error'))
        <div class="alert alert-danger fs-13 text-center">
            {{ session('error') }}
        </div>
    @endif

    <form class="row g-3 needs-validation" method="post" action="{{ route('auth.login') }}">
        @csrf

        <div class="col-12">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" required>
            <div class="invalid-feedback">Please enter a valid Email adddress!</div>
        </div>

        <div class="col-12">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password" required>
            <div class="invalid-feedback">Please enter your password!</div>
        </div>

        <div class="col-12">
            <button class="btn btn-primary w-100" type="submit">Entrar</button>
        </div>
        <div class="col-12">
            <p class="small mb-0">Não tem conta? <a href="{{ route('auth.register') }}">Registre-se</a></p>
        </div>
    </form>

</x-login.layout>
