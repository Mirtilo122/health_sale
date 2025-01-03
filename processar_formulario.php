<?php
require 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $protocolo = 'PRT' . str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

        $formulario = $_POST['formulario'] ?? '';
        $nomeSolicitante = $_POST['nome'] ?? '';
        $sobrenome = $_POST['sobrenome'] ?? '';
        $telefone = $_POST['telefone'] ?? '';
        $email = $_POST['email'] ?? '';
        $canalContato = $_POST['contato'] ?? '';
        $tipoOrcamento = $_POST['tipoOrcamento'] ?? '';
        $convenio = $_POST['convenio'] ?? '';
        $nomePaciente = $_POST['nomePaciente'] ?? '';
        $dataNascimento = $_POST['dataNasc'] ?? '';
        $cidade = $_POST['cidade'] ?? '';
        $comorbidades = $_POST['comorbidades'] ?? 'nao';
        $descricaoComorbidades = $_POST['descComorbidades'] ?? null;
        $descricaoSumaria = $_POST['descSumaria'] ?? '';
        $descricaoDetalhada = $_POST['descDetalhada'] ?? '';
        $tempoCirurgia = $_POST['tempoCirurgico'] ?? 0;
        $dataProvavel = $_POST['dataProvavel'] ?? 'Não definida';
        $diariasEnfermaria = $_POST['enfermaria'] ?? 0;
        $diariasApartamento = $_POST['apartamento'] ?? 0;
        $diariasUTI = $_POST['utiAdulto'] ?? 0;
        $anestesias = isset($_POST['anestesia']) ? implode(",", $_POST['anestesia']) : '';
        $anestesiaOutros = $_POST['anestesiaOutros'] ?? null;
        $observacoes = $_POST['observacoes'] ?? '';
        $urgenteImediato = $_POST['urgenteImediato'] ?? 0;

        $arquivoPDF = null;
        if (isset($_FILES['arquivo_solicitacao']) && $_FILES['arquivo_solicitacao']['error'] === UPLOAD_ERR_OK) {
            $extensao = strtolower(pathinfo($_FILES['arquivo_solicitacao']['name'], PATHINFO_EXTENSION));
            if ($extensao === 'pdf') {
                $nomeArquivo = uniqid() . ".pdf";
                $caminhoArquivo = "uploads/" . $nomeArquivo;

                if (move_uploaded_file($_FILES['arquivo_solicitacao']['tmp_name'], $caminhoArquivo)) {
                    $arquivoPDF = $caminhoArquivo;
                } else {
                    die("Erro ao salvar o arquivo PDF.");
                }
            } else {
                die("Formato de arquivo inválido. Apenas arquivos PDF são permitidos.");
            }
        }

        $query = "INSERT INTO solicitacoes_orcamentos (
            solicitante, protocolo, nome_solicitante, telefone, email, canal_contato, tipo_orcamento, convenio,
            nome_paciente, data_nascimento, cidade, comorbidades, descricao_comorbidades,
            resumo_procedimento, detalhes_procedimento, tempo_cirurgia, data_provavel,
            diarias_enfermaria, diarias_apartamento, diarias_uti, anestesia_raqui, anestesia_sma,
            anestesia_peridural, anestesia_sedacao, anestesia_externo, anestesia_bloqueio,
            anestesia_local, anestesia_outros, observacoes, arquivo_pdf, urgencia
        ) VALUES (
            :solicitante, :protocolo, :nome_solicitante, :telefone, :email, :canal_contato, :tipo_orcamento, :convenio,
            :nome_paciente, :data_nascimento, :cidade, :comorbidades, :descricao_comorbidades,
            :resumo_procedimento, :detalhes_procedimento, :tempo_cirurgia, :data_provavel,
            :diarias_enfermaria, :diarias_apartamento, :diarias_uti, :anestesia_raqui, :anestesia_sma,
            :anestesia_peridural, :anestesia_sedacao, :anestesia_externo, :anestesia_bloqueio,
            :anestesia_local, :anestesia_outros, :observacoes, :arquivo_pdf, :urgencia
        )";


        $stmt = $pdo->prepare($query);
        $stmt->execute([
            ':solicitante' => $formulario,
            ':protocolo' => $protocolo,
            ':nome_solicitante' => "$nomeSolicitante $sobrenome",
            ':telefone' => $telefone,
            ':email' => $email,
            ':canal_contato' => $canalContato,
            ':tipo_orcamento' => $tipoOrcamento,
            ':convenio' => $convenio,
            ':nome_paciente' => $nomePaciente,
            ':data_nascimento' => $dataNascimento,
            ':cidade' => $cidade,
            ':comorbidades' => $comorbidades,
            ':descricao_comorbidades' => $descricaoComorbidades,
            ':resumo_procedimento' => $descricaoSumaria,
            ':detalhes_procedimento' => $descricaoDetalhada,
            ':tempo_cirurgia' => $tempoCirurgia,
            ':data_provavel' => $dataProvavel,
            ':diarias_enfermaria' => $diariasEnfermaria,
            ':diarias_apartamento' => $diariasApartamento,
            ':diarias_uti' => $diariasUTI,
            ':anestesia_raqui' => strpos($anestesias, 'raqui') !== false ? 1 : 0,
            ':anestesia_sma' => strpos($anestesias, 'sma') !== false ? 1 : 0,
            ':anestesia_peridural' => strpos($anestesias, 'peridural') !== false ? 1 : 0,
            ':anestesia_sedacao' => strpos($anestesias, 'sedacao') !== false ? 1 : 0,
            ':anestesia_externo' => strpos($anestesias, 'externo') !== false ? 1 : 0,
            ':anestesia_bloqueio' => strpos($anestesias, 'bloqueio') !== false ? 1 : 0,
            ':anestesia_local' => strpos($anestesias, 'local') !== false ? 1 : 0,
            ':anestesia_outros' => $anestesiaOutros,
            ':observacoes' => $observacoes,
            ':arquivo_pdf' => $arquivoPDF,
            ':urgencia' => $urgenteImediato
        ]);

        echo "Formulário enviado com sucesso!";
    
}

?>
