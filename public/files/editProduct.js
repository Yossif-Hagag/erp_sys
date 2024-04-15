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
}

function deleteMessage(index) {
  console.log(index);
}

function deleteEmail(index) {
  console.log(index);
}

