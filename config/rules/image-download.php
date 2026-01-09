<?php

class ImageDownload {
    private $imageUrl;

    // Construtor que recebe a URL da imagem
    public function __construct($imageUrl) {
        $this->imageUrl = $imageUrl;
    }

    // Getter para obter a URL da imagem
    public function getImageUrl() {
        return $this->imageUrl;
    }

    // Método para baixar a imagem
    public function downloadImage() {
        try {
            // 1. Pega o caminho da imagem
            $image = "http://127.0.0.1:8000/storage/" . $this->imageUrl; // URL completa da imagem, por exemplo: 'http://127.0.0.1:8000/storage/imagem.jpg'

            // 2. Extrai o nome da imagem da URL
            $imageName = basename($image); // Extrai o nome da imagem da URL (ex: imagem.jpg)

            // 3. Define o caminho para salvar a imagem localmente
            $savePath = 'blog/' . $imageName; // Define o diretório 'blog/' para salvar a imagem

            // 4. Cria o diretório 'blog' caso não exista
            if (!file_exists('blog')) {
                mkdir('blog', 0777, true); // Cria a pasta se não existir
            }

            // 5. Inicia o cURL para fazer o download da imagem
            $ch = curl_init($image);

            // 6. Abre o arquivo para gravar a imagem localmente
            $fp = fopen($savePath, 'wb'); // Abre o arquivo no caminho especificado

            // 7. Configura o cURL para salvar o conteúdo diretamente no arquivo
            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_setopt($ch, CURLOPT_HEADER, 0); // Não inclui o cabeçalho na resposta

            // 8. Executa o download
            curl_exec($ch);

            // 9. Verifica se houve erro durante o download
            if (curl_errno($ch)) {
                echo 'Erro no cURL: ' . curl_error($ch);
            }

            // 10. Fecha o cURL e o arquivo
            curl_close($ch);
            fclose($fp);
        } catch (Exception $e) {
            echo 'Erro: ' . $e->getMessage();
        }
    }

    // Método para apagar a imagem local se ela não existir mais na API
    public function deleteImageIfNotExistsOnAPI() {
        echo "Verificando se a imagem existe na API: ";        
        try {
            // 1. Verifica se a imagem ainda existe na API
            $imageUrl = "http://127.0.0.1:8000/storage/" . $this->imageUrl;
            $headers = get_headers($imageUrl, 1);
            var_dump($headers);
            // 2. Se a imagem não existir (status 404), apaga o arquivo local
            if (strpos($headers[0], '404') !== false) {
                $localPath = 'blog/' . basename($this->imageUrl);
                if (file_exists($localPath)) {
                    var_dump($imageUrl);
                    unlink($localPath); // Remove o arquivo local
                    echo "Imagem local removida: " . $localPath;
                } else {
                    echo "Imagem local não encontrada: " . $localPath;
                }
            } else {
                echo "A imagem ainda existe na API. ".$this->imageUrl . $imageUrl;
            }
        } catch (Exception $e) {
            echo 'Erro ao verificar ou apagar a imagem: ' . $e->getMessage();
        }
    }
}
?>