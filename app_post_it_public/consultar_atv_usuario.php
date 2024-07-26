<?php 
    require_once "header_usuario.php"; 
    // FIM DA NAVEGACAO 
?>
<!-- INICIO CONTEUDO -->
<section>
    <div class="container">
        <div class="col-md-12">
            <form id="form-busca" class="m-5 p-4">
                <div class="row">
                    <h2 class="text-center pb-3">Consultar atividades cadastradas</h2>
                    <div class="col-md-8">
                        <label for="inputTitulo">Nome da atividade:</label>
                        <input type="text" class="form-control bg-input" id="inputTitulo" placeholder="Titulo da sua atividade">
                    </div>
                    <div class="col-md-4">
                        <label for="inputData">Data de cadastro:</label>
                        <input type="date" class="form-control bg-input" id="inputData">
                    </div>
                </div>
                <button type="submit" class="btn bg-button w-100 mt-3">Buscar atividades</button>
            </form>

            <!-- TABELA DE EXIBICAO -->
            <div id="resultadoBusca" class="m-5">
                <!-- Aqui será exibido o resultado da busca -->
            </div>
        </div>
    </div>
</section>
<!-- FIM CONTEUDO -->
    <?php require_once "footer.php"; ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            // Intercepta o envio do formulário de busca
            $('#form-busca').submit(function(event){
                // Evita o comportamento padrão do formulário (recarregar a página)
                event.preventDefault();

                // Obtém os valores dos campos de busca
                var titulo = $('#inputTitulo').val();
                var data = $('#inputData').val();

                // Formata a data no formato "aaaa-mm-dd"
                var dataFormatada = data.split('/').reverse().join('-');

                // Realiza a requisição AJAX para buscar as atividades
                $.ajax({
                    url: 'buscar_atividades.php',
                    type: 'POST',
                    data: {
                        titulo: titulo,
                        dataCadastro: dataFormatada // Envie a data formatada para o PHP
                    },
                    success: function(response){
                        // Exibe o resultado da busca na div correspondente
                        $('#resultadoBusca').html(response);
                    },
                    error: function(xhr, status, error){
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
    <!-- Scripts Bootstrap e Popper.js -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>
