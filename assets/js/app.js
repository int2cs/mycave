window.addEventListener("scroll", (e) => {
  const scrollY = window.scrollY;
  document.querySelector("#logo").hidden = window.scrollY > 100 ? true : false;
});

const adminMenu = document.querySelector(".adminMenu");
adminMenu.innerHTML = sessionStorage.getItem("connected")
  ? `<li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Admin</a>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="#" id="btnAddBottle" data-toggle="modal" data-target="#modalAddWine">Ajouter une bouteille</a>
  </div>
</li>`
  : "";

const menuFormConnect = document.querySelector(".menuFormConnect");
menuFormConnect.innerHTML = !sessionStorage.getItem("connected")
  ? `<form class="form-inline my-2 my-lg-0" id="formConnect">
      <input class="form-control form-control-sm mr-sm-2" type="text" placeholder="Identifiant" id="idConnect" name="id" required>
      <input class="form-control form-control-sm mr-sm-2" type="password" placeholder="Mot de passe" id="pwdConnect" name="pwd" required>
      <button class="btn btn-secondary btn-sm my-2 mx-2 my-sm-0" type="submit">Connexion</button>
    </form>`
  : `${sessionStorage.getItem(
      "nickname"
    )}<button class="btn btn-danger btn-sm my-2 mx-2 my-sm-0" id="btnDisconnect">Déconnexion</button>`;
