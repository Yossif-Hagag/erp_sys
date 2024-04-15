// window.onload = load();
// function load() {
//   /* Table Data Section */
//   let data = fetch('./files/operationsHistory.json')
//     .then((response) => response.json())
//     .then((data) => build(data));
//   /* Table Data Section */
// }

function build(data) {
  const tableHeader = data.tr;
  //buildTableHeader(tableHeader);
}

function buildTableHeader(dataHeader) {
  const tableHead = document.querySelector('#data-head');
  dataHeader.forEach((ele) => {
    tableHead.innerHTML += `<th scope="col">${ele}</th>`;
  });
}

function displayHistory(ele, type) {
  const options = [...document.querySelector('#options-list').children];
  options.forEach((ele) => {
    ele.firstElementChild.disabled = false;
  });
  ele.disabled = true;

  /* Table Data Section */
  let data = fetch('./files/operationsHistory.json')
    .then((response) => response.json())
    .then((data) => buildData(data, type));
  /* Table Data Section */
}

function buildData(data, type) {
  const tableBody = document.querySelector('#data-body');
  tableBody.innerHTML = '';
  let dataHolder = [];
  switch (type) {
    case 'stock':
      dataHolder = data.dataStock;
      break;
    case 'purchases':
      dataHolder = data.dataPurchases;
      break;
    default:
      dataHolder = [];
  }

  //console.log(data, type);
  //console.log(dataHolder, type);

  dataHolder.forEach((ele) => {
    tableBody.innerHTML += `<tr scope="row"><td>${ele.id}</td><td>${ele.empName}</td><td>${ele.empPos}</td><td>${ele.operation}</td><td>${ele.addingDate}</td></tr>`;
  });
}
