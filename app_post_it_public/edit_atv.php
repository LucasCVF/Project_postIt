<?php
require_once "header_usuario.php";

$dsn = 'mysql:host=localhost;dbname=db_post_it';
$usuario = 'root';
$senha = '';
try {
    $conexao = new PDO($dsn, $usuario, $senha);
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Verifica se o ID da atividade foi passado via parâmetro na URL

    if (isset($_GET['id_atv'])) {
        $id_atv = $_GET['id_atv'];
        // Consulta SQL para buscar os detalhes da atividade com o ID fornecido

        $query = "SELECT a.*, s.status_atv 
                  FROM tb_atividades a
                  LEFT JOIN tb_status_atv s ON a.id_atv = s.fk_id_atv
                  WHERE a.id_atv = :id_atv";
        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':id_atv', $id_atv, PDO::PARAM_INT);
        $stmt->execute();
        $atividade = $stmt->fetch(PDO::FETCH_ASSOC);
        // Verifica se a atividade foi encontrada

        if ($atividade) {
            // Preenche as variáveis com os detalhes da atividade
            $titulo = $atividade['titulo'];
            $status = $atividade['status_atv'];
            $data = $atividade['data_realizar'];
            $horario = $atividade['horario'];
            $descricao = $atividade['descricao'];
        } else {
            echo "Atividade não encontrada.";
            exit;
        }
    } else {
        echo "ID da atividade não fornecido.";
        exit;
    }
} catch (PDOException $e) {
    // Em caso de erro na conexão ou na consulta
    echo 'Erro: ' . $e->getCode() . '<br>';
    echo 'Mensagem: ' . $e->getMessage();
}
?>
<!-- Formulário de Edição -->
<section>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <form id="form-edit" class="m-5 p-4" action="controle_edit_atv.php" method="post"> 
                    <div class="row">
                        <h4 class="text-center pb-3">Editar sua atividade</h4>
                        <div class="col-md-5">
                            <label for="">Nome da atividade*</label>
                            <input type="text" class="form-control bg-input" id="inputEmail4" name="titulo" placeholder="Titulo da sua atividade" value="<?php echo $atividade['titulo']; ?>">
                        </div>
                        <div class="col-md-2">
                            <label for="">Status*</label>
                            <select class="form-control bg-input" name="status" id="status">
                                <option value="Pendente" <?php if ($atividade['status_atv'] == 'Pendente') echo 'selected'; ?>>Pendente</option>
                                <option value="Em execucao" <?php if ($atividade['status_atv'] == 'Em execucao') echo 'selected'; ?>>Em execução</option>
                                <option value="Realizada" <?php if ($atividade['status_atv'] == 'Realizada') echo 'selected'; ?>>Realizada</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="">Dia a ser realizada*</label>
                            <input type="date" class="form-control bg-input" name="data" value="<?php echo $atividade['data_realizar']; ?>">
                        </div>
                        <div class="col-md-2">
                            <label for="">Horario</label>
                            <input type="time" class="form-control bg-input" name="horario" value="<?php echo $atividade['horario']; ?>">
                        </div>
                    </div>

                    <div class="mt-3">
                        <textarea class="bg-input w-100" id="" rows="8" name="descricao" placeholder="Descreva sua atividade..."><?php echo $atividade['descricao']; ?></textarea>
                    </div>
                    <input type="hidden" name="id_atv" value="<?php echo $atividade['id_atv']; ?>">
                    <button type="submit" class="btn bg-button w-100 mt-3">EDITAR</button>
                </form>
            </div>
        </div>
    </div>
</section>
<?php
require_once "footer.php";
?>
