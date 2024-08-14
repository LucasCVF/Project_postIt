<?php 

print_r($_POST);

function recuperarDadosPerfil() {
    $dados = ['usuario' => [], 'erro' => []];
    
    // Verifica se os dados foram enviados via POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        //verifica se existe algo no array POST
        if (isset($_POST["nome"]) && $_POST["nome"] !== '') {
            $dados['perfil']['nome'] = $_POST["nome"];
        } else {
            $dados['erro'][] = "Nome não informado";
        } 
        if (isset($_POST['email']) && $_POST['email'] !== '') {
            $dados['perfil']['email'] = $_POST["email"];
        } else {
            $dados['erro'][] = "Email válido não informado";
        }
        if (isset($_POST['estado']) && $_POST['estado'] !== '') {
            $dados['perfil']['estado'] = $_POST["estado"];
        } else {
            $dados['erro'][] = "Estado válido não informado";
        }
        if (isset($_POST['cidade']) && $_POST['cidade'] !== '') {
            $dados['perfil']['cidade'] = $_POST["cidade"];
        } else {
            $dados['erro'][] = "Cidade válido não informado";
        }
        if (isset($_POST['cep']) && $_POST['cep'] !== '') {
            $dados['perfil']['cep'] = $_POST["cep"];
        } else {
            $dados['erro'][] = "CEP válido não informado";
        }
        
    }  
    return $dados;
}
echo "<pre>";
print_r(recuperarDadosPerfil());
echo "<pre>";

?>