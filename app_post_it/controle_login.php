<?php
session_start();
    function recuperaDados() {
        $dados = ['usuario'];

        if (isset($_POST["email"]) && $_POST["email"] !== '') {
            $dados['usuario']['email'] = $_POST['email'];
        } 
        if (isset($_POST["senha"]) && $_POST["senha"] !== '') {
            $dados['usuario']['senha'] = $_POST['senha'];
        }
        return $dados;
    }

    $dadosInput = recuperaDados();
    $_SESSION['email'] = $dadosInput['usuario']['email'];
    function recuperaBD() {
        $dsn = 'mysql:host=localhost;dbname=db_post_it';
        $usuario = 'root';
        $senha = '';
        
        try {
            $conexao = new PDO($dsn, $usuario , $senha);
            
            $query = "SELECT id_usuario, email, senha FROM tb_usuarios WHERE email = :email";
    
            $stmt = $conexao->prepare($query);
            $stmt->bindParam(':email', $_POST['email']);
            $stmt->execute();
    
            $resultados = $stmt->fetch(PDO::FETCH_ASSOC);
           
            return $resultados;

        } catch (PDOException $e) {
            echo 'Erro:' . $e->getcode(). '<br>';
            echo 'Mensagem:' . $e->getMessage();
        }
    }
    $dadosBD = recuperaBD();
    $erro = [];
    $senha_usuario = $dadosInput['usuario']['senha'];
    $senha_hash_banco = $dadosBD['senha'];

    if ($dadosBD) {
        // Verifica se a senha fornecida corresponde à senha armazenada no banco de dados
        if (password_verify($senha_usuario, $senha_hash_banco)) {
            $_SESSION['logado'] = true;
            $_SESSION['id'] = $dadosBD['id_usuario'];
            header("Location: index_usuario.php");
            exit;
        } else {
            $_SESSION['erro_login'] = "Senha incorreta";
            $_SESSION['logado'] = false;
            header("Location: login.php");
            exit;   
        }
    } else {
        $_SESSION['erro_login'] = "Email não cadastrado";
        $_SESSION['logado'] = false;
        header("Location: login.php");
        exit;
    }
?>