<?php
function editarAtividade() {
    $dsn = 'mysql:host=localhost;dbname=db_post_it';
    $usuario = 'root';
    $senha = '';

    // Verifica se os dados foram enviados via POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recupera os dados do formulário
        $id_atv = $_POST['id_atv'];
        $titulo = $_POST['titulo'];
        $status = $_POST['status'];
        $data = $_POST['data'];
        $horario = $_POST['horario'];
        $descricao = $_POST['descricao'];

        // Atualize o status na tabela tb_status_atv
        try {
            $conexao = new PDO($dsn, $usuario, $senha);
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $queryStatus = "UPDATE tb_status_atv SET status_atv = :status WHERE fk_id_atv = :id_atv";

            $stmtStatus = $conexao->prepare($queryStatus);
            $stmtStatus->bindValue(':status', $status);
            $stmtStatus->bindValue(':id_atv', $id_atv);
            $stmtStatus->execute();
        } catch (PDOException $e) {
            // Em caso de erro na conexão ou na consulta
            echo 'Erro: ' . $e->getCode() . '<br>';
            echo 'Mensagem: ' . $e->getMessage();
        }

        // Atualize os outros detalhes da atividade na tabela tb_atividades
        try {
            $query = "UPDATE tb_atividades SET titulo = :titulo, data_realizar = :data, horario = :horario, descricao = :descricao WHERE id_atv = :id_atv";

            $stmt = $conexao->prepare($query);
            $stmt->bindValue(':titulo', $titulo);
            $stmt->bindValue(':data', $data);
            $stmt->bindValue(':horario', $horario);
            $stmt->bindValue(':descricao', $descricao);
            $stmt->bindValue(':id_atv', $id_atv);
            $stmt->execute();

        } catch (PDOException $e) {
            // Em caso de erro na conexão ou na consulta
            echo 'Erro: ' . $e->getCode() . '<br>';
            echo 'Mensagem: ' . $e->getMessage();
        }
    }
}
editarAtividade();
header("Location: consultar_atv_usuario.php");
exit;
?>
