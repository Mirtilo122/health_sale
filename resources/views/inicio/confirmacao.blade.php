<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmação de Envio - Health Sales</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .confirmation-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        .alert-success {
            text-align: center;
            font-size: 1.2rem;
            font-weight: bold;
        }
        h1 {
            font-size: 1.5rem;
            color: #343a40;
            margin-top: 20px;
        }
        p {
            font-size: 1rem;
            color: #495057;
            margin-bottom: 20px;
        }
        .protocolo-info {
            text-align: center;
            margin-top: 30px;
        }
        .protocolo-info h1 {
            font-size: 1.5rem;
            color: #198754;
        }
        .protocolo-info p {
            font-size: 1.2rem;
            color: #212529;
            font-weight: bold;
        }
        .alert-warning {
            margin-top: 15px;
            font-size: 0.9rem;
            color: #856404;
            background-color: #fff3cd;
            border: none;
        }
        .btn-primary {
            margin-top: 30px;
            display: block;
            width: 100%; 
        }
    </style>
</head>
<body>
    <div class="confirmation-container">
        <div class="alert alert-success" role="alert">
            Formulário enviado com sucesso!
        </div>

        <h1>Solicitante:</h1>
        <p>{{ session('nome_solicitante') }}</p>

        <h1>Paciente:</h1>
        <p>{{ session('nome_paciente') }}</p>

        <div class="protocolo-info">
            <h1>Número de Protocolo:</h1>
            <p>{{ session('protocolo') }}</p>
            <div class="alert alert-warning" role="alert">
                Atenção! Guarde o número de protocolo para acompanhar o seu orçamento!
            </div>
        </div>

        <a href="inicio" class="btn btn-primary">Voltar à Página Inicial</a>
    </div>
</body>
</html>
