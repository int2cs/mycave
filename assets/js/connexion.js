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
          console.log(res);
          for (let i = 0; i < res.length - 2; i++) {
            //Ici on démarre les sessionStorage
          }
          if (res.nbrError === 0) {
            msgInfo.innerHTML = `
          <div class="alert alert-dismissible alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            ${res.msg[res.msg.length - 1]}
          </div>
          `;
            // setTimeout(function () {
            //   document.location.reload();
            // }, 1000);
          } else {
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
    dataSend.append("id", id.value);
    dataSend.append("pwd", pwd.value);
    xhr.open("POST", "./bdd/models.php", true);
    // xhr.setRequestHeader("Content-Type", "multipart/form-data");
    xhr.send(dataSend);
  });
}

if (btnDisconnect) {
  btnDisconnect.addEventListener("click", () => {
    console.log("click !");
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
      if (xhr.readyState == XMLHttpRequest.DONE) {
        if (xhr.status == 200) {
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
