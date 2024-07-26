<?php
 require_once "header.php";
//  FIM DA NAVEGACAO
?>
<!-- INICIO DO FORMULARIO -->
        <div class="container">
            <div class="col-md-12">
                <div id="contato" class="m-5">
                    <h2>Entre em contato por aqui</h2>
                    <form class="contato-form">
                        <div class="m-3">
                            <input type="email" class="bg-input w-100 p-2" placeholder="Digite seu E-mail que deseja receber a resposta">
                        </div>
                        <div class="m-3">
                            <textarea class="bg-input w-100 p-2" rows="8" placeholder="Descreva sua duvida"></textarea>
                        </div>
                        <div class="m-3">
                            <button type="submit" class="btn bg-button w-100 p-2">ENVIAR</button>
                        </div> 
                    </form>
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