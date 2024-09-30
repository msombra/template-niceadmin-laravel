<style>
    a {
        background-color: #4C83EE;
        padding: 8px;
        color: white;
        text-decoration: none;
        font-family: Arial;
        border-radius: 4px;
        font-size: 14px;
    }

    a:hover {
        color: white;
    }
</style>

<p>Prezado {{ $userName }},</p>

<p>
    Clique no botão abaixo para definir sua senha de acesso ao sitema Suit BB:
</p>

<a href="{{ route('auth.set_password', Crypt::encrypt($userEmail)) }}" target="_blank">Definir Senha</a>
