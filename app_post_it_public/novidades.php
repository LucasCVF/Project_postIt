<?php
    session_start();
    require "header.php";  
    // FIM DA NAVEGACAO
?>
<!-- INICIO DO FORMULARIO -->
    <section>
        <div class="container">
            <div class="m-5">
                <div class="row">
                    <div class="col-md-4">

                    </div>
                    <div class="col-md-4">

                    </div>
                    <div class="col-md-4">

                    </div>
                </div>
                <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="img/img_novidades1.png" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="img/img_novidades2.png" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="img/img_novidades3.png" class="d-block w-100" alt="...">
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


