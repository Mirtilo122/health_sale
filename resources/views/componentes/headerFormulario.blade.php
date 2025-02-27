<header>
        <div class="logotipo">
            <a href="/inicio">
                <img src="/imagens/logotipo.jpg" alt="Hospital Dois Pinheiros">
            </a>
        </div>

        @php
            $usuario = session('nome');
        @endphp


        <div class="nome_pagina">
                <h1 class="titulo">@yield('nome_pagina')</h1>
        </div>

        <div class="acesso">

        </div>

        <div class="barra"></div>



        <div class="config">
<!--    <a href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" data-bs-toggle="tooltip" title="Configurações">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
            <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
        </svg>
    </a>

    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="/inicio">Início</a></li>
        <li><a class="dropdown-item" href="/usuarios">Usuários</a></li>
        <li><a class="dropdown-item" href="/modelos">Modelos</a></li>
        <li><a class="dropdown-item" href="/prestadores">Prestadores</a></li>
        <li><a class="dropdown-item" href="/logout">Sair</a></li>
    </ul> -->
</div>


    </header>
