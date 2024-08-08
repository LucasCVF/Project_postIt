<?php
    session_start();
    
    function recuperarDados() {
        $dados = ['usuario' => [], 'erro' => []];
        
        // Verifica se os dados foram enviados via POST
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            //verifica se existe algo no array POST
            if (isset($_POST["nome"]) && $_POST["nome"] !== '') {
                $dados['usuario']['nome'] = $_POST["nome"];
            } else {
                $dados['erro'][] = "Nome não informado";
            }
            if (isset($_POST["data_nascimento"]) && $_POST["data_nascimento"] !== '') {
                $dados['usuario']['data_nascimento'] = $_POST["data_nascimento"];
            } else {
                $dados['erro'][] = "Data de nascimento não informada";
            }
            if (isset($_POST["sexo"])) {
                $dados['usuario']['sexo'] = $_POST["sexo"];
            } 
            if (isset($_POST['email']) && $_POST['email'] !== '') {
                $dados['usuario']['email'] = $_POST["email"];
            } else {
                $dados['erro'][] = "Email válido não informado";
            }
            if (isset($_POST["senha"]) && $_POST["senha"] !== '') {
                $dados['usuario']['senha'] = $_POST["senha"];
            } else {
                $dados['erro'][] = "Senha não informada";
            }
        }  
        return $dados;
    }
    function verificaEmailExistente($email) {
        $dsn = 'mysql:host=localhost;dbname=db_post_it';
        $usuario = 'root';
        $senha = '';
    
        try {
            $conexao = new PDO($dsn, $usuario, $senha);
    
            $query = "SELECT COUNT(*) AS total FROM tb_usuarios WHERE email = :email";
            $stmt = $conexao->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
    
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    
            return $resultado['total'] > 0; // Retorna true se o email já existe, false caso contrário
    
        } catch (PDOException $e) {
            echo 'Erro:' . $e->getcode() . '<br>';
            echo 'Mensagem:' . $e->getMessage();
            return false; // Em caso de erro, retorna false
        }
    }

    $dadosRecuperados = recuperarDados();
    // Define a sessão de erro, se houver
    if (!empty($dadosRecuperados['erro'])) {
        $_SESSION['erro'] = $dadosRecuperados['erro'];
        $_SESSION['dados'] = $dadosRecuperados['usuario'];
    } else { 
        $_SESSION['concluido'] = $dadosRecuperados['usuario'];
    }
    function inserirDadosUsuario() {
        $dsn = 'mysql:host=localhost;dbname=db_post_it';
        $usuario = 'root';
        $senha = '';
        
        try {
            $nome = $_SESSION['concluido']['nome'];
            $data_nascimento = $_SESSION['concluido']['data_nascimento'];
            $email = $_SESSION['concluido']['email'];
            $senha = $_SESSION['concluido']['senha'];
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
            $sexo = $_SESSION['concluido']['sexo'];

            if (verificaEmailExistente($email)) {
                $_SESSION['erro'][] = "Tente novamente - Email já cadastrado";
                header("Location: cadastro.php");
                exit;
            }
            $conexao = new PDO($dsn, $usuario , $senha);
            $conexao->beginTransaction();

            $query = '
                INSERT INTO 
                    `tb_usuarios`(`email`, `senha`, `nome`, `data_nascimento`) 
                    VALUES (:email, :senha, :nome, :data_nascimento);
                ';
                
            $stmt = $conexao->prepare($query);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':nome', $nome);
            $stmt->bindValue(':data_nascimento', $data_nascimento);
            $stmt->bindValue(':senha', $senha_hash);
            $stmt->execute();

            // Obtenha o ID do usuário inserido
            $id_usuario = $conexao->lastInsertId();

            // Prepare a segunda consulta SQL para inserir dados na tabela tb_sexo_usuario
            $query2 = 'INSERT INTO `tb_sexo_usuario`(`fk_id_usuario`, `sexo`) 
                    VALUES (:id_usuario, :sexo)';
            $stmt2 = $conexao->prepare($query2);
            $stmt2->bindValue(':id_usuario', $id_usuario);
            $stmt2->bindValue(':sexo', $sexo);
            $stmt2->execute();
            
            // Confirme a transação
            $conexao->commit();

            // Feche a conexão com o banco de dados
            $conexao = null;
        } catch (PDOException $e) {
            echo 'Erro:' . $e->getcode(). '<br>';
            echo 'Mensagem:' . $e->getMessage();
        }
    }
    inserirDadosUsuario();
    header("Location: cadastro.php");
    exit;
?>