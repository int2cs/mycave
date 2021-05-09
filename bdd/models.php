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
    'msg' => [],
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
        $state->msg = 'Cette adresse email n\'existe pas !';
      } elseif (!password_verify($pwd, $donnee['pwd'])) {
        $state->nbrError++;
        array_push($state->msg, 'Votre mot de passe est incorrecte !');
      } else {
        $_SESSION['connected'] = true;
        $_SESSION['token'] = $donnee['token'];

        $state->session = array(
          'connected' => true,
          'id' => $donnee['id'],
          'firstname' => $donnee['firstname'],
          'lastname' => $donnee['lastname'],
          'nickname' => $donnee['nickname'],
          'token' => $donnee['token']
        );
      }

      if ($state->nbrError != 0)
        echo json_encode($state);
      else {
        array_push($state->msg, 'Vous êtes maintenant connecté !');
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
      if (!isset($_SESSION['connected']) || $_SESSION['connected'] === false || $_SESSION['token'] != $_POST['token']) {
        $state->nbrError++;
        $state->msg = 'Vous n\'êtes pas autoriser à effectuer cette opération !!!';

        echo json_encode($state);
        die;
      } else {
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
            if ($donnee['action2'] === 'new') {
              //aucune image envoyée
              //on définit une image par defaut !
              $filename = 'default.jpg';
            } elseif ($donnee['action2'] === 'update') {
              $filename = $donnee['file'];
            }
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

              //Génération d'un nom aleatoire
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

                if (!move_uploaded_file($_FILES['formFile']['tmp_name'], $location)) {
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

        if ($donnee['action2'] === 'new') {
          $req = $bdd->prepare('INSERT INTO wines(name, country, region, millesime, cepages, description, picture) VALUES(:name, :country, :region, :millesime, :cepages, :description, :picture)');
        } elseif ($donnee['action2'] === 'update') {
          $req = $bdd->prepare('UPDATE wines SET name = :name, country = :country, region = :region, millesime =  :millesime, cepages = :cepages, description = :description, picture = :picture WHERE id = ' . $donnee['id']);
        }

        $req->execute([
          'name' => $donnee['name'],
          'country' => $donnee['country'],
          'region' => $donnee['region'],
          'millesime' => (int) $donnee['millesime'],
          'cepages' => $donnee['cepages'],
          'description' => $donnee['description'],
          'picture' => $filename
        ]);

        if ($state->nbrError === 0)
          array_push($state->msg, 'Upload effectué avec succès');

        echo json_encode($state);
      }
      break;

    case 'wineDelete':
      if (!isset($_SESSION['connected']) || $_SESSION['connected'] === false || $_SESSION['token'] != $_POST['token']) {
        $state->nbrError++;
        $state->msg = 'Vous n\'êtes pas autoriser à effectuer cette opération !!!';

        echo json_encode($state);
        die;
      } else {
        if (!$bdd->query('DELETE FROM wines WHERE id = ' . $_POST['id'])) {
          $state->nbrError++;
          array_push($state->msg, 'Erreur lors de la suppression de la bouteille.');
        } else {
          $state->msg = 'Suppression effectué avec success';
        }
        echo json_encode($state);
      }
      break;
    default:
      echo ' Si les ouvriers construisaient les bâtiments comme les développeurs écrivent leurs programmes, le premier pivert venu aurait détruit toute civilisation - Gerald Weinberg';
  };
}
