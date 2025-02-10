    <div class="card shadow-sm p-4 pt-0 pb-0">
        <div class="d-flex justify-content-between align-items-center border-bottom" style="height: 5rem; padding: 0px;">
            <h2 class="text-primary">Solicitação #{{$solicitacao->codigo_solicitacao}}</h2>
            <span class="badge bg-secondary">Protocolo: {{$solicitacao->protocolo}}</span>
            @if($solicitacao->urgencia == 1)
                <div class="text-danger d-flex align-items-center" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="urgent-icon bi bi-exclamation-triangle" viewBox="0 0 16 16">
                        <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.15.15 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.2.2 0 0 1-.054.06.1.1 0 0 1-.066.017H1.146a.1.1 0 0 1-.066-.017.2.2 0 0 1-.054-.06.18.18 0 0 1 .002-.183L7.884 2.073a.15.15 0 0 1 .054-.057m1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767z"/>
                        <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
                    </svg>
                    <span>Urgente</span>
                </div>
            @else

            @endif
            <div class="info  p-2 rounded" style="font-size: 1rem;">
            <strong>Arquivo:</strong>
            @if(is_null($solicitacao->arquivo_pdf))
                <p class="text-danger">Solicitação não foi enviada</p>
            @else
                @php
                    $caminhoArquivo = asset($solicitacao->arquivo_pdf);
                @endphp
                <a href="{{ $caminhoArquivo }}" class="btn btn-primary" download>Baixar Arquivo</a>
            @endif
            </div>
        </div>

        <div class="row mt-1">
            <div class="col-md-4">
                <p><strong>Nome do Solicitante:</strong> {{$solicitacao->nome_solicitante}}</p>
                <p><strong>Nome do Paciente:</strong> {{$solicitacao->nome_paciente}}</p>
                <p><strong>Responsável pelo Orçamento:</strong>
                @php
                                    $responsavel = $solicitacao->responsavel ? $solicitacao->responsavel->usuario : 'Sem responsável';
                @endphp

                                {{ $responsavel }}</p>
            </div>

            <div class="col-md-4">
                @if($solicitacao->canal_contato == "telefone")
                    <p><strong>Canal de Preferência de Contato:</strong> Telefone</p>
                @else
                <p><strong>Canal de Preferência de Contato:</strong> E-mail</p>
                @endif


                @if($solicitacao->canal_contato == "telefone")
                    <p><strong>Telefone:</strong> {{$solicitacao->telefone}}</p>
                @else
                    <p><strong>E-mail:</strong> {{$solicitacao->email}}</p>
                @endif

                <p><strong>Tipo de Orçamento:</strong>
                    @switch($solicitacao->tipo_orcamento)
                        @case('parto') Parto @break
                        @case('cirurgia') Cirurgia @break
                        @case('homecare') Home Care @break
                        @case('remocao') Remoção @break
                        @case('leito') Leito UTI @break
                        @default {{$solicitacao->tipo_orcamento}}
                    @endswitch
                </p>

            </div>

            <div class="col-md-4">
                <p><strong>Resumo do Procedimento:</strong></p>
                <textarea name="resumo" id="resumo" class="form-control" rows="4" disabled>{{$solicitacao->resumo_procedimento}}</textarea>
            </div>
        </div>


    </div>
