<!-- Start Sidebar -->
<div class="sidebar col-2 p-0 text-white text-center">
    <div class="user-info d-flex justify-content-center align-items-center pt-2 overflow-hidden">
        <i class="fa-solid fa-user-circle ms-3 p-2 rounded-circle fs-1"></i>
        <span class="username fs-5">
            {{ Auth::user()->name }}
            @auth('admin')
                <div class="profile">
                    <a href="{{ route('profile.edit') }}" id="profile">
                        الحساب التعريفي
                    </a>
                </div>
            @endauth
        </span>
    </div>
    <ul class="menu px-3 py-4 text-end list-unstyled">
        @if (checkPerm(0) == 'on' || Auth::guard('admin')->check())
            <li>
                <a href="{{ route('product') }}" id="product" class="text-decoration-none">
                    <i class="fa-solid fa-warehouse"></i>
                    <span>المخزن</span>
                </a>
            </li>
        @endif
        @if (checkPerm(2) == 'on' || Auth::guard('admin')->check())
        <li>
            <a href="{{ route('scrap') }}" id="scrap" class="text-decoration-none">
                <i class="ms-2 fa-solid fa-prescription-bottle text-white"></i>
                <span>سكراب</span>
            </a>
        </li>
        @endif
        @if (checkPerm(12) == 'on' || Auth::guard('admin')->check())
        <li>
            <a href="{{ route('quotations') }}" id="quotations" class="text-decoration-none">
                <i class="fa-solid fa-hand-holding-dollar"></i>
                <span>عروض الأسعار</span>
            </a>
        </li>
        @endif
        @if (checkPerm(1) == 'on' || Auth::guard('admin')->check())
        <li>
            <a href="{{ route('purchas') }}" id="purchas" class="text-decoration-none">
                <i class="fa-solid fa-cart-shopping"></i>
                <span>المشتريات</span>
            </a>
        </li>
        @endif
        @if (checkPerm(3) == 'on' || Auth::guard('admin')->check())
        <li>
            <a href="{{ route('rental') }}" id="rental" class="text-decoration-none">
                <i class="fa-solid fa-truck-ramp-box"></i>
                <span>التأجير</span>
            </a>
        </li>
        @endif
        <!-- <li>
          <a href="" id="sales" class="text-decoration-none">
              <i class="fa-solid fa-warehouse"></i>
              <span>المبيعات</span>
          </a>
      </li> -->
      @if (checkPerm(4) == 'on' || Auth::guard('admin')->check())
        <li>
            <a href="{{ route('users') }}" id="users" class="text-decoration-none">
                <i class="fa-solid fa-user-large"></i>
                <span>شئون العاملين</span>
            </a>
        </li>
        @endif
        @if (checkPerm(5) == 'on' || Auth::guard('admin')->check())
        <li>
            <a href="{{ route('allagent') }}" id="agents" class="text-decoration-none">
                <i class="fa-solid fa-user-group"></i>
                <span>العملاء</span>
            </a>
        </li>
        @endif
        @if (checkPerm(6) == 'on' || Auth::guard('admin')->check())
        <li>
            <a href="{{ route('po') }}" id="po" class="text-decoration-none">
                <i class="fa-solid fa-money-check-dollar"></i>
                <span>PO</span>
            </a>
        </li>
        @endif
        @if (checkPerm(7) == 'on' || Auth::guard('admin')->check())
        <li>
            <a href="{{ route('po_collected') }}" id="po_collected" class="text-decoration-none">
                <i class="fa-solid fa-money-bill"></i>
                <span>تحصيل ال PO</span>
            </a>
        </li>
        @endif
        @if (checkPerm(8) == 'on' || Auth::guard('admin')->check())
        <li>
            <a href="{{ route('custody') }}" id="custody"class="text-decoration-none">
                <i class="fa-solid fa-vault"></i>
                <span>العهدة</span>
            </a>
        </li>
        @endif
        @if (checkPerm(9) == 'on' || Auth::guard('admin')->check())
        <li>
            <a href="{{ route('barren') }}" id="barren" class="text-decoration-none">
                <i class="fa-solid fa-pen-to-square" style="color: #ffffff"></i>
                <span>الجرد</span>
            </a>
        </li>
        @endif
        @if (checkPerm(10) == 'on' || Auth::guard('admin')->check())
        <li>
            <a href="{{ route('prochis') }}" id="prochis" class="text-decoration-none">
                <i class="fa-solid fa-clock-rotate-left"></i>
                <span>تاريخ العمليات</span>
            </a>
        </li>
        @endif
        @if (checkPerm(11) == 'on' || Auth::guard('admin')->check())
        <li>
            <a href="{{ route('catalogue') }}" id="catalogue" class="text-decoration-none">
                <i class="fa-solid fa-address-book"></i>
                <span>الفهرس</span>
            </a>
        </li>
        @endif
    </ul>
</div>
<!-- End Sidebar -->
