const deleteBottle = (id) => {
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
          setTimeout(function () {
            document.location.reload();
          }, 1000);
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

  let dataSend = new FormData();
  dataSend.append("action", "wineDelete");
  dataSend.append("id", id);
  dataSend.append("token", sessionStorage.getItem("token"));
  xhr.open("POST", "./bdd/models.php", true);
  // xhr.setRequestHeader("Content-Type", "multipart/form-data");
  xhr.send(dataSend);
};
