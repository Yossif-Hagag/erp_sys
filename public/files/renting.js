window.onload = build();
function build() {
  /* Table Data Section */
  // let data = fetch('./files/renting.json')
  //   .then((response) => response.json())
  //   .then((data) => buildTable(data));
  /* Table Data Section */

  /* Message Part */
  let messages = [
    'قام محمد أحمد بأضافة منتج جديد',
    'قام محمد أحمد بحذف منتج',
    'قام محمد أحمد بأضافة 2 منتج جديد',
    'قام محمد أحمد بحذف منتج',
    'قام محمد أحمد بحذف منتج',
    'قام محمد أحمد بأضافة 2 منتج جديد',
    'قام محمد أحمد بحذف منتج',
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
  let emails = ['لديك أيميل جديد من TEST1 TEST'];
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
}

function buildTable(data) {
  const tableBody = document.querySelector('#data-body');
  data.forEach((ele) => {
    tableBody.innerHTML +=
      '<tr><th scope="row">' +
      ele.id +
      '</th><td>' +
      ele.name +
      '</td><td>' +
      ele.tenant +
      '</td><td>' +
      ele.period +
      '</td><td>' +
      ele.rentingDate +
      '</td><td>' +
      ele.rentingPrice +
      '</td><td>' +
      ele.source +
      '</td>' +
      (ele.isBelongToStock
        ? '<td><button class="btn btn-sm btn-dark" onclick="consoleD(' +
          ele.id +
          ')">المخزن</button></td>'
        : '<td><button class="btn btn-sm btn-dark" onclick="consoleD(' +
          ele.id +
          ')">المشتريات</button></td>') +
      ' </tr>';
  });
}

function consoleD(data) {
  console.log(data);
}

function deleteMessage(index) {
  console.log(index);
}

function deleteEmail(index) {
  console.log(index);
}
