<?php

    function test_photo() {

        try {

            // Previne erros (podem ser ataques informaticos mas nao so).
            if (
                !isset($_FILES['avatar']['error']) ||
                is_array($_FILES['avatar']['error'])
            ) {
                throw new RuntimeException('Imagem inválida.');
            }

            // Verifica o valor do erro
            switch ($_FILES['avatar']['error']) {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    throw new RuntimeException('Nenhuma imagem enviada.');
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    throw new RuntimeException('Imagem demasiado grande.');
                default:
                    throw new RuntimeException('Imagem inválida.');
            }

            // Verifica se o tamanho limite nao foi ultrapassado
            if ($_FILES['avatar']['size'] > 10000000) {
                throw new RuntimeException('Imagem demasiado grande.');
            }

            // Verifica o tipo do ficheiro
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            if (false === $ext = array_search(
                $finfo->file($_FILES['avatar']['tmp_name']),
                array(
                    'jpg' => 'image/jpeg',
                    'png' => 'image/png',
                    'gif' => 'image/gif',
                ),
                true
            )) {
                throw new RuntimeException('Formato da imagem inválido.');
            }

            $avatar = 'Images/'.sha1_file($_FILES['avatar']['tmp_name']).'.'.$ext;

            // Obtem um nome unico para guardar a fotografia no servidor.
            if (!move_uploaded_file(
                $_FILES['avatar']['tmp_name'],
                sprintf('../Images/%s.%s',
                    sha1_file($_FILES['avatar']['tmp_name']),
                    $ext
                )
            )) {
                throw new RuntimeException('Não foi possivel carregar a imagem.');
            }

        } catch (RuntimeException $e) {

            return $e->getMessage();
            
        }

        return $avatar;

    }

?>