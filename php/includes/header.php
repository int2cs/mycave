<?php
session_start();

?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="./assets/css/style.css">
  <title>myCave</title>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <a class="navbar-brand" href="/" id="logo"><img src="./assets/img/logo" alt="Logo"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="/list.php">Nos vins</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Qui sommes-nous ?</a>
        </li>
        <?php if (isset($_SESSION['connected'])) { ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Admin</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#" id="btnAddBottle" data-toggle="modal" data-target="#modalAddWine">Ajouter une bouteille</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Separated link</a>
            </div>
          </li>
        <?php } ?>
      </ul>
      <?php if (!isset($_SESSION['connected'])) { ?>
        <form class="form-inline my-2 my-lg-0" id="formConnect">
          <input class="form-control form-control-sm mr-sm-2" type="text" placeholder="Identifiant" id="idConnect" required>
          <input class="form-control form-control-sm mr-sm-2" type="password" placeholder="Mot de passe" id="pwdConnect" required>
          <button class="btn btn-secondary btn-sm my-2 mx-2 my-sm-0" type="submit">Connexion</button>
        </form>
        <!-- <button class="btn btn-secondary btn-sm my-2 mx-2 my-sm-0" type="submit">S'inscrire</button> -->
      <?php } else {
        echo $_SESSION['nName']; ?>
        <button class="btn btn-danger btn-sm my-2 mx-2 my-sm-0" id="btnDisconnect">Déconnexion</button>
      <?php } ?>

    </div>
  </nav>

  <div id="msgInfo"></div>
  <pre id="retour"></pre>


  <!-- Modal -->
  <div class="modal fade" id="modalAddWine" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ModalLabel">Ajouter une référence</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="formAddWine">
          <div class="modal-body">
            <div class="form-group">
              <label class="col-form-label col-form-label-sm mt-4" for="name">Nom :</label>
              <input type="text" class="form-control form-control-sm" placeholder="Chateau Lapompe" id="name" name="name" required>
            </div>
            <div class="form-group">
              <label class="col-form-label col-form-label-sm mt-4" for="country">Pays :</label>
              <input type="text" class="form-control form-control-sm" placeholder="France, Espagne etc..." id="country" name="country" required>
            </div>
            <div class="form-group">
              <label class="col-form-label col-form-label-sm mt-4" for="region">Région :</label>
              <input type="text" class="form-control form-control-sm" placeholder="Bordeaux, Bourgogne etc..." id="region" name="region" required>
            </div>
            <div class="form-group">
              <label class="col-form-label col-form-label-sm mt-4" for="millesime">Millésime :</label>
              <input type="number" class="form-control form-control-sm" placeholder="2005" id="millesime" name="millesime" required>
            </div>
            <div class="form-group">
              <label class="col-form-label col-form-label-sm mt-4" for="cepage">Cépages :</label>
              <input type="text" class="form-control form-control-sm" placeholder="Merlot, Malbec etc..." id="cepages" name="cepages" required>
            </div>
            <div class="form-group">
              <label for="formFile" class="form-label mt-4">Image :</label>
              <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
              <input class="form-control" type="file" id="formFile" name="formFile">
            </div>
            <div class="form-group">
              <label for="description" class="form-label mt-4">Example textarea</label>
              <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>