<!DOCTYPE html>
<html lang="ar" dir="rtl">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>تسجيل الدخول || العربي جروب</title>
    <link
      rel="shortcut icon"
       href="{{URL :: asset('assets/elarby group logo.jpg')}}"
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
    <link rel="stylesheet" href="{{asset('files/login.css')}}" />

    <!-- Importing 'Cairo' Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Cairo&display=swap"
      rel="stylesheet"
    />
  </head>
  <body class="d-flex h-100 justify-content-center align-items-center">
    <!-- Start Body Home -->
    <div class="home overflow-hidden">
      <div class="logo mx-auto">
        <img
          src="./assets/elarby group logo.jpg"
          alt="logo"
          class="w-100 h-100"
        />
      </div>
      <form
      method="POST" action="{{ route('login') }}"
      class="login overflow-hidden"
      >
      @csrf
        <div class="form-field">
          <label for="email">
            <i class="fa-solid fa-user" style="color: #4a9494"></i>
          </label>
          <input
            type="email"
            name="email"  
            id="email"
            placeholder="البريد الالكترونى"
            required
          />
        </div>
        <div class="form-field">
          <label for="password">
            <i class="fa-solid fa-lock" style="color: #4a9494"></i>
          </label>
          <input
            type="password"
            name="password"
            id="emp-pass"
            placeholder="كود المرور"
            required
          />
        </div>
        <div class="form-field" id="select">
          <label
            for="select"
            class="d-flex justify-content-center align-content-center"
          >
            <i class="fa-solid fa-briefcase pt-1" style="color: #4a9494"></i>
          </label>
          <select name="guard" id="position" class="px-2 fs-5" required>
            <option value="user">موظف</option>
            <option value="admin">مسئول</option>
          </select>
        </div>
        <!-- Remember Me 
                <div class="block mt-4">
                  <label for="remember_me" class="inline-flex items-center">
                      <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                      <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                  </label>
              </div>
      
              <div class="flex items-center justify-end mt-4">
                  @if (Route::has('password.request'))
                      <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                          {{ __('Forgot your password?') }}
                      </a>
                  @endif
        -->
        <div class="form-field">
          <input type="submit" value="تسجيل الدخول" class="btn btn-dark" />
        </div>
      </form>
    </div>
    <!-- End Body Home -->

    <!-- Importing Scripts -->
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js"
      integrity="sha512-3dZ9wIrMMij8rOH7X3kLfXAzwtcHpuYpEgQg1OA4QAob1e81H8ntUQmQm3pBudqIoySO5j0tHN4ENzA6+n2r4w=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
  </body>
</html>
