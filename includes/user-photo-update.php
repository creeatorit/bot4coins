<?php 
session_start();

require_once 'database.php';
// Verifica se foi enviado um arquivo
if (!empty($_FILES['file']['name'])) {
    $file = $_FILES['file'];
    // Extensão permitadas
    $type = array('image/jpeg', 'image/jpg', 'image/png');
    if(in_array($file['type'], $type)) {
       $filename = "photo_user_".$_SESSION['UsuarioID'].".jpg";
       // Se imagem for png mude ext para png
       if($file['type'] == 'image/png') {
            $filename = "photo_user_".$_SESSION['UsuarioID'].".png";
       }

        $destino = '../assets/images/img_profiles/'; // Pasta destino

        if (!is_dir($destino)){       // Se a pasta não existir cria     
            mkdir($destino, 0777, true);
        }

        if(move_uploaded_file($_FILES['file']['tmp_name'], $destino.$filename)) {
            $pdo = Banco::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE usuarios SET foto = :foto WHERE id = :id";
            $q = $pdo->prepare($sql);
            $q->bindValue(':foto', $filename);
            $q->bindValue(':id', $_SESSION['UsuarioID']);
            $q->execute();
            Banco::desconectar();
        }  
        
    } else {
        echo "arquvo nao permitido";
    }
}