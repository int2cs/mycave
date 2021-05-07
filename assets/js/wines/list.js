const display = document.querySelector(".block");

const xhr = new XMLHttpRequest();
xhr.onreadystatechange = () => {
  if (xhr.readyState == XMLHttpRequest.DONE) {
    if (xhr.status == 200) {
      const res = JSON.parse(xhr.response);
      res.map((row) => {
        display.innerHTML += `
          <div class="card winecard mb-3 mx-2">
            <h3 class="card-header">${row.name}</h3>
            <div class="card-body">
              <h5 class="card-title">${row.country}</h5>
              <h6 class="card-subtitle text-muted">${row.region}</h6>
            </div>
            <img src="./assets/img/uploads/${row.picture}" alt="Photo de ${row.name}" />
            <div class="card-body">
              <p class="card-text">${row.description}</p>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">Millésime : <span class="text-info">${row.millesime}</span></li>
              <li class="list-group-item">Cépages : <span class="text-muted">${row.cepages}</span></li>
            </ul>
            <div class="card-body">
              <button class="card-link btn btn-outline-warning" data-id="${row.id}" id="btnEdit">Editer</button>
              <button class="card-link btn btn-outline-danger" data-id="${row.id}" id="btnDelete" onclick="deleteBottle(${row.id})">Supprimer</button>
            </div>
          </div>
        `;
      });
    }
  }
};

let dataSend = new FormData();
dataSend.append("action", "wineList");
xhr.open("POST", "./bdd/models.php", true);
// xhr.setRequestHeader("Content-Type", "multipart/form-data");
xhr.send(dataSend);
