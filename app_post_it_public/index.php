<?php
 require_once "header.php";
//  FIM DA NAVEGACAO 
?>
<!-- INICIO CONTEUDO -->
    <section id="index">
        <div class="container">
            <div class="m-5">
                <div id="carouselExampleCaptions" class="carousel slide mb-3">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="img/img1_slide.png" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block edit-slide">
                                <h5>Simples e Eficiente</h5>
                                <p>Desfrute de uma interface limpa e fácil de usar que torna o planejamento do seu dia mais eficiente.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="img/img2_slide.png" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block edit-slide">
                                <h5>Versatil e Interativo</h5>
                                <p>Com o PostIt, você pode se concentrar no que realmente importa, enquanto nós cuidamos da organização.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="img/img3_slide.png" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block edit-slide">
                                <h5>Organização e Planejamento</h5>
                                <p> Adicione, edite e organize suas tarefas com apenas alguns cliques e mantenha o controle total da sua rotina.</p>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card bg-conteudo">
                            <a href="login.php" class="btn btn-primary btn_index">Login</a>
                            <div class="card-body">
                                <h5 class="card-title">Acesse suas pricipais atividades do seu dia!</h5>
                                <p class="card-text">Transforme sua rotina diária com nosso planejador pessoal. No Organize-se, ajudamos você a organizar suas tarefas diárias de maneira simples e eficiente. </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card bg-conteudo">
                            <a href="cadastro.php" class="btn btn-primary btn_index">Cadastro</a>
                            <div class="card-body">
                                <h5 class="card-title ">Planeje sua rotina diaria de uma forma mais clara!</h5>
                                <p class="card-text">Cadastre suas atividades, defina prioridades e acompanhe seu progresso ao longo do dia. Comece a planejar seu sucesso agora mesmo!</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="card mb-3 bg-card">
                            <img src="img/img_index1.png" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title edit-titulo">Sua rotina mais produtiva</h5>
                                <p class="card-text">No PostIt, acreditamos que uma boa organização é a chave para uma vida equilibrada e produtiva. Nosso site oferece ferramentas práticas para que você possa registrar e gerenciar suas tarefas diárias com facilidade. Dê o primeiro passo rumo a uma rotina mais organizada!</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3"> 
                    <div class="col-md-6">
                        <div class="card mb-3 bg-card2">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="img/img_index4.png" class="img-fluid rounded-start img-container" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title edit-titulo">Planejamento inteligente, vida melhor</h5>
                                        <p class="card-text">A gestão do tempo é essencial para alcançar seus objetivos. Você encontra tudo o que precisa para planejar seu dia a dia de forma inteligente. Registre suas atividades, defina prioridades e acompanhe seu progresso. Experimente e veja a diferença!</p>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                    <div class="col-md-6">
                        <div class="card mb-3 bg-card2">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="img/img_index2.png" class="img-fluid rounded-start img-container" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title edit-titulo">Seu parceiro na organização diária</h5>
                                        <p class="card-text">No PostIt, entendemos a importância de uma rotina bem estruturada. Nosso objetivo é ajudar você a organizar suas tarefas diárias de maneira prática e eficiente. Cadastre suas atividades, defina metas e acompanhe seu progresso. Junte-se a nós e melhore sua gestão do tempo!</p>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="card mb-3 bg-card">
                            <img src="img/img_index3.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title edit-titulo">Transforme sua rotina</h5>
                                <p class="card-text">Alcançar seus objetivos começa com uma boa organização. Oferecemos uma plataforma simples e eficaz para você planejar e gerenciar suas atividades diárias. Registre suas tarefas, organize seu dia e veja como é fácil manter uma rotina produtiva.</p>
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


