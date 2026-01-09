<?php
include_once 'config/config.php'; // Inclui o arquivo de configuração
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$url = trim($url, '/');
$parts = explode('/', $url);
$route = $parts[2] ?? '';

// Pega o slug vindo da URL
$slug = $route ?? "";
$api_token = "68cdf9d2fdb9c18731d4b89ed55de9287c27177efaa64e6595b3f3e5f7cca6ef";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$responseData[0]['title']?></title>
    
        
</head>
<body>

<div class="grid-col-3 px-5 py-5">

<?php
if ($slug) {
    // Aqui você faz a requisição à sua API passando o slug
    $url = "http://127.0.0.1:8000/api/posts/{$slug}/68cdf9d2fdb9c18731d4b89ed55de9287c27177efaa64e6595b3f3e5f7cca6ef"; // Ajuste para o endpoint correto da sua API

    // Usando cURL para fazer a requisição
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Accept: application/json',
        'Content-Type: application/json',
        'Authorization: Bearer 5|eWxqifjuO5GIzMTPlcKOd0E2Hz7kzIzTsWsGnlqX55e700d6' // Adicione o token se necessário
    ]);
    $response = curl_exec($ch);
    curl_close($ch);

    if ($response === false) {
        echo "Erro na requisição da API.";
    } else {
        $responseData = json_decode($response, true); // Decodifica a resposta JSON da API

        if ($responseData && isset($responseData['title'])) {
            // Exibe os dados da resposta
?>
            <div class="card">
                <img class="card_img" src="<?= '/teste-api/'.htmlspecialchars($responseData['image_url']) ?>" alt="<?= htmlspecialchars($responseData['title']) ?>">
                <h2 class="card_title"><?= htmlspecialchars($responseData['title']) ?></h2>

                <?php if (isset($responseData['short_description'])): ?>
                    <strong><?= htmlspecialchars($responseData['short_description']) ?></strong>
                <?php endif; ?>

                <p class="card_text"><?= nl2br(htmlspecialchars($responseData['content'])) ?></p>
            </div>
<?php
        } else {
            // Caso a API não retorne dados válidos
            echo "Conteúdo não encontrado para o slug: " . htmlspecialchars($slug);
        }
    }
} else {
    echo "Slug não fornecido.";
}
?>
</div>  

</body>
</html>
