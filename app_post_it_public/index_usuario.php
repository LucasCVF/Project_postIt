<?php
require_once "header_usuario.php";

$dsn = 'mysql:host=localhost;dbname=db_post_it';
$usuario = 'root';
$senha = '';

try {
    $conexao = new PDO($dsn, $usuario, $senha);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Recupera o ID do usuário da sessão
    $id_usuario = isset($_SESSION['id']) ? $_SESSION['id'] : null;

    // Verifica se o ID do usuário está definido na sessão
    if ($id_usuario !== null) {
        // Consulta SQL para buscar as 5 atividades mais recentes do usuário atual
        $query_recentes = "
            SELECT titulo, descricao FROM tb_atividades 
            WHERE fk_id_usuario = :id_usuario 
            ORDER BY data_cadastro DESC 
            LIMIT 5
        ";

        // Prepara a consulta para as atividades recentes
        $stmt_recentes = $conexao->prepare($query_recentes);
        $stmt_recentes->bindValue(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt_recentes->execute();
        $atividades_recentes = $stmt_recentes->fetchAll(PDO::FETCH_ASSOC);

        // Consulta SQL para buscar as atividades em execução do usuário atual
        $query_execucao = "
            SELECT a.titulo, a.descricao 
            FROM tb_atividades a
            INNER JOIN tb_status_atv s ON a.id_atv = s.fk_id_atv
            WHERE a.fk_id_usuario = :id_usuario
            AND s.status_atv = 'Em execucao'
        ";

        // Prepara a consulta para as atividades em execução
        $stmt_execucao = $conexao->prepare($query_execucao);
        $stmt_execucao->bindValue(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt_execucao->execute();
        $atividades_execucao = $stmt_execucao->fetchAll(PDO::FETCH_ASSOC);
    } else {
        // ID do usuário não está definido na sessão
        // Você pode redirecionar o usuário para a página de login ou exibir uma mensagem de erro
        header("Location: pagina_de_login.php");
        exit; // Encerra o script
    }
} catch (PDOException $e) {
    // Em caso de erro na conexão ou na consulta
    echo 'Erro: ' . $e->getCode() . '<br>';
    echo 'Mensagem: ' . $e->getMessage();
}
?>

<!-- FIM DA NAVEGACAO -->

<!-- INICIO CONTEUDO -->
<section>
    <div class="container">
        <div class="m-5">
            <div class="row justify-content-center">
                <div class="col-md-5 mb-4">
                    <div class="card card-edit">
                        <div class="card-body text-center">
                            <h4 class="card-title titulo-edit border-usuario">Crie suas atividades</h4>
                            <img class="img-edit" src="img/atividade.png" alt="atividade">
                            <h5 class="card-text">Crie e planeje suas atividades diárias por aqui.</h5>
                            <a href="nova_atv_usuario.php" class="btn bg-button-usu d-flex text-center justify-content-center">Nova atividade</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 mb-4">
                    <div class="card card-edit">
                        <div class="card-body text-center">
                            <h4 class="card-title titulo-edit border-usuario">Consulte suas atividades</h4>
                            <img class="img-edit" src="img/consulta_atv.png" alt="atividade">
                            <h5 class="card-text">Consulte suas atividades diárias e personalize.</h5>
                            <a href="consultar_atv_usuario.php" class="btn bg-button-usu d-flex text-center justify-content-center">Consultar atividade</a>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="row justify-content-center mt-4">
                <div class="col-md-10">
                    <div class="card card-edit">
                        <div class="card-body text-center">
                            <h4 class="card-title titulo-edit p-3 border-usuario">Atividades adicionadas recentemente</h4>
                            <?php foreach ($atividades_recentes as $atividade) : ?>
                                <p class="card-text"><strong><?php echo $atividade['titulo']; ?></strong> - <?php echo strlen($atividade['descricao']) > 50 ? substr($atividade['descricao'], 0, 50) . '...' : $atividade['descricao']; ?></p>
                                <hr>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="card card-edit mt-2">
                        <div class="card-body text-center">
                            <h4 class="card-title titulo-edit p-3 border-usuario">Atividades em execução</h4>
                            <?php foreach ($atividades_execucao as $atividade) : ?>
                                <p class="card-text"><strong><?php echo $atividade['titulo']; ?></strong> - <?php echo strlen($atividade['descricao']) > 50 ? substr($atividade['descricao'], 0, 50) . '...' : $atividade['descricao']; ?></p>
                                <hr>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- FIM CONTEUDO -->

<?php
require_once "footer.php";
?>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
