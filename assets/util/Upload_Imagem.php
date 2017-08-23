<?php
/******
 * Upload de imagens
 ******/

$sucesso = false;
$erro_salvar = false;
$erro_formato = false;
$erro_vazio = false;
 
// verifica se foi enviado um arquivo
if (isset( $_FILES['imagem']['name']) && $_FILES['imagem']['error'] == 0 ) {
//    echo 'Você enviou o arquivo: <strong>' . $_FILES[ 'imagem' ][ 'name' ] . '</strong><br />';
//    echo 'Este arquivo é do tipo: <strong > ' . $_FILES[ 'imagem' ][ 'type' ] . ' </strong ><br />';
//    echo 'Temporáriamente foi salvo em: <strong>' . $_FILES[ 'imagem' ][ 'tmp_name' ] . '</strong><br />';
//    echo 'Seu tamanho é: <strong>' . $_FILES[ 'imagem' ][ 'size' ] . '</strong> Bytes<br /><br />';
 
    $arquivo_tmp = $_FILES['imagem']['tmp_name'];
    $nome = $_FILES['imagem']['name'];
 
    // Pega a extensão
    $extensao = pathinfo($nome, PATHINFO_EXTENSION);
 
    // Converte a extensão para minúsculo
    $extensao = strtolower($extensao);
 
    // Somente imagens, .jpg;.jpeg;.gif;.png
    // Aqui eu enfileiro as extensões permitidas e separo por ';'
    // Isso serve apenas para eu poder pesquisar dentro desta String
    if (strstr('.jpg;.jpeg', $extensao)) {
        // Cria um nome único para esta imagem
        // Evita que duplique as imagens no servidor.
        // Evita nomes com acentos, espaços e caracteres não alfanuméricos
        $novoNome = uniqid(time()) . '.' . $extensao;
 
        // Concatena a pasta com o nome
        $destino = '../../uploads/imagens/' . $novoNome;
        $url_final = 'uploads/imagens/' . $novoNome;
 
        // tenta mover o arquivo para o destino
        if (@move_uploaded_file($arquivo_tmp, $destino)) {
            $sucesso = true;
        } else
            $erro_salvar = true;
    } else
        $erro_formato = true;
} else
    $erro_vazio = true;

$response_array = array(
    'sucesso' => $sucesso,
    'url' => $url_final,
    'erro_salvar' => $erro_salvar,
    'erro_formato' => $erro_formato,
    'erro_vazio' => $erro_vazio
);

echo json_encode($response_array);