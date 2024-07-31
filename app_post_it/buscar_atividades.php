<?php
session_start();
$dsn = 'mysql:host=localhost;dbname=db_post_it';
$usuario = 'seu_usuario';
$senha = 'sua_senha';

try {
    $conexao = new PDO($dsn, $usuario, $senha);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Recupera o ID do usuário da sessão
    $id_usuario = isset($_SESSION['id']) ? $_SESSION['id'] : null;

    // Recupera os parâmetros de busca enviados via AJAX
    $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : '';
    $dataCadastro = isset($_POST['dataCadastro']) ? $_POST['dataCadastro'] : '';

    // Verifica se a data de cadastro está vazia
    if (!empty($dataCadastro)) {
        // Converte a data de entrada para o formato adequado
        $dataCadastro = date('Y-m-d', strtotime(str_replace('/', '-', $dataCadastro)));
    } else {
        // Se a data de cadastro estiver vazia, defina-a como NULL
        $dataCadastro = NULL;
    }
    // consulta SQL para buscar as atividades do usuário logado, incluindo o status
    $query = "
        SELECT 
            a.*, s.status_atv
        FROM 
            tb_atividades a
        LEFT JOIN 
            tb_status_atv s ON a.id_atv = s.fk_id_atv
        WHERE 
            a.fk_id_usuario = :id_usuario
    ";
    // Verifica se foi fornecido um título para a busca
    if (!empty($titulo)) {
        // Adiciona a condição de busca por título à consulta SQL
        $query .= " AND a.titulo LIKE :titulo";
    }
    // Verifica se foi fornecida uma data de cadastro para a busca
    if (!empty($dataCadastro)) {
        // Adiciona a condição de busca por data de cadastro à consulta SQL
        $query .= " AND DATE(a.data_cadastro) = :dataCadastro";
    }
    // Prepara a consulta
    $stmt = $conexao->prepare($query);

    // Associa o valor do ID do usuário ao parâmetro na consulta
    $stmt->bindValue(':id_usuario', $id_usuario, PDO::PARAM_INT);

    // Associa os valores dos parâmetros de busca à consulta, se fornecidos
    if (!empty($titulo)) {
        $stmt->bindValue(':titulo', "%$titulo%", PDO::PARAM_STR);
    }
    if (!empty($dataCadastro)) {
        $stmt->bindValue(':dataCadastro', $dataCadastro, PDO::PARAM_STR);
    }
    // Executa a consulta
    $stmt->execute();
    // Recupera as atividades encontradas
    $atividades = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Verifica se foram encontradas atividades
    if ($atividades) {
        // Construa o HTML com as atividades encontradas
        $html = "<table class='table text-center'>";
        $html .= "<thead><tr><th>N°</th><th>Titulo da atividade</th><th>Data do cadastro</th><th>Status</th><th>Ações</th></tr></thead>";
        $html .= "<tbody class='table-group-divider'>";
        foreach ($atividades as $indice => $atividade) {
            $html .= "<tr><th scope='row'>" . ($indice + 1) . "</th>";
            $html .= "<td>{$atividade['titulo']}</td>";
            $html .= "<td>" . date('d/m/Y', strtotime($atividade['data_cadastro'])) . "</td>";
            $html .= "<td>{$atividade['status_atv']}</td>"; // Exibe o status da atividade
            $html .= "<td>
            <a href='edit_atv.php?id_atv={$atividade['id_atv']}'><button class='btn btn-info'><i class='fa-solid fa-pen-to-square' style='color: black;'></i></button></a> 
            <a href='excluir_atv.php?id_atv={$atividade['id_atv']}'><button class='btn btn-danger'><i class='fa-solid fa-trash' style='color: white;'></i></button></a> 
            </td>";
        }
        $html .= '</tbody></table>';
    } else {
        // Caso não haja atividades encontradas
        $html = '<p>Nenhuma atividade encontrada.</p>';
    }
    // Retorne o HTML resultante
    echo $html;

} catch (PDOException $e) {
    // Em caso de erro na conexão ou na consulta
    echo 'Erro: ' . $e->getCode() . '<br>';
    echo 'Mensagem: ' . $e->getMessage();
}
?>
