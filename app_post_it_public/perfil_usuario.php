<?php
require_once "header_usuario.php";
?>
<!-- INICIO DO FORMULARIO -->
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="m-5">
                        <h5 class="text-center titulo-cadastro mb-4">Informe os seus dados para um melhor uso do site</h5>
                        <form class="p-4" action="controle_perfil_usuario.php" method="post">
                                <div class="row justify-content-center">
                                    <div class="col-md-3">
                                        <div>
                                            <img class="w-75" src="img/img_perfil.png" alt="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="inputAddress" class="form-label">Nome</label>
                                        <input type="text" class="form-control bg-input" name="nome" id="inputAddress" placeholder="Informe seu nome completo" value="<?php echo isset($_SESSION['dados_perfil']['nome']) ? htmlspecialchars($_SESSION['dados_perfil']['nome'])  : ''; ?>">
                                    </div>
                                    <div class="col-md-5">
                                        <label for="inputAddress" class="form-label">Email</label>
                                        <input type="email" class="form-control bg-input" name="email" id="inputAddress" placeholder="Onde deseja ser notificado de suas atividades" value="<?php echo isset($_SESSION['dados_perfil']['email']) ? htmlspecialchars($_SESSION['dados_perfil']['email'])  : ''; ?>">
                                    </div>
                                </div>
                                <div class="row mt-5">
                                    <div class="col-md-4">
                                        <label for="inputState" class="form-label">Estado</label>
                                        <select id="inputState" class="form-select bg-input" name="estado">
                                            <option value="">Escolha o estado...</option>
                                            <!-- Opções serão preenchidas dinamicamente -->
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="inputCity" class="form-label">Cidade</label>
                                        <select id="inputCity" class="form-select bg-input" name="cidade">
                                            <option value="">Escolha a cidade...</option>
                                            <!-- Opções serão preenchidas dinamicamente -->
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="inputZip" class="form-label">CEP</label>
                                        <input type="text" pattern="\d{8}" maxlength="8" class="form-control bg-input" name="cep" id="inputZip" placeholder="Digite o cep, 8 números" value="<?php echo isset($_SESSION['dados_perfil']['cep']) ? htmlspecialchars($_SESSION['dados_perfil']['cep'])  : ''; ?>">
                                    </div>
                                </div>
                                <button type="submit" class="btn bg-button mt-5 w-100">Registrar</button>

                                <?php
                                    // Verifica se existe algum erro na sessão
                                    if (isset($_SESSION['erro_perfil']) && !empty($_SESSION['erro_perfil'])) {
                                        echo "<h3 class='text-danger mt-3'>Erro no registro </h3>";
                                        echo "<ul class='text-danger'>";
                                        foreach ($_SESSION['erro_perfil'] as $mensagem) {
                                            echo "<li>$mensagem</li>";
                                            
                                        }
                                        echo "</ul>";
                                        // Limpa os erros da sessão
                                        unset($_SESSION['erro_perfil']);
                                        
                                        

                                    } else if (isset($_SESSION['concluido_perfil']) && !empty($_SESSION['concluido_perfil'])) {
                                        echo "<div class='text-center'>";
                                        echo "<h3 class='text-success mt-3'> Registro concluido com sucesso!</h3>";
                                        echo "<a href='index_usuario.php'><button type='button' class='btn btn-success'> Comece sua atividades </button></a>";
                                        echo "</div>";
                                        // Limpa os erros da sessão
                                        unset($_SESSION['concluido_perfil']);
                                        unset($_SESSION['dados_perfil']);
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
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Carregar estados
                fetch('estados_cidades.json')
                    .then(response => response.json())
                    .then(data => {
                        const stateSelect = document.getElementById('inputState');
                        for (const state in data) {
                            const option = document.createElement('option');
                            option.value = state;
                            option.textContent = state;
                            stateSelect.appendChild(option);
                        }
                    });

                // Atualizar cidades quando o estado for selecionado
                document.getElementById('inputState').addEventListener('change', function() {
                    const state = this.value;
                    const citySelect = document.getElementById('inputCity');
                    citySelect.innerHTML = '<option value="">Escolha a cidade...</option>'; // Resetar cidades

                    if (state) {
                        fetch('estados_cidades.json')
                            .then(response => response.json())
                            .then(data => {
                                const cities = data[state];
                                if (cities) {
                                    cities.forEach(city => {
                                        const option = document.createElement('option');
                                        option.value = city;
                                        option.textContent = city;
                                        citySelect.appendChild(option);
                                    });
                                }
                            });
                    }
                });
            });
        </script>

    </body>