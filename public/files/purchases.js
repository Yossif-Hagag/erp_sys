window.onload = build();

function build() {
  /* Table Data Section */
  // let data = fetch('./files/purchases.json')
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
      '</th><td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#' +
      ele.bootstrapId +
      '">معاينة</button><div class="modal fade" id="' +
      ele.bootstrapId +
      '" tabindex="-1" aria-labelledby="' +
      ele.bootstrapId +
      'Label" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="' +
      ele.bootstrapId +
      'Label">' +
      ele.name +
      '</h5><button type="button" style="margin-right: 22.5rem" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div><div class="modal-body"><img class="w-100 h-100" src="' +
      ele.itemImg +
      '" alt="' +
      ele.name +
      '" /></div><div class="modal-footer"><button type="button" class="btn btn-danger" data-bs-dismiss="modal">إنهاء</button></div></div></div></div></td><td>' +
      ele.name +
      '</td><td>' +
      ele.price +
      '</td><td>' +
      ele.phone +
      '</td><td>' +
      ele.applicant +
      '</td><td>' +
      ele.date +
      '</td><td><button class="btn btn-sm btn-dark" onclick="consoleD(' +
      ele.id +
      ')">تخزين</button></td><td><button class="btn btn-sm btn-dark" onclick="consoleD(' +
      ele.id +
      ')">تأجير</button></td><td><button class="btn btn-sm text-primary" onclick="consoleD(' +
      ele.id +
      ')"><i class="fa-solid fa-pen-to-square"></i></button></td><td><button class="btn btn-sm text-danger" onclick="consoleD(' +
      ele.id +
      ')"><i class="fa-solid fa-trash"></i></button></td></tr>';
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
