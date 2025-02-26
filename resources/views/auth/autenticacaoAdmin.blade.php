@php
    $usuario = auth()->user();
    $nivelAcesso = $usuario->acesso ?? null;
@endphp

@if ($nivelAcesso !== "Administrador")
    <div class="text-center">
        <img src="{{ asset('images/nao-autorizado.png') }}" alt="Acesso Negado" style="max-width: 300px;">
        <p class="text-danger">Você não tem permissão para acessar esta página.</p>
    </div>
    @php abort(403); @endphp
@endif
