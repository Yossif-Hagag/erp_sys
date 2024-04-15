<!DOCTYPE html>
<html lang="ar" dir="rtl">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>العربي جروب</title>
    <link
      rel="shortcut icon"
      href="./assets/elarby group logo.jpg"
      type="image/x-icon"
    />

    <!-- Importing fontawesome library -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    />

    <!-- Importing Bootstrap library -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css"
      integrity="sha512-t4GWSVZO1eC8BM339Xd7Uphw5s17a86tIZIj8qRxhnKub6WoyhnrxeCIMeAqBPgdZGlCcG2PrZjMc+Wr78+5Xg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />

    <!-- Importing 'Cairo' Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Cairo&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{asset('files/home.css')}}" />

    <!-- Importing AOS Library -->
    <!--
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    -->
  </head>
  <body>
    <!-- Start Body Home -->
    <div class="home overflow-hidden">
      <!-- Start Navbar -->
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
          <a
            class="navbar-brand overflow-hidden bg-white rounded-circle"
            href="#"
          >
            <img
              class="w-100 h-100"
              src="./assets/elarby group logo.jpg"
              alt="logo"
            />
          </a>

          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="#home"
                  >الرئيسية</a
                >
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#services">خدماتنا</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#partners">شركاؤنا</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#vision">رؤيتنا</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#vision">هدفنا</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#pros">مميزاتنا</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#certificates">الشهادات</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#contactUs">تواصل معنا</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->

      <!-- Start HomeSection -->
      <div
        class="home-sec d-flex justify-content-center align-items-center container"
        id="home"
        style="padding-bottom: 7rem"
      >
        <div class="content text-center">
          <header>
            أهلا بكم في شركة <span>العربي جروب</span>
            <div class="logo d-inline-block" style="width: 5rem; height: 5rem">
              <img
                src="./assets/elarby group logo.jpg"
                class="w-100 h-100"
                alt="logo"
              />
            </div>
          </header>
          <p class="w-75 mt-3 mb-4 fs-5 mx-auto">
            تأسست شركة العربي جروب للخدمات البيئية عام 2019 وكان الغرض من
            تأسيسها دعم الأقتصاد الوطني وذلك من خلال :-
          </p>
          <ul class="text-end w-25 mx-auto home-list">
            <li class="mb-1">اعمال النظافة العامة</li>
            <li class="mb-1">تدوير المخلفات</li>
            <li class="mb-1">الأعمال البيئية</li>
            <li>أعمال النظافة الداخلية</li>
          </ul>
          <div class="buttons mt-5">
            <a
              id="btn-1"
              href="#services"
              class="btn41-43 btn-43 position-relative d-inline-block text-decoration-none ms-5"
              >خدماتنا</a
            >
            <a
              id="btn-2"
              href="#contactUs"
              class="btn41-43 btn-43 position-relative d-inline-block text-decoration-none me-5"
              >تواصل معنا</a
            >
          </div>
        </div>
      </div>
      <!-- End HomeSection -->

      <!-- Start ServicesSection -->
      <div class="services-sec position-relative" id="services">
        <svg
          class="position-absolute"
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 1440 320"
        >
          <path
            fill="#54621a"
            fill-opacity="1"
            d="M0,32L48,69.3C96,107,192,181,288,197.3C384,213,480,171,576,144C672,117,768,107,864,106.7C960,107,1056,117,1152,149.3C1248,181,1344,235,1392,261.3L1440,288L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"
          ></path>
        </svg>

        <div class="container text-center">
          <header class="text-white">خدماتنا</header>
          <div class="content row">
            <div class="col"></div>
            <div
              class="service-card bg-white position-relative col-md-2 col-sm-12 d-flex align-items-center justify-content-center"
            >
              <header class="w-100 position-absolute start-0">
                <i
                  class="fa-solid bg-white fs-1 rounded-circle fa-recycle"
                  style="color: #4a9494"
                ></i>
              </header>
              <p>عملية التدوير الآمن للمخلفات</p>
            </div>
            <div class="col"></div>

            <div
              class="service-card bg-white position-relative col-md-2 col-sm-12 d-flex align-items-center justify-content-center"
              style="margin-top: 5rem"
            >
              <header class="w-100 position-absolute start-0">
                <i
                  class="bg-white rounded-circle fs-1 fa-solid fa-trash"
                  style="color: #4a9494"
                ></i>
              </header>
              <p>خدمات النظافة العامة</p>
            </div>
            <div class="col"></div>

            <div
              class="service-card bg-white position-relative col-md-2 col-sm-12 d-flex align-items-center justify-content-center"
              style="margin-top: 10rem"
            >
              <header class="w-100 position-absolute start-0">
                <i
                  class="fa-solid fa-rotate-left bg-white rounded-circle fs-1"
                  style="color: #0a9494"
                ></i>
              </header>
              <p>سكراب</p>
            </div>
            <div class="col"></div>

            <div
              class="service-card bg-white position-relative col-md-2 col-sm-12 d-flex align-items-center justify-content-center"
              style="margin-top: 15rem"
            >
              <header class="w-100 position-absolute start-0">
                <i
                  class="fa-solid fa-leaf bg-white rounded-circle fs-1"
                  style="color: #4a9494"
                ></i>
              </header>
              <p>الخدمات البيئية</p>
            </div>
            <div class="col"></div>
          </div>
        </div>

        <!-- Start More detailed services -->
        <div class="big-services row m-0 mt-5 text-center">
          <div class="col-md-6 py-3 col-sm-12 bg-white">
            <header class="big-services-header mb-3">
              أعمال النظافة التأسيسية المتكاملة
              <i class="fa-solid fa-broom fa-fade" style="color: #54621a"></i>
            </header>
            <ul class="big-services-list w-25 mx-auto">
              <li>الفنادق</li>
              <li>البنوك</li>
              <li>الشركات</li>
              <li>المصانع</li>
              <li>القري السياحية</li>
              <li>المطاعم</li>
            </ul>
          </div>
          <div class="col-md-6 py-3 text-white col-sm-12">
            <header class="big-services-header mb-4">
              منظومة الجمع والنقل
              <i
                class="fa-solid fa-truck-arrow-right fa-fade"
                style="color: #ffffff"
              ></i>
            </header>
            <p class="w-75 mx-auto text-white-50 big-services-p">
              هو نظام تجميع مخلفات من الحاويات 1 م 3 والكناتر ذات السعات
              المتنوعة 6 ام 3 ويحتاج هذا النظام إلي توفير الحاويات ذات السعات
              المختلفة وصيانتها وتطهيرها دوريا مع توفير العدد الكافي من المكابس
              ذات السعات المتنوعة لضمان عدم إنقطاع الخدمة .
            </p>
          </div>
          <hr class="my-4 text-white w-50 mx-auto" />

          <div class="big-service text-white">
            <header class="big-service-header mb-4">
              اعدام المواد الصلبة الخطرة بالمدفن الصحي والمصانع
              <i
                class="fa-solid fa-circle-xmark fa-beat-fade"
                style="color: #ffffff"
              ></i>
            </header>
            <p class="w-50 big-service-p mx-auto text-white-50">
              خدمة اعدام المواد الخطرة بالمدفن الصحي ومصانع التدوير التي تقرر
              السلطات العامة أو اصحابها اعدامها أو التخلص منها نهائيا بإفادة من
              الجهات المعنية ويجب اعدامها بطرق خاصة وإجراءات, يتم التنسيق بشأنها
              , وذلك لأسباب تتعلق بالرقابة الأدارية أو متعلقة بالسرية المطلوبة
              لإعدام تلك المواد.
            </p>
          </div>
        </div>
        <!-- End More detailed services -->
      </div>
      <!-- End ServicesSection -->

      <!-- Start PartnersSection -->
      <div class="text-center py-5 partners-sec" id="partners">
        <header class="partners-header mb-5">
          <i class="fa-solid fa-handshake" style="color: #54621a"></i>
          شركاؤنا
          <i class="fa-solid fa-handshake" style="color: #54621a"></i>
        </header>
        <div class="content row m-0">
          <div class="col-md-6 col-sm-12 mb-4">
            <img
              id="partner-1"
              src="./assets/partners/amazon.webp"
              alt="amazon"
            />
          </div>
          <div class="col-md-6 col-sm-12 mb-4">
            <img
              id="partner-2"
              src="./assets/partners/makkah.webp"
              alt="makkah"
            />
          </div>
          <div class="col-md-6 col-sm-12 mb-4">
            <img id="partner-3" src="./assets/partners/cbre.png" alt="CBRE" />
          </div>
          <div class="col-md-6 col-sm-12 mb-4">
            <img id="partner-4" src="./assets/partners/efs.jpg" alt="EFS" />
          </div>
          <div class="col-md-6 col-sm-12 mb-4">
            <img
              id="partner-5"
              src="./assets/partners/kazyon.png"
              alt="kazyon"
            />
          </div>
          <div class="col-md-6 col-sm-12 mb-4">
            <img
              id="partner-6"
              src="./assets/partners/nestle.webp"
              alt="nestle"
            />
          </div>
          <div class="col-md-12 col-sm-12">
            <img
              id="partner-7"
              src="./assets/partners/bonjorno.png"
              alt="bonjorno"
            />
          </div>
        </div>
      </div>
      <!-- End PartnersSection -->

      <!-- Start VisionSection -->
      <div
        class="vision-sec row m-0 overflow-hidden position-relative text-white"
        id="vision"
      >
        <div class="vision-part col-md-6 col-sm-12 h-100 text-end pe-4 pt-4">
          <header class="fs-1 mb-3">
            رؤيتنا
            <i
              class="me-1 fa-solid fa-glasses fa-beat"
              style="color: #4a9494"
            ></i>
          </header>
          <p class="w-75 text-white-50 ms-auto">
            تقديم خدمات جيدة للنهوض بالبيئة ومواجهة الأخطار التي تهدد سلامتنا
            كهدف قومي يجب ان يتكاتف الجميع من أجل التخلص من المخلفات الصناعية و
            إعادة تدوير الهالك بما ينال رضاء العملاء ومن ثم تحقيق اهداف شركة
            العربي جروب والعمل علي إرضاء عملاؤنا.
          </p>
        </div>
        <div class="goal-part col-md-6 col-sm-12 h-100 text-start ps-4 pt-5">
          <svg
            height="210"
            width="500"
            class="position-absolute top-0"
            id="line"
          >
            <line
              x1="0"
              y1="0"
              x2="600"
              y2="600"
              style="stroke: rgb(255, 255, 255); stroke-width: 2"
            />
          </svg>
          <p class="w-75 text-white-50 me-auto">
            مساعدة الشركات في التخلص من جميع المخلفات الصلبة والخطرة والمنتجات
            الغير صالحة , و مساعدة الشركات في إيجاد حلول بيئية علمية قانونية
            للتخلص من مخلفاتها الصلبة والسائلة وتنظيف الأماكن بواسطة الأيدي
            العاملة والماكينات والمعدات.
          </p>
          <header class="fs-1">
            <i
              class="fa-solid fa-bullseye fa-beat"
              style="color: #4a9494; width: auto; height: auto"
            ></i>
            هدفنا
          </header>
        </div>
      </div>
      <!-- End VisionSection -->

      <!-- Start ProsSection -->
      <div class="pros-sec text-center py-5" id="pros">
        <header class="pros-header mb-5">
          <i class="fa-regular fa-star fa-shake" style="color: #54621a"></i>
          مميزاتنا
        </header>
        <div class="content flex-wrap container d-flex justify-content-evenly">
          <div class="pro phone">
            <span
              class="icon d-inline-flex justify-content-center align-items-center rounded-circle"
              ><i
                class="fa-solid fa-phone-volume fa-shake"
                style="color: #4a9494"
              ></i
            ></span>
            <header class="my-3">سرعة اﻷستجابة</header>
            <a href="#contactUs" class="btn btn-outline-success btn-sm"
              >تواصل اﻷن</a
            >
          </div>
          <div class="pro trust">
            <span
              class="icon d-inline-flex justify-content-center align-items-center rounded-circle"
              ><i class="fa-solid fa-t fa-beat" style="color: #54621a"></i>
            </span>
            <header class="my-3">اﻷمانة</header>
            <a href="#contactUs" class="btn btn-outline-success btn-sm"
              >تواصل اﻷن</a
            >
          </div>
          <div class="pro hand">
            <span
              class="icon d-inline-flex justify-content-center align-items-center rounded-circle"
              ><i
                class="fa-solid fa-thumbs-up fa-flip"
                style="color: #4a9494"
              ></i>
            </span>
            <header class="my-3">جودة التنفيذ</header>
            <a href="#contactUs" class="btn btn-outline-success btn-sm"
              >تواصل اﻷن</a
            >
          </div>
          <div class="pro solution">
            <span
              class="icon d-inline-flex justify-content-center align-items-center rounded-circle"
              ><i
                class="fa-solid fa-people-arrows fa-bounce"
                style="color: #54621a"
              ></i>
            </span>
            <header class="my-3">كفاءة وفاعلية الحلول</header>
            <a href="#contactUs" class="btn btn-outline-success btn-sm"
              >تواصل اﻷن</a
            >
          </div>
          <div class="pro honest">
            <span
              class="icon d-inline-flex justify-content-center align-items-center rounded-circle"
              ><i
                class="fa-solid fa-handshake fa-shake"
                style="color: #4a9494"
              ></i>
            </span>
            <header class="my-3">الشفافية</header>
            <a href="#contactUs" class="btn btn-outline-success btn-sm"
              >تواصل اﻷن</a
            >
          </div>
        </div>
      </div>
      <!-- End ProsSection -->

      <!-- Start Certificates Section -->
      <div
        class="certificates-sec text-center py-5 text-white"
        id="certificates"
      >
        <header class="mb-5 position-relative mx-auto">شهاداتنا</header>
        <div class="content row m-0 px-5">
          <div class="iso col-md-3 col-sm-6">
            <img class="w-100 h-100" src="./assets/iso.bmp" alt="certificate" />
          </div>
          <div class="col"></div>
          <div class="iso col-md-3 col-sm-6">
            <img class="w-100 h-100" src="./assets/iso.bmp" alt="certificate" />
          </div>
          <div class="col"></div>
          <div class="iso col-md-3 col-sm-6">
            <img class="w-100 h-100" src="./assets/iso.bmp" alt="certificate" />
          </div>
          <div class="iso col-md-3 col-sm-6">
            <img class="w-100 h-100" src="./assets/iso.bmp" alt="certificate" />
          </div>
          <div class="col"></div>
          <div class="iso col-md-3 col-sm-6">
            <img class="w-100 h-100" src="./assets/iso.bmp" alt="certificate" />
          </div>
          <div class="col"></div>
          <div class="iso col-md-3 col-sm-6">
            <img class="w-100 h-100" src="./assets/iso.bmp" alt="certificate" />
          </div>
        </div>
      </div>
      <!-- End Certificates Section -->

      <!-- Start Contact US Section -->
      <div
        class="contact-sec text-center d-flex justify-content-center align-items-center"
        id="contactUs"
      >
        <i
          class="fa-solid fa-person-digging fa-bounce ms-2"
          style="color: #54621a"
        ></i>
        !Under Construction
      </div>
      <!-- End Contact US Section -->
    </div>
    <!-- End Body Home -->

    <!-- Importing Scripts -->
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js"
      integrity="sha512-3dZ9wIrMMij8rOH7X3kLfXAzwtcHpuYpEgQg1OA4QAob1e81H8ntUQmQm3pBudqIoySO5j0tHN4ENzA6+n2r4w=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    <!--
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    -->
    <script src="./files/script.js"></script>
  </body>
</html>
