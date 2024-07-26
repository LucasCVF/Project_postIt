<?php
session_start();
function recuperarAtv() {
    $dados = ['atividade' => [], 'erro' => []];
    
    // Verifica se os dados foram enviados via POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        //verifica se existe algo no array POST
        if (isset($_POST["titulo"]) && $_POST["titulo"] !== '') {
            $dados['atividade']['titulo'] = $_POST["titulo"];
        } else {
            $dados['erro'][] = "Titulo não informado";
        }
        if (isset($_POST["data"]) && $_POST["data"] !== '') {
            $dados['atividade']['data'] = $_POST["data"];
        } else {
            $dados['erro'][] = "Data não informada";
        }
        if (isset($_POST['horario']) && $_POST['horario'] !== '') {
            $dados['atividade']['horario'] = $_POST["horario"];
        }
        if (isset($_POST["descricao"]) && $_POST["descricao"] !== '') {
            $dados['atividade']['descricao'] = $_POST["descricao"];
        } else {
            $dados['erro'][] = "Descrição não informada";
        }
    }
    return $dados;
}
$dados_atv = recuperarAtv();

if (!empty($dados_atv['erro'])) {
    $_SESSION['erro'] = $dados_atv['erro'];
    $_SESSION['atividade'] = $dados_atv['atividade'];
} else { 
    $_SESSION['concluido'] = $dados_atv['atividade'];
}
function inserirAtividade() {
    $dsn = 'mysql:host=localhost;dbname=db_post_it';
    $usuario = 'root';
    $senha = '';

    try {
        $titulo = $_SESSION['concluido']['titulo'];
        $data_realizar = $_SESSION['concluido']['data'];
        $horario = $_SESSION['concluido']['horario'];
        $descricao = $_SESSION['concluido']['descricao'];
        // Recuperar o ID do usuário.
        $id_usuario = $_SESSION['id']; 

        $conexao = new PDO($dsn, $usuario , $senha);
        $conexao->beginTransaction();

        $query = '
            INSERT INTO 
                `tb_atividades`(`fk_id_usuario`, `titulo`, `descricao`, `horario`, `data_realizar`) 
                VALUES (:id_usuario, :titulo, :descricao, :horario, :data_realizar);
            ';

        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':id_usuario', $id_usuario);
        $stmt->bindValue(':titulo', $titulo);
        $stmt->bindValue(':descricao', $descricao);
        $stmt->bindValue(':horario', $horario);
        $stmt->bindValue(':data_realizar', $data_realizar);
        $stmt->execute();

        // Recuperar o ID da atividade inserida
        $id_atividade = $conexao->lastInsertId();

        // Inserir o status "Pendente" na tabela tb_status_atv
        $query_status = '
            INSERT INTO 
                `tb_status_atv`(`fk_id_atv`, `status_atv`) 
                VALUES (:id_atividade, "Pendente");
            ';
        $stmt_status = $conexao->prepare($query_status);
        $stmt_status->bindValue(':id_atividade', $id_atividade);
        $stmt_status->execute();

        // Confirme a transação
        $conexao->commit();

        // Feche a conexão com o banco de dados
        $conexao = null;

    } catch (PDOException $e) {
        echo 'Erro:' . $e->getcode(). '<br>';
        echo 'Mensagem:' . $e->getMessage();
    }
}
inserirAtividade();
header("Location: nova_atv_usuario.php"); // Redireciona para a página após a inserção
exit;
?>
