window.onload = build();

function build() {
  /* Message Part */
  let messages = [
    'قام محمد أحمد بأضافة منتج جديد',
    'قام محمد أحمد بحذف منتج',
    'قام محمد أحمد بأضافة 2 منتج جديد',
  ];
  let messagesCount = messages.length;
  const messagesBadge = document.querySelector('#messages-count');
  const messagesArea = document.querySelector('#messages');

  messagesBadge.innerText = messagesCount;
  messages.forEach((message) => {
    messagesArea.innerHTML +=
      '<span class="w-100 position-relative fs-6"><i class="fa-solid fa-triangle-exclamation ms-2" style="color: #54621a"></i>' +
      message +
      '<i id="close" class="fa-solid fa-circle-xmark position-absolute start-0" onclick="deleteMessage(' +
      messages.indexOf(message) +
      ');"></i></span><hr />';
  });
  /* Message Part */

  /* Emails Part */
  let emails = [
    'لديك أيميل جديد من TEST1 TEST',
    'لديك أيميل جديد من TEST2 TEST',
    'لديك أيميل جديد من TEST3 TEST',
    'لديك أيميل جديد من TEST3 TEST',
  ];
  let emailsCount = emails.length;
  const emailsBadge = document.querySelector('#emails-count');
  const emailsArea = document.querySelector('#emails');

  emailsBadge.innerText = emailsCount;
  emails.forEach((message) => {
    emailsArea.innerHTML +=
      '<span class="w-100 position-relative fs-6"><i class="fa-solid fa-envelope ms-2" style="color: #54621a"></i>' +
      message +
      '<i id="close" class="fa-solid fa-circle-xmark position-absolute start-0" onclick="deleteEmail(' +
      emails.indexOf(message) +
      ');"></i></span><hr />';
  });
  /* Emails Part */

  /* Table Data Section */
  let data = fetch('./files/operatingStock.json')
    .then((response) => response.json())
    .then((data) => buildTable(data));
  /* Table Data Section */
}

function buildTable(data) {
  const tableBody = document.querySelector('#data-body');
  let buyingCost = 0;
  let sellingCost = 0;
  let rentingCost = 0;

  for (let i = 0; i < data.length; i++) {
    switch (data[i].type) {
      case 'شراء':
        buyingCost += data[i].cost;
        break;
      case 'بيع':
        sellingCost += data[i].cost;
        break;
      case 'تأجير':
        rentingCost += data[i].cost;
      default:
        alert('Not found');
        break;
    }
  }

  displayTotal(buyingCost, sellingCost, rentingCost);

  data.forEach((ele) => {
    tableBody.innerHTML +=
      '<tr><th scope="row">' +
      ele.id +
      '</th><td>' +
      ele.type +
      '</td><td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#' +
      ele.bootstrapId +
      '"><i class="fa-solid fa-search"></i></button><div class="modal fade" id="' +
      ele.bootstrapId +
      '" tabindex="-1" aria-labelledby="' +
      ele.bootstrapId +
      'Label" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="' +
      ele.bootstrapId +
      'Label">' +
      ele.type +
      '</h5><button type="button" style="margin-right: 22.5rem" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div><div class="modal-body"><img class="w-100 h-100" src="' +
      ele.image +
      '" alt="' +
      ele.type +
      '" /></div><div class="modal-footer"><button type="button" class="btn btn-danger" data-bs-dismiss="modal">إنهاء</button></div></div></div></div></td><td>' +
      ele.client +
      '</td><td>' +
      ele.address +
      '</td><td>' +
      ele.date +
      '</td><td>' +
      ele.cost +
      '</td><td><a class="btn btn-sm" href="./components/editOperation/editOperation.html"><i class="fa-solid fa-edit text-primary"></i></a></td></tr>';
  });
}

function consoleD(data) {
  alert(data);
}

function deleteMessage(index) {
  console.log(index);
}

function deleteEmail(index) {
  console.log(index);
}

function displayTotal(buyingCost, sellingCost, rentingCost) {
  const totalBody = document.querySelector('#total-window-body');

  totalBody.innerHTML = `<table class="table table-striped text-center"><thead><tr><th scope="col">النوع</th><th scope="col">القيمة</th></tr></thead>
  <tbody id="data-body">
  <tr><th>تأجير</th><td>${rentingCost}</td></tr>
  <tr><th>بيع</th><td>${sellingCost}</td></tr>
  <tr><th>شراء</th><td>${buyingCost}</td></tr>
  <tr style="border-top: 2px solid #000"><th>صافي الربح</th><td>${
    rentingCost + sellingCost - buyingCost
  }</td></tr>
  </tbody>
  </table>
  `;
}
