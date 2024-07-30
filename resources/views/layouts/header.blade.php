
<header>
    <!-- Header Start -->
    <div class="header-area">
      <div class="main-header">
        <div class="header-top black-bg d-none d-md-block">
          <div class="container">
            <div class="col-xl-12">
              <div
                class="row d-flex justify-content-between align-items-center"
              >
                <div class="header-info-left">
                  <ul>
                    <li>
                      <img
                        src="{{ URL('storage/icon/header_icon1.png')}}"
                        alt=""
                      />34ºc, Sunny
                    </li>
                    <li>
                      <img
                        src="{{ URL('storage/icon/header_icon1.png')}}"
                        alt=""
                      />Tuesday, 18th June, 2019
                    </li>
                  </ul>
                </div>
                <div class="header-info-right">
                  <ul class="header-social">
                    <li>
                      <a href="#"><i class="fab fa-twitter"></i></a>
                    </li>
                    <li>
                      <a href="#"><i class="fab fa-instagram"></i></a>
                    </li>
                    <li>
                      <a href="#"><i class="fab fa-pinterest-p"></i></a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="header-mid d-none d-md-block">
          <div class="container">
            <div class="row d-flex align-items-center">
              <!-- Logo -->
              <div class="col-xl-3 col-lg-3 col-md-3">
                <div class="logo">
                  <a href="index.html"
                    ><img src="{{ URL('storage/logo/logo.png')}}" alt=""
                  /></a>
                </div>
              </div>
              <div class="col-xl-9 col-lg-9 col-md-9">
                <div class="header-banner f-right">
                  <img src="{{ URL('storage/hero/header_card.jpg')}}" alt="" />
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="header-bottom header-sticky">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-xl-10 col-lg-10 col-md-12 header-flex">
                <!-- sticky -->
                <div class="sticky-logo">
                  <a href="index.html"
                    ><img src="{{ URL('storage/logo/logo.png')}}" alt=""
                  /></a>
                </div>
                <!-- Main-menu -->
                <div class="main-menu d-none d-md-block">
                  <nav>
                    <ul id="navigation">
                      <li><a href="{{ url("/") }}">Trang Chủ</a></li>
                      <li><a href="{{ url("Categories") }}">Danh Mục</a></li>
                      <li><a href="{{ url("About_us") }}">Giới Thiệu</a></li>
                      <li><a href="{{ url("Contact") }}">Liên Hệ</a></li>
                      {{-- <li><a href="contact.html">Contact</a></li> --}}
                      <li>
                        @guest
                        <a href="#">Tài Khoản</a>
                        <ul class="submenu">
                            @if (Route::has('login'))
                          <li><a href="{{ route('login') }}"> {{ __('Đăng Nhập') }}</a></li>
                          @endif
                          @if (Route::has('register'))
                                <li class="nav-item">
                                    <a  href="{{ route('register') }}">{{ __('Đăng Ký') }}</a>
                                </li>
                            @endif

                            @else
                            {{-- <li class="nav-item dropdown"> --}}
                                {{-- <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a> --}}
                                <a href="#"> {{ Auth::user()->name }}</a>
                                <ul class="submenu">

                                <li class="nav-item">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                                @if(Auth::user()->role == 'admin')
                                <li class="nav-item">
                                    <a  href="#">{{ __('Dashboard') }}</a>
                                </li>
                                @endif

                            </li>
                        @endguest
                        </ul>
                      </li>
                    </ul>
                  </nav>
                </div>
              </div>
              <div class=" col-lg-2 col-md-4">
                <div class="header-right-btn f-right d-none d-lg-block">
                  <i class="fas fa-search special-tag"></i>
                  <div class="search-box">
                    <form action="#">
                      <input type="text" placeholder="Search" />
                    </form>
                  </div>
                </div>
              </div>
              <!-- Mobile Menu -->
              <div class="col-12">
                <div class="mobile_menu d-block d-md-none"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Header End -->
  </header>
