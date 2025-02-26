@php
    $idUsuario = auth()->id();
    $usuario = auth()->user();
    $nivelAcesso = $usuario->acesso;

    $podeAcessarTudo = in_array($nivelAcesso, ['Administrador', 'Gerente']);
@endphp

@if (!$podeAcessarTudo)
    <div class="text-center">
        <img src="{{ asset('images/nao-autorizado.png') }}" alt="Acesso Negado" style="max-width: 300px;">
        <p class="text-danger">Você não tem permissão para acessar esta página.</p>
    </div>
    @php abort(403); @endphp
@endif
