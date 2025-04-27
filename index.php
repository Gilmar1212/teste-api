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
    ?>
    </div>
</body>

</html>

