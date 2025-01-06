<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulário de Orçamentos</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: #f0f4f8;
    }

    main {
      text-align: center;
      background: #ffffff;
      padding: 20px 40px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      max-width: 400px;
      width: 100%;
    }

    h1 {
      color: #333333;
      font-size: 1.5rem;
      margin-bottom: 20px;
    }

    .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      background-color: #007bff;
      color: #fff;
      border: none;
      padding: 10px 20px;
      margin: 10px;
      font-size: 1rem;
      border-radius: 5px;
      cursor: pointer;
      text-decoration: none;
      transition: background-color 0.3s ease;
    }

    .btn i {
      margin-right: 10px;
      font-size: 1.2rem;
    }

    .btn:hover {
      background-color: #0056b3;
    }

    a {
      display: block;
      margin-top: 20px;
      color: #007bff;
      text-decoration: none;
      font-size: 0.9rem;
    }

    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <main>
    <h1>Formulário de Orçamentos</h1>
    <h3>Quem solicita o orçamento?</h3>

    <button class="btn" onclick="window.location.href='medico.php';">
      <i class="fas fa-user-md"></i> Médico ou Cirurgião
    </button>
    <button class="btn" onclick="window.location.href='paciente.php';">
      <i class="fas fa-user"></i> Paciente ou Representante
    </button>

    <a href="admin/login.php">Painel</a>
  </main>
</body>
</html>
