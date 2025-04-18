    <div class="info_proc card shadow-sm p-4 pt-0 pb-0">
        <div class="info_superior d-flex align-items-center border-bottom">
            <div class="d-flex align-items-center row_controle_responsividade">
            <h2 class="text-primary">Solicitação #{{$solicitacao->codigo_solicitacao}}</h2>
            <h5><span class="badge bg-secondary span_stts">Protocolo: {{$solicitacao->protocolo}}</span></h5>
            </div>
            <div class="d-flex align-items-center row_controle_responsividade">

                @if($dados->urgencia == 1)
                    <div class="text-danger d-flex align-items-center item_info_sup">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="urgent-icon bi bi-exclamation-triangle" viewBox="0 0 16 16">
                            <path d="M7.938 2.016A.13.13 0 0 1 8.002 2a.13.13 0 0 1 .063.016.15.15 0 0 1 .054.057l6.857 11.667c.036.06.035.124.002.183a.2.2 0 0 1-.054.06.1.1 0 0 1-.066.017H1.146a.1.1 0 0 1-.066-.017.2.2 0 0 1-.054-.06.18.18 0 0 1 .002-.183L7.884 2.073a.15.15 0 0 1 .054-.057m1.044-.45a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767z"/>
                            <path d="M7.002 12a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 5.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0z"/>
                        </svg>
                        <h5 class="mt-1"><span>Urgente</span></h5>
                    </div>
                @else
                    <div class="text-danger d-flex align-items-center">

                    </div>

                @endif
                <div class="d-flex gap-3 align-items-center item_info_sup">
                <h5><strong>Arquivo:</strong></h5>
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

        </div>
        <div class="row d-flex mb-2">
            <div class="col-10 flex-fill">
                <div class="row d-flex justify-content-between">
                    <div class="col-auto flex-fill">
                        <p><strong>Nome do Solicitante:</strong> {{ $dados->nome_solicitante }}</p>
                        <p><strong>Nome do Paciente:</strong> {{ $dados->nome_paciente }}</p>
                        <p><strong>Data de Nascimento:</strong> {{ \Carbon\Carbon::parse($dados->data_nascimento)->format('d/m/Y') }}</p>
                    </div>

                    <div class="col-auto flex-fill">

                        <p><strong>Canal de Preferência de Contato:</strong>
                            {{ $dados->canal_contato == "telefone" ? 'Telefone' : 'E-mail' }}
                        </p>

                        <p><strong>Telefone:</strong> {{ $dados->telefone }}</p>
                        <p><strong>E-mail:</strong> {{ $dados->email }}</p>
                    </div>

                    <div class="col-auto flex-fill">

                        <p><strong>Tipo de Orçamento:</strong>
                            @switch($dados->tipo_orcamento)
                                @case('parto') Parto @break
                                @case('cirurgia') Cirurgia @break
                                @case('homecare') Home Care @break
                                @case('remocao') Remoção @break
                                @case('leito') Leito UTI @break
                                @default {{ ucfirst($dados->tipo_orcamento) }}
                            @endswitch
                        </p>

                        <p><strong>Convenio:</strong>
                            @switch($dados->convenio)
                                @case('nenhum') Nenhum @break
                                @case('particular') Particular @break
                                @case('particularpacote') Particular Pacote@break
                                @case('luzvida') Luz e Vida @break
                                @case('viva') Viva @break
                                @case('sinopaz') Sinopaz/Primavera @break
                                @case('judicial') Judicial @break
                                @default {{ ucfirst($dados->convenio) }}
                            @endswitch
                        </p>

                        <p><strong>Data de Solicitação:</strong> {{ \Carbon\Carbon::parse($dados->data_solicitacao)->format('d/m/Y H:i') }}</p>

                    </div>


                    <div class="col-auto flex-fill">

                        <p><strong>Responsável pelo Orçamento:</strong>
                            @php
                                $responsavel = $orcamento->responsavel->usuario ?? $solicitacao->responsavel->usuario ?? 'Sem responsável';
                            @endphp

                            {{ $responsavel }}
                        </p>

                        <p><strong>Origem do Orçamento:</strong> {{$solicitacao->origem_orcamento === 'site' ? 'Site' : $solicitacao->origem_orcamento}}</p>

                        <p><strong>Status:&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                        @php
                            $status = ucfirst(strtolower($solicitacao->status));
                        @endphp

                        @if($status == 'Novo')
                            <span class="badge bg-info text-light span_stts">Novo</span>
                        @elseif($status == 'Atribuido')
                            <span class="badge bg-secondary text-light span_stts">Atribuída</span>
                        @elseif($status == 'Cirurgiao')
                            <span class="badge bg-warning text-dark span_stts">Retorno Cirurgião</span>
                        @elseif($status == 'Anestesista')
                            <span class="badge bg-warning text-dark span_stts">Retorno Anestesista</span>
                        @elseif($status == 'Criacao')
                            <span class="badge bg-warning text-dark span_stts">Retorno Responsável</span>
                        @elseif($status == 'Liberacao')
                            <span class="badge bg-info text-dark span_stts">Em Liberação</span>
                        @elseif($status == 'Negociacao')
                            <span class="badge bg-primary text-light span_stts">Em Negociação</span>
                        @elseif($status == 'Aprovado')
                            <span class="badge bg-success text-light span_stts">Aprovado</span>
                        @elseif($status == 'Perdido')
                            <span class="badge bg-danger text-light span_stts">Perdido</span>
                        @elseif($status == 'Recusado')
                            <span class="badge bg-dark text-light span_stts">Recusado</span>
                        @endif

                        </p>
                    </div>
                </div>
                <div class="row d-flex mb-2">
                    <div class="col-9 flex-fill">
                        @if (!empty($orcamento))
                            <h4 class="mt-2">
                                Total: R$ <span id="totalValor">
                                    {{ isset($orcamento->valor_total) ? number_format($orcamento->valor_total, 2, ',', '.') : '00,00' }}
                                </span>
                            </h4>
                            <input type="hidden" name="valor_total" id="valor_total"
                                value="{{ isset($orcamento->valor_total) ? number_format($orcamento->valor_total, 2, '.', '') : '0.00' }}">
                            <div class="col-3 flex-fill">
                            <?php if (!is_null($orcamento->orcamento_emitido) && ($orcamento->orcamento_emitido == true || $orcamento->orcamento_emitido == 1)): ?>
                                <a href="{{ url('/gerar-pdf/' . $solicitacao->codigo_solicitacao) }}" class="btn btn-success font-light">
                                    Baixar Orçamento &nbsp;&nbsp;&nbsp;&nbsp;
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5"/>
                                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708z"/>
                                    </svg>
                                </a>
                            <?php endif; ?>
                            </div>
                        @else
                                <h4 class="mt-2">Total: R$ <span id="totalValor">00,00</span></h4>
                                <input type="hidden" name="valor_total" id="valor_total" value="0.00">
                                <div class="col-3 flex-fill">

                                </div>
                        @endif
                    </div>

                </div>
            </div>
            <div class="col-2 flex-fill d-flex flex-column gap-2 mt-2 align-items-end">

            <a href="/dashboard" class="btn btn-secondary btn-sm">Sair sem salvar</a>

            <button type="button" class="btn btn-primary btn-sm" id="acoes" data-bs-toggle="modal" data-bs-target="#acoesModal">
                Prosseguir
            </button>

            <div class="modal fade" id="confirmacaoModal" tabindex="-1" aria-labelledby="confirmacaoModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmacaoModalLabel">Confirmar Exclusão</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                        </div>
                        <div class="modal-body">
                            Tem certeza de que deseja excluir este orçamento? Essa ação não pode ser desfeita.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger" onclick="excluirOrcamento()">Confirmar Exclusão</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="acoesModal" tabindex="-1" aria-labelledby="acoesModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="acoesModalLabel">Ações do Orçamento</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                        </div>
                        <div class="modal-body">
                            O que deseja fazer com o Orçamento?
                        </div>
                        <div class="modal-footer">


            <?php

                $usuario = auth()->user();
                $nivelAcesso = $usuario->acesso;

                if ($nivelAcesso === 'Administrador' || $nivelAcesso === 'Gerente') :
            ?>
                <button type="button" class="btn btn-danger" id="salvarSair" data-bs-toggle="modal" data-bs-target="#confirmacaoModal">
                    Excluir
                </button>

            <?php endif; ?>


            <button type="submit" class="btn btn-danger" onclick="recusarOrcamento()">Recusar</button>

            <button type="submit" class="btn btn-primary" id="salvarSair" onclick="salvarAndSair()">Salvar e Sair</button>




