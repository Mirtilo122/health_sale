<?php

namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Session;
    use Illuminate\Support\Facades\Storage;
    use App\Models\SolicitacaoOrcamento;
    use App\Models\Usuarios;


    class SolicitacaoOrcamentoController extends Controller
    {

    public function index()
    {

        
    }
    public function store(Request $request)
    {
    $solicitacao = new SolicitacaoOrcamento;

    $anestesiasSelecionadas = $request->input('anestesia', []);

    $solicitacao->solicitante = $request->input('formulario');
    $solicitacao->origem_orcamento = 'site';
    $solicitacao->nome_solicitante = $request->input('nome') . ' ' . $request->input('sobrenome');
    $solicitacao->telefone = $request->input('telefone');
    $solicitacao->email = $request->input('email');
    $solicitacao->canal_contato = $request->input('contato');
    $solicitacao->tipo_orcamento = $request->input('tipoOrcamento');
    $solicitacao->convenio = $request->input('convenio');
    $solicitacao->nome_paciente = $request->input('nomePaciente');
    $solicitacao->data_nascimento = $request->input('dataNasc');
    $solicitacao->cidade = $request->input('cidade');
    $solicitacao->comorbidades = $request->input('comorbidades');
    $solicitacao->descricao_comorbidades = $request->input('descComorbidades');
    $solicitacao->resumo_procedimento = $request->input('descSumaria');
    $solicitacao->detalhes_procedimento = $request->input('descDetalhada', '');
    $solicitacao->tempo_cirurgia = $request->input('tempoCirurgico', 0);
    $solicitacao->data_provavel = $request->input('dataProvavel', 0);
    $solicitacao->diarias_enfermaria = $request->input('enfermaria', 0);
    $solicitacao->diarias_apartamento = $request->input('apartamento', 0);
    $solicitacao->diarias_uti = $request->input('utiAdulto', 0);

    if (empty($anestesiasSelecionadas) || $anestesiasSelecionadas === [null]) {
        $tiposAnestesia = ['raqui', 'sma', 'peridural', 'sedacao', 'externo', 'bloqueio', 'local'];
        foreach ($tiposAnestesia as $tipo) {
            $campo = "anestesia_{$tipo}";
            $solicitacao->$campo = 0;
        }
    } else {
        $tiposAnestesia = ['raqui', 'sma', 'peridural', 'sedacao', 'externo', 'bloqueio', 'local'];
        foreach ($tiposAnestesia as $tipo) {
            $campo = "anestesia_{$tipo}";
            $solicitacao->$campo = in_array($tipo, $anestesiasSelecionadas) ? 1 : 0;
        }
    }

    $solicitacao->anestesia_outros = $request->input('anestesiaOutros');
    $solicitacao->observacoes = $request->input('observacoes');
    $solicitacao->urgencia = $request->input('urgenteImediato') ? 1 : 0;


    if ($request->hasFile('arquivo_solicitacao')) {
        $arquivo = $request->file('arquivo_solicitacao');


        if ($arquivo->getClientOriginalExtension() === 'pdf') {

            $nomeArquivo = time() . '_' . uniqid() . '.' . $arquivo->getClientOriginalExtension();


            $caminho = $arquivo->storeAs('public/uploads', $nomeArquivo);


            $solicitacao->arquivo_pdf = str_replace('public/', 'storage/', $caminho);
        }
    }

    $solicitacao->save();

    return redirect()->route('confirmacao')->with([
        'nome_solicitante' => $solicitacao->nome_solicitante,
        'nome_paciente' => $solicitacao->nome_paciente,
        'protocolo' => $solicitacao->protocolo
    ]);
    }




    public function atribuirOrcamento($codigo_solicitacao)
{



    $detalhes = SolicitacaoOrcamento::where('codigo_solicitacao', $codigo_solicitacao)->first();

    if (!$detalhes) {
        return redirect()->route('dashboard')->with('error', 'Orçamento não encontrado.');
    }

    $usuarios = Usuarios::whereIn('acesso', ['Agente', 'Externo'])->get();


    return view('orcamento.atribuir', compact('detalhes', 'usuarios'));
}




    public function atualizarOrcamento(Request $request)
    {


        $request->validate([
            'codigo_solicitacao' => 'required|exists:solicitacoes_orcamentos,codigo_solicitacao',
            'id_usuario' => 'nullable|exists:usuarios,id'
        ]);


        $solicitacao = SolicitacaoOrcamento::where('codigo_solicitacao', $request->codigo_solicitacao)->first();

        if (!$solicitacao) {
            return redirect()->route('dashboard')->with('error', 'Orçamento não encontrado.');
        }


        $solicitacao->id_usuario = $request->id_usuario;
        $solicitacao->status = 'aguardando';

        $solicitacao->save();

        return redirect()->route('dashboard')->with('success', 'Orçamento atualizado com sucesso.');
    }
}
