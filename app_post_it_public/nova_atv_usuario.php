<?php
    require_once "header_usuario.php";  
// FIM DA NAVEGACAO  
?>
<!-- INICIO CONTEUDO -->
        <section>
            <div class="container">
                <div class="col-md-12">
                    <form id="form-edit" class="m-5 p-4" action="controle_atividade.php" method="post"> 
                        <div class="row">
                            <h2 class="text-center pb-3">Preencha as informações para castrar sua atividade</h2>
                            <div class="col-md-8">
                                <label for="">Nome da atividade*</label>
                                <input type="text" class="form-control bg-input" id="inputEmail4" name="titulo" placeholder="Titulo da sua atividade">
                            </div>
                            <div class="col-md-2">
                                <label for="">Dia a ser realizada*</label>
                                <input type="date" class="form-control bg-input" name="data">
                            </div>
                            <div class="col-md-2">
                                <label for="">Horario</label>
                                <input type="time" class="form-control bg-input" name="horario">
                            </div>
                        </div>
                        <div class="mt-3">
                            <textarea class="bg-input w-100" id=""rows="8" name="descricao" placeholder="Descreva sua atividade..."></textarea>
                        </div>
                        <button type="submit" class="btn bg-button w-100 mt-3">CADASTRAR</button>
                        <?php
                            // Verifica se existe algum erro na sessão
                            if (isset($_SESSION['erro']) && !empty($_SESSION['erro'])) {
                                echo "<h3 class='text-danger mt-3'>Informações incompletas</h3>";
                                echo "<ul class='text-danger'>";
                                foreach ($_SESSION['erro'] as $mensagem) {
                                    echo "<li>$mensagem</li>";
                                }
                                echo "</ul>";
                                // Limpa os erros da sessão
                                unset($_SESSION['erro']);
                            } else if (isset($_SESSION['concluido']) && !empty($_SESSION['concluido'])) {
                                echo "<div class='text-center'>";
                                echo "<h3 class='text-success mt-3 '> Atividade adicionada com sucesso!</h3>";
                                echo "<a href='consultar_atv_usuario.php'><button type='button' class='btn btn-success'>Consultar atividades</button></a>";
                                echo "</div>";
                                // Limpa os erros da sessão
                                unset($_SESSION['concluido']);
                            } 
                        ?>
                    </form>
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


