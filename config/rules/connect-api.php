<?php
try{
    
// 1. Inicia o cURL para buscar dados da API
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://127.0.0.1:8000/api/showapi/68cdf9d2fdb9c18731d4b89ed55de9287c27177efaa64e6595b3f3e5f7cca6ef',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Authorization: Bearer 5|5qLPxpN4TAR1w0xj8jXx0DfVPLnrmge0q9snMYMy832383e0'
    ),
)); 
// 2. Executa o cURL e recebe a resposta
$response = curl_exec($curl);
// 3. Decodifica a resposta JSON
$responseData = json_decode($response, true);
// 4. Fecha a primeira conexão cURL
curl_close($curl);
}catch (Exception $e) {
    echo 'Erro: ' . $e->getMessage();
}
?>