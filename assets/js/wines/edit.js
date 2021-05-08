const editBottle = (id) => {
  const modal = document.querySelector("#editModal");
  modal.innerHTML = `
    <div class="modal fade" id="modalEditWine" tabindex="-1" aria-labelledby="ModalLabelEdit" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="ModalLabel">Modifier une référence</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id="formEditWine">
            <div class="modal-body">
              <div class="form-group">
                <label class="col-form-label col-form-label-sm mt-4" for="name">Nom</label>
                <input type="text" class="form-control form-control-sm" placeholder="Chateau Lapompe" id="name" name="name" required>
              </div>
              <div class="form-group">
                <label class="col-form-label col-form-label-sm mt-4" for="country">Pays</label>
                <input type="text" class="form-control form-control-sm" placeholder="France, Espagne etc..." id="country" name="country" required>
              </div>
              <div class="form-group">
                <label class="col-form-label col-form-label-sm mt-4" for="region">Région</label>
                <input type="text" class="form-control form-control-sm" placeholder="Bordeaux, Bourgogne etc..." id="region" name="region" required>
              </div>
              <div class="form-group">
                <label class="col-form-label col-form-label-sm mt-4" for="millesime">Millésime</label>
                <input type="number" class="form-control form-control-sm" placeholder="2005" id="millesime" name="millesime" required>
              </div>
              <div class="form-group">
                <label class="col-form-label col-form-label-sm mt-4" for="cepage">Cépages</label>
                <input type="text" class="form-control form-control-sm" placeholder="Merlot, Malbec etc..." id="cepages" name="cepages" required>
              </div>
              <div class="form-group">
                <label for="formFile" class="form-label mt-4">Image</label>
                <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
                <input class="form-control" type="file" id="formFile" name="formFile">
              </div>
              <div class="form-group">
                <label for="description" class="form-label mt-4">Déscription</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
              <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
          </form>
        </div>
      </div>
    </div>
`;

  const title = document.querySelector(`#id${id} .cardTitle`).textContent;
  const country = document.querySelector(`#id${id} .cardCountry`).textContent;
  const region = document.querySelector(`#id${id} .cardRegion`).textContent;
  const picture = document.querySelector(`#id${id} .cardPicture`).textContent;
  const description = document.querySelector(`#id${id} .cardDescription`)
    .textContent;
  const millesime = document.querySelector(`#id${id} .cardMillesime`)
    .textContent;
  const cepages = document.querySelector(`#id${id} .cardCepages`).textContent;
  const inpFile = document.querySelector(`#id${id} .cardPicture`);
  const fileName = inpFile.src.split("/");
  const file = fileName[fileName.length - 1];

  document.querySelector("#formEditWine #name").value = title;
  document.querySelector("#formEditWine #country").value = country;
  document.querySelector("#formEditWine #region").value = region;
  document.querySelector("#formEditWine #millesime").value = millesime;
  document.querySelector("#formEditWine #cepages").value = cepages;
  document.querySelector("#formEditWine #description").value = description;
  // document.querySelector("#formEditWine #formFile").value = file;

  const formEditWine = document.querySelector("#formEditWine");
  formEditWine.addEventListener("submit", (e) => {
    e.preventDefault();
    console.log("ok");
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = () => {
      if (xhr.readyState == XMLHttpRequest.DONE) {
        if (xhr.status == 200) {
          const res = JSON.parse(xhr.response);
          if (res.nbrError === 0) {
            msgInfo.innerHTML = `
            <div class="alert alert-dismissible alert-success">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              ${res.msg}
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
        }
      }
    };

    let dataSend = new FormData(formEditWine);
    dataSend.append("action", "wineAdd");
    dataSend.append("action2", "update");
    dataSend.append("id", id);
    dataSend.append("file", file);
    dataSend.append("token", sessionStorage.getItem("token"));
    xhr.open("POST", "./bdd/models.php", true);
    // xhr.setRequestHeader("Content-Type", "multipart/form-data");
    xhr.send(dataSend);
  });
};
