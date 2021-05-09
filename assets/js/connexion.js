const retour = document.querySelector("#retour");

const formConnect = document.querySelector("#formConnect");
const btnDisconnect = document.querySelector("#btnDisconnect");
const id = document.querySelector("#idConnect");
const pwd = document.querySelector("#pwdConnect");
const msgInfo = document.querySelector("#msgInfo");

if (formConnect) {
  formConnect.addEventListener("submit", (e) => {
    e.preventDefault();

    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
      if (xhr.readyState == XMLHttpRequest.DONE) {
        if (xhr.status == 200) {
          const res = JSON.parse(xhr.response);
          if (res.nbrError === 0) {
            //Connexion réussi
            Object.entries(res.session).forEach(([key, value]) =>
              sessionStorage.setItem(key, value)
            );

            msgInfo.innerHTML = `
          <div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            ${res.msg[0]}
          </div>
          `;
            setTimeout(function () {
              document.location.reload();
            }, 1000);
          } else {
            //erreur lors de la connexion
            msgInfo.innerHTML = `
        <div class="alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert">
              &times;
            </button>
            ${res.msg}
          </div>
        `;
          }
        } else {
          //erreur lors de la requête
          msgInfo.innerHTML = `
        <div class="alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert">
              &times;
            </button>
            <strong>Erreur</strong>: Une erreur est survenue...
          </div>
        `;
        }
      }
    };

    let dataSend = new FormData(formConnect);
    dataSend.append("action", "connect");
    xhr.open("POST", "./bdd/models.php", true);
    // xhr.setRequestHeader("Content-Type", "multipart/form-data");
    xhr.send(dataSend);
  });
}

if (btnDisconnect) {
  btnDisconnect.addEventListener("click", () => {
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
      if (xhr.readyState == XMLHttpRequest.DONE) {
        if (xhr.status == 200) {
          sessionStorage.clear();
          const res = JSON.parse(xhr.response);
          msgInfo.innerHTML = `
          <div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">
              &times;
            </button>
            ${res.msg}
          </div>
        `;
          setTimeout(function () {
            document.location.reload();
          }, 1000);
        }
      }
    };

    let dataSend = new FormData();
    dataSend.append("action", "disconnect");
    xhr.open("POST", "./bdd/models.php", true);
    // xhr.setRequestHeader("Content-Type", "multipart/form-data");
    xhr.send(dataSend);
  });
}
