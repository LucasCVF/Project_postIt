<?php
    session_start();
    require "header.php";  
    // FIM DA NAVEGACAO
?>
<!-- INICIO DO FORMULARIO -->
    <section>
        <div class="container">
            <div class="m-5">
                <div class="card-group edit-card-nov">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title borda-nov">Lançamento do Novo Design</h5>
                            <p class="card-text">Descubra o novo visual do nosso site! Com um layout moderno e intuitivo, estamos prontos para proporcionar a você uma experiência de navegação ainda melhor.</p>
                        </div>
                        <a href="#" class="btn nov-btn mb-1">Confira agora mesmo!</a>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title borda-nov">Novas Funcionalidades Disponíveis</h5>
                            <p class="card-text">Agora você pode personalizar suas preferências de usuário e receber notificações em tempo real. Aproveite essas e outras novidades que acabamos de lançar!</p>
                        </div>
                        <a href="#" class="btn nov-btn mb-1">Confira agora mesmo!</a>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title borda-nov">Suporte 24/7</h5>
                            <p class="card-text">Nosso suporte ao cliente agora está disponível 24 horas por dia, 7 dias por semana. Estamos aqui para ajudar você a qualquer momento!</p>
                        </div>
                        <a href="#" class="btn nov-btn mb-1">Confira agora mesmo!</a>
                    </div>
                </div>
                <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="img/img_novidades1.png" class="d-block w-100">
                        </div>
                        <div class="carousel-item">
                            <img src="img/img_novidades2.png" class="d-block w-100">
                        </div>
                        <div class="carousel-item">
                            <img src="img/img_novidades3.png" class="d-block w-100">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="m-5">
                <div class="card-group edit-card-nov">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title borda-nov">Blog Atualizado</h5>
                            <p class="card-text">Confira as últimas postagens no nosso blog, com dicas e novidades sobre o mundo da tecnologia. Informação de qualidade para você!</p>
                        </div>
                        <a href="#" class="btn nov-btn mb-1">Confira agora mesmo!</a>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title borda-nov">Melhoria na Segurança</h5>
                            <p class="card-text">Implementamos novas camadas de segurança para proteger ainda mais suas informações. Sua privacidade é nossa prioridade!</p>
                        </div>
                        <a href="#" class="btn nov-btn mb-1">Confira agora mesmo!</a>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title borda-nov">Eventos proximos</h5>
                            <p class="card-text">Fique por dentro dos próximos eventos que estamos organizando. Participe e amplie seus conhecimentos com especialistas da área.</p>
                        </div>
                        <a href="#" class="btn nov-btn mb-1">Confira agora mesmo!</a>
                    </div>
                </div>
                <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="img/img_novidades4.png" class="d-block w-100">
                        </div>
                        <div class="carousel-item">
                            <img src="img/img_novidades5.png" class="d-block w-100">
                        </div>
                        <div class="carousel-item">
                            <img src="img/img_novidades6.png" class="d-block w-100">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>  
        </div>
    </section>
        <!-- FIM DO FORMULARIO -->
        <?php
            require_once "footer.php";
        ?>
        <script src="bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>


