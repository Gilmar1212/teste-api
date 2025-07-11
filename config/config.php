<?php
//Dependences
include_once 'rules/connect-api.php'; // Inclui o arquivo de configuração
include_once 'rules/image-download.php'; // Inclui o arquivo de configuração

// Class instaces
foreach ($responseData['posts'] as $key => $data):    
    $imageDownload = new imageDownload($data['image_url']);
    $imageDownload->downloadImage($data['image_url']);
endforeach;



if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $imageUrl = $_POST['imageUrl'] ?? null;

    if ($imageUrl) {
        $imageDownload = new ImageDownload($imageUrl);
        $imageDownload->deleteImageIfNotExistsOnAPI();
        echo json_encode(['status' => 'success', 'message' => 'Imagem processada.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'URL da imagem não fornecida.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método inválido.']);
}
?>