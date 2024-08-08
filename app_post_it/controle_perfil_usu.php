<?php
session_start();

function conectarBanco() {
    $dsn = 'mysql:host=localhost;dbname=db_post_it';
    $usuario = 'root';
    $senha = '';
    return new PDO($dsn, $usuario, $senha);
}

function verificarPerfilExistente($id_usuario) {
    $conexao = conectarBanco();
    $query = "SELECT COUNT(*) AS total FROM tb_perfil_usuarios WHERE id_usuario = :id_usuario";
    $stmt = $conexao->prepare($query);
    $stmt->bindParam(':id_usuario', $id_usuario);
    $stmt->execute();
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    return $resultado['total'] > 0;
}

function inserirOuAtualizarPerfil($id_usuario, $nome, $email, $estado, $cidade, $cep) {
    $conexao = conectarBanco();
    
    if (verificarPerfilExistente($id_usuario)) {
        // Atualizar perfil existente
        $query = '
            UPDATE `tb_perfil_usuarios`
            SET `nome` = :nome, `email` = :email, `estado` = :estado, `cidade` = :cidade, `cep` = :cep
            WHERE `id_usuario` = :id_usuario
        ';
    } else {
        // Inserir novo perfil
        $query = '
            INSERT INTO `tb_perfil_usuarios` (`id_usuario`, `nome`, `email`, `estado`, `cidade`, `cep`)
            VALUES (:id_usuario, :nome, :email, :estado, :cidade, :cep)
        ';
    }

    try {
        $conexao->beginTransaction();
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':id_usuario', $id_usuario);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':estado', $estado);
        $stmt->bindValue(':cidade', $cidade);
        $stmt->bindValue(':cep', $cep);
        $stmt->execute();
        $conexao->commit();
        echo "Dados salvos com sucesso!";
    } catch (PDOException $e) {
        $conexao->rollBack();
        echo 'Erro: ' . $e->getMessage();
    }
}

// Suponha que os dados do perfil sejam enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_usuario = $_SESSION['id']; // ID do usuário logado
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $estado = $_POST['estado'];
    $cidade = $_POST['cidade'];
    $cep = $_POST['cep'];
    
    inserirOuAtualizarPerfil($id_usuario, $nome, $email, $estado, $cidade, $cep);
}
?>
