<?php
require_once('./php/includes/header.php');
?>
<main>

  <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <div class="jumbotron">
          <h1 class="display-3">Vins De Qualités !</h1>
          <p class="lead">Chez mycave, nous portons un très grand intérêt à la tradition !<br>
            C'est pourquoi le foulage et le pressurage est uniquement réalisé par nos femmes et nos gosses pendant que nous les hommes, sommes très occuper à goûter ce qui sort de nos cuves !<br>
            De ce fait, n'ayant plus rien à vendre, nous vous proposons des vins de tout horizons afin que vous dépensiez votre argent chez nous.</p>
          <hr class="my-4">
          <p>C'est la raison pour laquelle notre vin est de bien meilleure qualité que les autres !</p>
          <p class="lead">
            <a class="btn btn-primary btn-lg" href="/list.php" role="button">Accéder à la cave</a>
          </p>
        </div>
      </div>
      <div class="carousel-item">
        <div class="jumbotron">
          <h1 class="display-3">Ayez Le Nez Fin...</h1>
          <p class="lead">Nez petit, la blague est pourrie, nez grand, la blague est marrant. Oui j’ai oublié un « e », mais sinon ça ne rime pas.</p>
          <hr class="my-4">
          <p>Hey !? Tu veux du bon vins ? Bhé on en a pas... Mais vient quand même voir ma cave. </p>
          <p class="lead">
            <a class="btn btn-primary btn-lg" href="/list.php" role="button">Accéder à la cave</a>
          </p>
        </div>
      </div>
      <div class="carousel-item">
        <div class="jumbotron">
          <h1 class="display-3">Franchement, ça se fait pas !</h1>
          <p class="lead">La maison ne fais plus crédit depuis que gérard nous a laissé une ardoise bien trop importante. Ce con s'en est allé et nous oblige à poursuivre sa veuve en justice afin de récupérer notre argent.</p>
          <hr class="my-4">
          <p>1 Caisse de vin acheté / 1 caisse de vin payé !</p>
          <p class="lead">
            <a class="btn btn-primary btn-lg" href="/list.php" role="button">Faire un don</a>
          </p>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

  <p class="text-warning">Dans le cadre de ma formation, l'exercice de créer un CRUD nous a été demandé.<br>
    C'est donc en réponse cette demande que ce projet est nez (vous l'avez ? Est né, est nez... elle est bonne non ?).<br>

    Merci de juger mon travail sur les fonctionnalités et non sur le design... ou comme on dit dans le milieu: "Juge moi le fond mais pas la forme !"</p>

</main>

<?php
require_once('./php/includes/footer.php');
?>