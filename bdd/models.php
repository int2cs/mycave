<?php
session_start();
require_once('../php/includes/fn.php');
try {
  $bdd = new PDO('mysql:host=localhost;dbname=mycave', 'root', '');
  $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $err) {
  echo $err;
  die;
}

if (!isset($_POST['action'])) {
  echo 'Mais... Qu\'est-ce que tu fou là !?';
  die;
} else {
  $state = (object) [
    'nbrError' => 0,
    'msg' => []
  ];

  switch ($_POST['action']) {
    case 'connect':
      $id = inpValidate($_POST['id']);
      $pwd = inpValidate(($_POST['pwd']));

      $req = $bdd->prepare('SELECT * FROM users WHERE email = :email');
      $req->bindParam(':email', $id);
      $req->execute();
      $donnee = $req->fetch(PDO::FETCH_ASSOC);
      if (empty($donnee)) {
        $state->nbrError++;
        array_push($state->msg, 'Cette adresse email n\'existe pas !');
        // echo json_encode([
        //   'connected' => false,
        //   'msg' => 'Cette adresse email n\'existe pas !'
        // ]);
      } elseif (!password_verify($pwd, $donnee['pwd'])) {
        $state->nbrError++;
        array_push($state->msg, 'Votre mot de passe est incorrecte !');
        // echo json_encode([
        //   'connected' => false,
        //   'msg' => 'Votre mot de passe est incorrecte !'
        // ]);
      } else {
        $_SESSION['connected'] = true;
        $_SESSION['id'] = $donnee['id'];
        $_SESSION['fName'] = $donnee['firstname'];
        $_SESSION['lName'] = $donnee['lastname'];
        $_SESSION['nName'] = $donnee['nickname'];
        // echo json_encode((object) [
        //   'connected' => true,
        //   'msg' => 'Vous êtes maintenant connecté !'
        // ]);
      }

      if ($state->nbrError != 0)
        echo json_encode($state);
      else {
        $state->msg = 'Vous êtes maintenant connecté !';
        echo json_encode($state);
      }
      break;
    case 'disconnect':
      foreach ($_SESSION as $key => $value) {
        unset($_SESSION[$key]);
      }
      $state->msg = 'Vous êtes déconnecté.';
      echo json_encode($state);
      break;
    case 'wineList':
      $req = $bdd->query('SELECT * FROM wines');
      $donnee = $req->fetchAll(PDO::FETCH_ASSOC);

      echo json_encode($donnee);
      break;
    case 'wineAdd':
      $donnee = array_map('inpValidate', $_POST);

      // $_FILE
      // {
      //   "image":{
      //      "name":"name.png",
      //      "type":"image\/png",
      //      "tmp_name":"C:\\wamp64\\tmp\\phpB521.tmp",
      //      "error":0,
      //      "size":814761
      //    }
      // }
      // error : Valeur
      // Valeur : 0. Aucune erreur, le téléchargement est correct. 
      // Valeur : 1. La taille du fichier téléchargé excède la valeur de upload_max_filesize, configurée dans le php.ini. 
      // Valeur : 2. La taille du fichier téléchargé excède la valeur de MAX_FILE_SIZE, qui a été spécifiée dans le formulaire HTML. 
      // Valeur : 3. Le fichier n'a été que partiellement téléchargé. 
      // Valeur : 4. Aucun fichier n'a été téléchargé. 
      // Valeur : 5. !???
      // Valeur : 6. Un dossier temporaire est manquant. 
      // Valeur : 7. Échec de l'écriture du fichier sur le disque. 
      // Valeur : 8. Une extension PHP a arrêté l'envoi de fichier. PHP ne propose aucun moyen de déterminer quelle extension est en cause. L'examen du phpinfo() peut aider. 

      switch ($_FILES['formFile']['error']) {
        case 4:
          $filename = 'default.jpg';
          array_push($state->msg, 'Upload effectué avec success');
          break;
        case 3:
          $state->nbrError++;
          array_push($state->msg, 'Erreur lors de l\'upload');
          break;
        case 2:
          $state->nbrError++;
          array_push($state->msg, 'Fichier trop volumineux.');
          break;
        case 1:
          $state->nbrError++;
          array_push($state->msg, 'Fichier trop volumineux.');
          break;
        case 0:
          if ($_FILES['formFile']['size'] > 0) {
            $date = new DateTime();

            $filename = $_FILES['formFile']['name'];
            $filename = $filename . $date->getTimestamp();
            $filename = sha1($filename);
            $filename = $filename . $_FILES['formFile']['name'];
            $location = '../assets/img/uploads/' . $filename;

            $file_ext = pathinfo($location, PATHINFO_EXTENSION);
            $file_ext = strtolower($file_ext);

            $valid_ext = array("jpg", "png", "jpeg");

            if (in_array($file_ext, $valid_ext)) {
              if (!file_exists('../assets/img/uploads'))
                if (!mkdir('../assets/img/uploads', 0777)) {
                  $state->nbr++;
                  array_push($state->msg, '[code 52687] Veuillez contacter l\'administrateur...');
                }
              if (move_uploaded_file($_FILES['formFile']['tmp_name'], $location)) {
                array_push($state->msg, 'Upload effectué avec success');
              } else {
                $state->nbrError++;
                array_push($state->msg, 'Erreur lors de l\'uplaod du fichier');
              }
            };
          }
          break;
        default:
          $state->nbrError++;
          array_push($state->msg, 'Si debugger, c’est supprimer des bugs, alors programmer ne peut être que les ajouter - Edsger Dijkstra');
      }

      $req = $bdd->prepare('INSERT INTO wines(name, country, region, millesime, cepages, description, picture) VALUES(:name, :country, :region, :millesime, :cepages, :description, :picture)');
      $req->execute([
        'name' => $donnee['name'],
        'country' => $donnee['country'],
        'region' => $donnee['region'],
        'millesime' => (int) $donnee['millesime'],
        'cepages' => $donnee['cepages'],
        'description' => $donnee['description'],
        'picture' => $filename
      ]);

      echo json_encode($state);
      break;
    case 'wineDelete':
      if (!$bdd->query('DELETE FROM wines WHERE id = ' . $_POST['id'])) {
        $state->nbrError++;
        array_push($state->msg, 'Erreur lors de la suppression de la bouteille.');
      } else {
        $state->msg = 'Suppression effectué avec success';
      }
      echo json_encode($state);
      break;
    default:
      echo ' Si les ouvriers construisaient les bâtiments comme les développeurs écrivent leurs programmes, le premier pivert venu aurait détruit toute civilisation - Gerald Weinberg';
  };
}
