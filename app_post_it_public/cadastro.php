<?php
    session_start();
    require "header.php";  
    // FIM DA NAVEGACAO
?>
<!-- INICIO DO FORMULARIO -->
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="m-5">
                        <form id="form-edit" class="p-4" action="controle_cadastro.php" method="post">
                            <div class="row justify-content-center">
                                <h5 class="text-center titulo-cadastro mb-4">Preencha as informações para realizar o cadastro</h5>
                                <div class="col-md-5 justify-content-center">
                                    <label for="nome">Digite seu nome*</label>
                                    <input type="text" class="form-control bg-input" id="nome" name="nome" value="<?php echo isset($_SESSION['dados']['nome']) ? htmlspecialchars($_SESSION['dados']['nome'])  : ''; ?>" placeholder="Nome e Sobrenome">
                                </div>
                                <div class="col-md-4">
                                    <label for="data_nascimento">Data de Nascimento*</label>
                                    <input type="date" class="form-control bg-input" id="data_nascimento" name="data_nascimento" value="<?php echo isset($_SESSION['dados']['data_nascimento']) ? htmlspecialchars($_SESSION['dados']['data_nascimento'])  : ''; ?>" placeholder="Password">
                                </div>
                                <div class="col-md-3">
                                    <label for="sexo">Sexo</label>
                                    <select id="sexo" name="sexo" class="form-control bg-input">
                                        <option value="Indefinido"></option>
                                        <option>Masculino</option>
                                        <option>Feminino</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3 justify-content-center">
                                <h5 class="text-center titulo-cadastro m-3">Informações de Acesso</h5>
                                <div class="col-md-6">
                                    <label for="email">Email*</label>
                                    <input type="email" class="form-control bg-input" id="email" name="email" value="<?php echo isset($_SESSION['dados']['email']) ? htmlspecialchars($_SESSION['dados']['email'])  : ''; ?>" placeholder="Email">
                                </div>
                            </div>
                            <div class="row mt-3 justify-content-center">
                                <div class="col-md-6">
                                    <label for="senha">Password*</label>
                                    <input type="password" class="form-control bg-input" id="senha" name="senha" value="<?php echo isset($_SESSION['dados']['senha']) ? htmlspecialchars($_SESSION['dados']['senha'])  : ''; ?>" placeholder="Password">
                                </div>
                            </div>
                            <button type="submit" class="btn bg-button w-100 mt-3">CADASTRAR</button>

                            <?php
                                //retira os dados no input quando é feito o submit ou reload
                                unset($_SESSION['dados'])
                            ?>
                            <?php
                                // Verifica se existe algum erro na sessão
                                if (isset($_SESSION['erro']) && !empty($_SESSION['erro'])) {
                                    echo "<h3 class='text-danger mt-3'>Erro de Cadastro</h3>";
                                    echo "<ul class='text-danger'>";
                                    foreach ($_SESSION['erro'] as $mensagem) {
                                        echo "<li>$mensagem</li>";
                                    }
                                    echo "</ul>";
                                    // Limpa os erros da sessão
                                    session_destroy();
                                } else if (isset($_SESSION['concluido']) && !empty($_SESSION['concluido'])) {
                                        echo "<div class='text-center'>";
                                        echo "<h3 class='text-success mt-3'> Cadastro concluido com sucesso!</h3>";
                                        echo "<a href='login.php'><button type='button' class='btn btn-success'> Acesse sua conta </button></a>";
                                        echo "</div>";
                                        // Limpa os erros da sessão
                                        unset($_SESSION['concluido']);
                                } 
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div> 
        <!-- FIM DO FORMULARIO -->
        <?php
            require_once "footer.php";
        ?>
        <script src="bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>


