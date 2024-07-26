<?php
function excluirAtividade() {
    $dsn = 'mysql:host=localhost;dbname=db_post_it';
    $usuario = 'root';
    $senha = '';

    try {
        $conexao = new PDO($dsn, $usuario, $senha);
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (isset($_GET['id_atv'])) {
            $id_atv = $_GET['id_atv'];
        // Busca pelo id do status vinculado ao id_atv
            $query = "SELECT id FROM tb_status_atv WHERE fk_id_atv = :id_atv;";
            $stmt = $conexao->prepare($query);
            $stmt->bindValue(':id_atv', $id_atv, PDO::PARAM_INT);
            $stmt->execute();
            $id_status = $stmt->fetchColumn();
            
        // Exclui o Status da atividade primeiroo devido a chave estrangeira
            $query = "DELETE FROM tb_status_atv WHERE id = :id_status;";
            $stmt = $conexao->prepare($query);
            $stmt->bindValue(':id_status', $id_status, PDO::PARAM_INT);
            $stmt->execute();

        // Exclui atividade
            $query = "DELETE FROM tb_atividades WHERE id_atv = :id_atv;
            ";
            $stmt = $conexao->prepare($query);
            $stmt->bindValue(':id_atv', $id_atv, PDO::PARAM_INT);
            $stmt->execute();
        }
    } catch (PDOException $e) {
        // Em caso de erro na conexão ou na consulta
        echo 'Erro: ' . $e->getCode() . '<br>';
        echo 'Mensagem: ' . $e->getMessage();
    }
}
excluirAtividade();
header("Location: consultar_atv_usuario.php");
exit;
?>