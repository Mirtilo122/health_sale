<?php

if (!defined('BASE_PATH')) {
    define('BASE_PATH', __DIR__ . '');
}

if (!defined('BASE_URL')) {
    define('BASE_URL', '/admin/');
}

$linkParaUsuarios = BASE_PATH . '\usuarios\usuarios.php';
$linkParaTabelas = BASE_PATH . '\tabelas_de_precos\tabelas.php';
$linkParaPainel = BASE_PATH . '\painel.php';
?>

    <header>

        <div class="logotipo">
            <a href="painel.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-balloon-heart" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="m8 2.42-.717-.737c-1.13-1.161-3.243-.777-4.01.72-.35.685-.451 1.707.236 3.062C4.16 6.753 5.52 8.32 8 10.042c2.479-1.723 3.839-3.29 4.491-4.577.687-1.355.587-2.377.236-3.061-.767-1.498-2.88-1.882-4.01-.721zm-.49 8.5c-10.78-7.44-3-13.155.359-10.063q.068.062.132.129.065-.067.132-.129c3.36-3.092 11.137 2.624.357 10.063l.235.468a.25.25 0 1 1-.448.224l-.008-.017c.008.11.02.202.037.29.054.27.161.488.419 1.003.288.578.235 1.15.076 1.629-.157.469-.422.867-.588 1.115l-.004.007a.25.25 0 1 1-.416-.278c.168-.252.4-.6.533-1.003.133-.396.163-.824-.049-1.246l-.013-.028c-.24-.48-.38-.758-.448-1.102a3 3 0 0 1-.052-.45l-.04.08a.25.25 0 1 1-.447-.224l.235-.468ZM6.013 2.06c-.649-.18-1.483.083-1.85.798-.131.258-.245.689-.08 1.335.063.244.414.198.487-.043.21-.697.627-1.447 1.359-1.692.217-.073.304-.337.084-.398"/>
                    </svg>
            </a>
        </div>
        
        <div class="barra"></div>

        <div class="nome_pagina">
                <h1 class="titulo">INÍCIO</h1>
        </div>

        <div class="acesso">
            
        </div>

        <div class="barra"></div>

        

        <div class="config">
    <a href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-toggle="tooltip" title="Configurações">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
            <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
        </svg>
    </a>

    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="<?php echo 'usuarios/usuarios.php'; ?>">Painel</a></li>
        <li><a class="dropdown-item" href="<?php echo $linkParaTabelas; ?>">Tabelas de Preço</a></li>
        <li><a class="dropdown-item" href="<?php echo BASE_PATH . 'usuarios/usuarios.php'; ?>">Usuários</a></li>
        <li><a class="dropdown-item" href="logout.php">Sair</a></li>
    </ul>
</div>


    </header>