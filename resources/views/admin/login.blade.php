<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Orçamentos - Login</title>
    <link rel="stylesheet" href="/css/admin.css">
</head>
<body>
    <div class="conteudo_login">
        <div class="bloco">
            <h1>Gestor de Orçamentos</h1>
            <div class="imag">
                <img src="/imagens/inicio.jpg" alt="Logo">
            </div>
            <div class="login">
                <h2>Acesse sua Conta</h2>
                @if(session('error'))
                    <p style="color: red;">{{ session('error') }}</p>
                @endif
                <form action="{{ route('login.post') }}" method="POST">
                    @csrf
                    <p>
                        <label for="email">E-mail</label>
                        <input type="email" name="email" id="email" placeholder="Digite seu e-mail">
                    </p>
                    <p>
                        <label for="senha">Senha</label>
                        <input type="password" name="senha" id="senha" placeholder="Digite sua senha">
                    </p>
                    <p>
                        <button type="submit">Entrar</button>
                    </p>
                </form>
            </div>
        </div>
    </div>
    @include('componentes.footer')
</body>
</html>
