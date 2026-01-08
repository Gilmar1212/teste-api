<?php
include_once 'config/config.php'; // Inclui o arquivo de configuração
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="grid-col-3 px-5 py-5">
    <?php
    if($responseData !=null):
    foreach ($responseData as $key => $data):        
    ?>
        <a href="blogs/<?= $data['slug'] ?>" title="<?= $data['title'] ?>">
            <div class="card">
                <img class="card_img" src="<?= $data['image_url'] ?>" alt="<?= $data['title'] ?>">
                <h2 class="card_title">
                    <?= $data['title'] ?>
                </h2>
                <?php if (isset($data['short_description'])): ?>
                    <strong>
                        <?= $data['short_description'] ?>
                    </strong>
                <?php endif; ?>
                <p class="card_text">
                    <?= $data['content'] ?>
                </p>
            </div>
        </a>
    <?php
    endforeach;
else:
    ?>
    <h2>Não existe nenhuma postagem cadastrada.</h2>
    <?php endif;?>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- <script>
    function deleteImage(imageUrl) {
        $.ajax({
            url: 'http://127.0.0.1:8000/api/showapi', // Endpoint PHP
            type: 'GET',
            data: { imageUrl: imageUrl },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    alert(response.message);
                } else {
                    alert('Erro: ' + response.message);
                }
            },
            error: function() {
                alert('Erro ao tentar remover a imagem.');
            }
        });
    }

    // Exemplo de uso
    const imageUrl = 'imagem.jpg'; // Substitua pelo valor real
    deleteImage(imageUrl);
</script> -->
</html>

