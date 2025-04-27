<?php
//Dependences
include_once 'rules/connect-api.php'; // Inclui o arquivo de configuração
include_once 'rules/image-download.php'; // Inclui o arquivo de configuração

// Class instaces
if($responseData != null){
    foreach ($responseData as $key => $data):        
        $imageDownload = new imageDownload($data['image_url']);
        $imageDownload->downloadImage($data['image_url']);
    endforeach;
    
}

?>