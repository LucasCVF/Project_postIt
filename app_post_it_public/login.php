<?php
    session_start();
    require_once "header.php";
    // FIM DA NAVEGACAO
?>
<!-- INICIO DO FORMULARIO -->
        <div class="container">
                <div class="col-md-12">
                    <div id="login" class="m-5">
                        <h2>Login</h2>
                        <form class="login-form" action="controle_login.php" method="post">
                            <div class="m-3">
                                <input type="email" class="bg-input w-100 p-2" name="email" value="<?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email'])  : ''; unset($_SESSION['email'])?>" placeholder="Endereço de Email">
                            </div>
                            <div class="m-3">
                                <input type="password" class="bg-input w-100 p-2" name="senha" placeholder="Digite sua Senha">
                            </div>
                            <div class="m-3">
                                <button type="submit" class="btn bg-button w-100 p-2"> LOGIN </button>
                            </div> 
                            <?php
                                // Verifica se existe algum erro na sessão
                                if (isset($_SESSION['erro_login']) && !empty($_SESSION['erro_login'])) {
                                    $mensagem = $_SESSION['erro_login'];
                                    echo "<h5 class='text-danger mt-3'>Erro de acesso:  $mensagem </h5>";
                                    // Limpa os erros da sessão
                                    unset($_SESSION['erro_login']); 
                                }
                            ?>
                        </form>
                        <div id="footer-login">
                            <p>Não possui cadastro? <a href="cadastro.php">Cadastre-se aqui</a><p>
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





