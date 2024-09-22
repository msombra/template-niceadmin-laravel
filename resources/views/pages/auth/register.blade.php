<x-login.layout>

    <div class="pt-4 pb-2">
        <h5 class="card-title text-center pb-0 fs-4">Crie uma Conta</h5>
    </div>

    <form class="row g-3 needs-validation" method="post" action="{{ route('auth.register') }}">
        @csrf

        <div class="col-12">
            <label for="name" class="form-label">Nome</label>
            <input type="text" name="name" class="form-control" id="name" required>
            <div class="invalid-feedback">Please, enter your name!</div>
        </div>

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
            <button class="btn btn-primary w-100" type="submit">Registrar</button>
        </div>
        <div class="col-12">
            <p class="small mb-0">Já tem uma conta? <a href="{{ route('auth.login') }}">Login</a></p>
        </div>
    </form>

</x-login.layout>
