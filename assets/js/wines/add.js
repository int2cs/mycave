const formAddWine = document.querySelector("#formAddWine");
formAddWine.addEventListener("submit", (e) => {
  e.preventDefault();

  const xhr = new XMLHttpRequest();
  xhr.onreadystatechange = () => {
    if (xhr.readyState == XMLHttpRequest.DONE) {
      if (xhr.status == 200) {
        const res = JSON.parse(xhr.response);
        if (res.nbrError == 0) {
          msgInfo.innerHTML = `
            <div class="alert alert-dismissible alert-success">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              ${res.msg}
            </div>
          `;
          setTimeout(function () {
            document.location.reload();
          }, 1000);
        } else {
          msgInfo.innerHTML = `
        <div class="alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            ${res.msg}
          </div>
        `;
          setTimeout(function () {
            document.location.reload();
          }, 1000);
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

  const file = document.querySelector("#formFile").files;
  let dataSend = new FormData(formAddWine);
  dataSend.append("action", "wineAdd");
  dataSend.append("action2", "new");
  dataSend.append("token", sessionStorage.getItem("token"));
  if (file.length > 0) {
    dataSend.append("file", file[0]);
  }
  xhr.open("POST", "./bdd/models.php", true);
  // xhr.setRequestHeader("Content-Type", "multipart/form-data");
  xhr.send(dataSend);
});
