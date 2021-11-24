<?php
$errors = [] ;
// Je vérifie si le formulaire est soumis comme d'habitude //
if($_SERVER['REQUEST_METHOD'] === "POST"){ 
    // Securité en php
    // chemin vers un dossier sur le serveur qui va recevoir les fichiers uploadés (attention ce dossier doit être accessible en écriture)
    $uploadDir = './upload/';
    
    // le nom de fichier sur le serveur est ici généré à partir du nom de fichier sur le poste du client (mais d'autre stratégies de nommage sont possibles)
    $tmpName = $_FILES['HOMER']['tmp_name'];
$name = $_FILES['HOMER']['name'];
$size = $_FILES['HOMER']['size'];
$error = $_FILES['HOMER']['error'];
    $uploadFile = $uploadDir . basename($_FILES['HOMER']['name']);
    // Je récupère l'extension du fichier
    
    
    $extension = pathinfo($_FILES['HOMER']['name'], PATHINFO_EXTENSION);
    // Les extensions autorisées
    
    $authorizedExtensions = ['jpg','gif','png','webp'];
    // Le poids max géré par PHP par défaut est de 2M
    $maxFileSize = 1000000;
    
    // Je sécurise et effectue mes tests
//
    /****** Si l'extension est autorisée *************/
    if( (!in_array($extension, $authorizedExtensions))){
        $errors[] = 'Veuillez sélectionner une image de type Jpg ou gif ou Png ou webp !';
    }

    /****** On vérifie si l'image existe et si le poids est autorisé en octets *************/
    if( file_exists($_FILES['HOMER']['tmp_name']) && filesize($_FILES['HOMER']['tmp_name']) > $maxFileSize)
    {
    $errors[] = "Votre fichier doit faire moins de 1M !";
    }

    /****** Si je n'ai pas d"erreur alors j'upload *************/
   /**

 */
    /*if(empty($errors)){
        move_uploaded_file($_FILES['HOMER']['tmp_name'], $uploadFile);
    }*/
    
    if(in_array($extension, $authorizedExtensions) && $size <= $maxFileSize){

        $uniqueName = uniqid('', true);
        //uniqid génère quelque chose comme ca : 5f586bf96dcd38.73540086
        $file = $uniqueName.".".$extension;
        //$file = 5f586bf96dcd38.73540086.jpg
    
        move_uploaded_file($_FILES['HOMER']['tmp_name'], $uploadDir.$file);
    }

    /* Fichier à supprimer */
    $fichier = 'chemin_du_fichier/imgjava.png';

    if(file_exists($fichier)){
    unlink($fichier);
    }

}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
foreach($errors as $error){
    echo $error;
}
?>
<form method="post" enctype="multipart/form-data">
    <label for="HOMER">Upload an profile image</label>    
    <input type="file" name="HOMER" id="HOMER" />
    <button name="send">Send</button>
</form>
</body>
</html>






