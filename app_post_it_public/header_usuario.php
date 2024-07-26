<?php
session_start();
// Verifique se o usuário está logado
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    // Se não estiver logado, redirecione para a página de login
    header("Location: login.php");
    exit;
}
function buscarNomeUsuario() {
    $dsn = 'mysql:host=localhost;dbname=db_post_it';
    $usuario = 'root';
    $senha = '';
    try {
        $conexao = new PDO($dsn, $usuario, $senha);

        $query = "SELECT nome FROM tb_usuarios WHERE id_usuario = :id_usuario";
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':id_usuario', $_SESSION['id']);
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        // Verifica se encontrou um resultado
        if ($resultado) {
            return $resultado['nome']; // Retorna o nome do usuário
        } else {
            return null; // Retorna null se o ID do usuário não for encontrado
        }
    } catch (PDOException $e) {
        echo 'Erro:' . $e->getCode() . '<br>';
        echo 'Mensagem:' . $e->getMessage();
        return null; // Em caso de erro, retorna null
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Post It.com</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="bootstrap/css_modificacao/header.css">
        <link rel="stylesheet" href="bootstrap/css_modificacao/header_usuario.css">
        <link rel="stylesheet" href="bootstrap/css_modificacao/conteudo_index.css">
        <link rel="stylesheet" href="bootstrap/css_modificacao/form_cadastro.css">
        <link rel="stylesheet" href="bootstrap/css_modificacao/form_contato.css">
        <link rel="stylesheet" href="bootstrap/css_modificacao/forms.css">
        <link rel="stylesheet" href="bootstrap/css_modificacao/form_login.css">
        <link rel="stylesheet" href="bootstrap/css_modificacao/footer.css">
        <link rel="stylesheet" href="bootstrap/css_modificacao/index_usuario.css">
        <link rel="stylesheet" href="img/font_awesome/css/all.min.css">
        <!-- Inclua a biblioteca jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>
    <body style="font-family: 'Times New Roman', Times, serif; background-color: #ebebeb;">
<!-- INICIO DA NAVEGACAO -->
        <nav class="navbar navbar-expand-md bg-vermelho">
            <div class="container">
                <!-- Logo -->
                <div class="row">
                    <div class="col-md-4">
                        <a href=" index_usuario.php">
                            <img class="img img-fluid logo-img" src="img/img_logo.jpeg" alt="Logo" height="100">
                        </a>
                    </div>
                    <!-- Botão responsividade -->
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-expanded="false" aria-controls="collapseExample">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <!-- Itens da navegação -->
                    <div class="col-md-4 collapse navbar-collapse justify-content-star" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item px-1">
                                <a class="nav-link bg-a px-4" href="nova_atv_usuario.php">Nova atividade</a>
                            </li>
                            <li class="nav-item px-1">
                                <a class="nav-link bg-a px-4" href="consultar_atv_usuario.php">Consultar atividade</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-4 collapse navbar-collapse justify-content-center" id="navbarNav">
                        <div class="dropdown">
                                <!-- Botão principal -->
                                <button class="btn edit-nome  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa-regular fa-user"></i> <?= buscarNomeUsuario()?>
                                </button>
                            
                            <!-- Itens do dropdown -->
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="logout.php">Sair</a>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>     
        </nav>  
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>