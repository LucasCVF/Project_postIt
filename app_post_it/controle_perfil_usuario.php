<?php 
    session_start();

    function recuperarDadosPerfil() {
        $dados = ['perfil' => [], 'erro' => []];
        
        // Verifica se os dados foram enviados via POST
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // Verifica a quantidade de palavras digitadas no input
            if (isset($_POST["nome"]) && $_POST["nome"] !== '') {
                if (str_word_count($_POST["nome"]) >= 2) {
                    $dados['perfil']['nome'] = $_POST["nome"];
                } else {
                    $dados['erro'][] = "Digite seu nome completo";
                }
            } else {
                $dados['erro'][] = "Nome não informado";
            } 

            // Validação do email cadastrado baseado nos caracteres
            if (isset($_POST['email']) && $_POST['email'] !== '') {
                if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    $dados['perfil']['email'] = $_POST["email"];
                } else {
                    $dados['erro'][] = "Digite o Email corretamente";
                }
            } else {
                $dados['erro'][] = "Email não informado";
            }

            if (isset($_POST['estado']) && $_POST['estado'] !== '') {
                $dados['perfil']['estado'] = $_POST["estado"];
            } else {
                $dados['erro'][] = "Estado não informado";
            }
            if (isset($_POST['cidade']) && $_POST['cidade'] !== '') {
                $dados['perfil']['cidade'] = $_POST["cidade"];
            } else {
                $dados['erro'][] = "Cidade não informado";
            }

            if (isset($_POST['cep']) && $_POST['cep'] !== '') {
                $cep = preg_replace('/\D/', '', $_POST['cep']);

                if (strlen($cep) === 8) {
                    $dados['perfil']['cep'] = $cep;
                } else {
                    $dados['erro'][] = "CEP incorreto, o cep é composto por 8 dígitos";
                }
            } else {
                $dados['erro'][] = "CEP válido não informado";
            }
            
        }  
        return $dados;
    }
    $dadosPerfil = recuperarDadosPerfil();

    // Define a sessão de erro, se houver
    if (!empty($dadosPerfil['erro'])) {
        $_SESSION['erro_perfil'] = $dadosPerfil['erro'];
        $_SESSION['dados_perfil'] = $dadosPerfil['perfil'];
    } else { 
        $_SESSION['concluido_perfil'] = $dadosPerfil['perfil'];
    }

    function inserirDadosPerfil() {
        $dsn = 'mysql:host=localhost;dbname=db_post_it';
        $usuario = 'root';
        $senha = '';

        try {
            $nome = $_SESSION['concluido_perfil']['nome'];
            $email = $_SESSION['concluido_perfil']['email'];
            $estado = $_SESSION['concluido_perfil']['estado'];
            $cidade = $_SESSION['concluido_perfil']['cidade'];
            $cep = $_SESSION['concluido_perfil']['cep'];
            $id_usuario = $_SESSION['id'];

            $conexao = new PDO($dsn, $usuario, $senha);
            $conexao->beginTransaction();

            $query = "
                INSERT INTO 
                `tb_perfil_usuarios`(`id_usuario`, `nome`, `email`, `estado`, `cidade`, `cep`)
                VALUES (:id_usuario, :nome, :email, :estado, :cidade, :cep);
            ";

            $stmt = $conexao->prepare($query);
            $stmt->bindValue(':id_usuario', $id_usuario);
            $stmt->bindValue(':nome', $nome);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':estado', $estado);
            $stmt->bindValue(':cidade', $cidade);
            $stmt->bindValue(':cep', $cep);
            $stmt->execute();

            // Confirma a transação
            $conexao->commit();

        } catch (PDOException $e) {
            // Reverte a transação em caso de erro
            $conexao->rollBack();
            echo 'Erro:' . $e->getCode() . '<br>';
            echo 'Mensagem:' . $e->getMessage();
        } catch (Exception $e) {
            // Trata outros tipos de exceções
            echo 'Erro:' . $e->getMessage();
        }
    }
    inserirDadosPerfil();
    header("Location: perfil_usuario.php");
    exit;
?>
