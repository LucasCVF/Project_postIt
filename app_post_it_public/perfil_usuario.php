<?php
require_once "header_usuario.php";
// Simulação de recuperação dos dados do perfil do usuário do banco de dados
// No seu código real, você deve recuperar esses dados da sua base de dados
$perfil = [
    'nome' => $_SESSION['nome'] ?? '',
    'email' => $_SESSION['email'] ?? '',
    'estado' => $_SESSION['estado'] ?? '',
    'cidade' => $_SESSION['cidade'] ?? '',
    'cep' => $_SESSION['cep'] ?? ''
];

?>
<!-- INICIO DO FORMULARIO -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="m-5">
                <h5 class="text-center titulo-cadastro mb-4">Seu Perfil</h5>
                <form id="perfilForm" class="p-4" action="controle_perfil_usu.php" method="post">
                    <div class="row justify-content-center">
                        <div class="col-md-3">
                            <div>
                                <img class="w-75" src="img/img_perfil.png" alt="">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="nome" class="form-label">Como prefere ser chamado*</label>
                            <input type="text" class="form-control bg-input" name="nome" value="" placeholder="Informe seu nome completo" readonly>
                        </div>
                        <div class="col-md-5">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control bg-input" name="email" value="" placeholder="Onde deseja ser notificado de suas atividades" readonly>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-4">
                            <label for="estado" class="form-label">Estado</label>
                            <select id="estado" name="estado" class="form-select bg-input" disabled>
                                <option value="">Escolha o estado...</option>
                                <!-- Opções serão preenchidas dinamicamente -->
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="cidade" class="form-label">Cidade</label>
                            <select id="cidade" name="cidade" class="form-select bg-input" disabled>
                                <option value="">Escolha a cidade...</option>
                                <!-- Opções serão preenchidas dinamicamente -->
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="cep" class="form-label">CEP</label>
                            <input type="text" name="cep" class="form-control bg-input" value="" id="inputZip" placeholder="xxxxxxxx" readonly>
                        </div>
                    </div>
                    <button type="button" id="editarButton" class="btn bg-button mt-5 w-100">Editar</button>
                    <button type="submit" id="salvarButton" class="btn bg-button mt-5 w-100" style="display: none;">Salvar</button>
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
                const stateSelect = document.getElementById('estado');
                for (const state in data) {
                    const option = document.createElement('option');
                    option.value = state;
                    option.textContent = state;
                    stateSelect.appendChild(option);
                }

                // Se já houver um estado selecionado, atualize as cidades
                const selectedState = '';
                if (selectedState) {
                    stateSelect.value = selectedState;
                    updateCities(selectedState, data);
                }
            });

        // Atualizar cidades quando o estado for selecionado
        document.getElementById('estado').addEventListener('change', function() {
            const state = this.value;
            const citySelect = document.getElementById('cidade');
            citySelect.innerHTML = '<option value="">Escolha a cidade...</option>'; // Resetar cidades

            if (state) {
                fetch('estados_cidades.json')
                    .then(response => response.json())
                    .then(data => {
                        updateCities(state, data);
                    });
            }
        });

        // Função para atualizar as cidades com base no estado selecionado
        function updateCities(state, data) {
            const citySelect = document.getElementById('cidade');
            const cities = data[state];
            if (cities) {
                cities.forEach(city => {
                    const option = document.createElement('option');
                    option.value = city;
                    option.textContent = city;
                    citySelect.appendChild(option);
                });

                // Se já houver uma cidade selecionada, defina-a
                const selectedCity = '';
                if (selectedCity) {
                    citySelect.value = selectedCity;
                }
            }
        }

        // Manipulador do botão "Editar"
        document.getElementById('editarButton').addEventListener('click', function() {
            // Habilitar campos e mostrar o botão "Salvar"
            document.querySelectorAll('#perfilForm input, #perfilForm select').forEach(element => {
                element.removeAttribute('readonly');
                element.removeAttribute('disabled');
            });
            document.getElementById('editarButton').style.display = 'none';
            document.getElementById('salvarButton').style.display = 'block';
        });
    });
</script>
