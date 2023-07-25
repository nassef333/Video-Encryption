<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-/assets-path="/assets/"
  data-template="vertical-menu-template-free"
>
<head>
  <meta charset="utf-8" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
  />

  <title>Dashboard</title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="/assets/img/favicon/favicon.ico" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
    rel="stylesheet"
  />

  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="/assets/vendor/fonts/boxicons.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="/assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="/assets/vendor/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
  <link rel="stylesheet" href="../assets/vendor/libs/apex-charts/apex-charts.css">
  <!-- Page CSS -->



  <!-- Helpers -->
  <script src="/assets/vendor/js/helpers.js"></script>

  <script src="/assets/js/config.js"></script>
</head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo mt-3 mb-3">
            <a href="/admin/dashboard" class="app-brand-link">
              <span class="app-brand-logo demo" style="width: 20%">
                <img src="/assets/img/icons/logo.png" style="width: 100%" alt="">
              </span>
              <span class="app-brand-text menu-text fw-bolder ms-2">Mr.AbdulMoaty</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item active">
              <a href="/admin/dashboard" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
              </a>
            </li>



            {{-- PAGES --}}
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Categories & Products</span>
            </li>
            <li class="menu-item">
              <a href="" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dock-top"></i>
                <div data-i18n="Account Settings">Categories</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="/admin/category/create" class="menu-link">
                    <div data-i18n="Account">Add Category</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="/admin/category" class="menu-link">
                    <div data-i18n="Notifications">Show Categories</div>
                  </a>
                </li>
                {{-- <li class="menu-item">
                  <a href="pages-account-settings-connections.html" class="menu-link">
                    <div data-i18n="Connections">Archieved Categories</div>
                  </a>
                </li> --}}
              </ul>
            </li>
            <li class="menu-item">
              <a class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
                <div data-i18n="Authentications">Products</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="/admin/product/create" class="menu-link">
                    <div data-i18n="Basic">Add Product</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="/admin/product" class="menu-link">
                    <div data-i18n="Basic">Products</div>
                  </a>
                </li>
                {{-- <li class="menu-item">
                  <a href="auth-forgot-password-basic.html" class="menu-link" target="_blank">
                    <div data-i18n="Basic">Arcieved Products</div>
                  </a>
                </li> --}}
              </ul>
            </li>
            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cube-alt"></i>
                <div data-i18n="Misc">Orders</div>
              </a>
              <ul class="menu-sub">
                <!-- <li class="menu-item">
                  <a href="pages-misc-under-maintenance.html" class="menu-link">
                    <div data-i18n="Under Maintenance">Return order</div>
                  </a>
                </li> -->
                <li class="menu-item">
                  <a href="/admin/new-orders" class="menu-link">
                    <div data-i18n="Error">New Orders</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="/admin/order" class="menu-link">
                    <div data-i18n="Error">All Orders</div>
                  </a>
                </li>
                <!-- <li class="menu-item">
                  <a href="pages-misc-under-maintenance.html" class="menu-link">
                    <div data-i18n="Under Maintenance">Returned orders</div>
                  </a>
                </li> -->
              </ul>
            </li>

            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Statics</span>
            </li>

            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cube-alt"></i>
                <div data-i18n="Misc">Brands</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="/admin/brand/create" class="menu-link">
                    <div data-i18n="Error">New Brand</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="/admin/brand" class="menu-link">
                    <div data-i18n="Error">All Brands</div>
                  </a>
                </li>
              </ul>
            </li>


            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cube-alt"></i>
                <div data-i18n="Misc">Areas</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="/admin/area/create" class="menu-link">
                    <div data-i18n="Error">New Area</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="/admin/area" class="menu-link">
                    <div data-i18n="Error">All Areas</div>
                  </a>
                </li>
              </ul>
            </li>

            <li class="menu-item">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-cube-alt"></i>
                <div data-i18n="Misc">Swipers</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="/admin/swipers/create" class="menu-link">
                    <div data-i18n="Error">New Swiper</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="/admin/swipers" class="menu-link">
                    <div data-i18n="Error">All Swipers</div>
                  </a>
                </li>
              </ul>
            </li>

            <!-- Components -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">ADMINS</span></li>

            <!-- Extended components -->
            <li class="menu-item">
              <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-copy"></i>
                <div data-i18n="Extended UI">Admins</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="/admin/admin/create" class="menu-link">
                    <div data-i18n="Perfect Scrollbar">Add Admin</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="/admin/admin" class="menu-link">
                    <div data-i18n="Text Divider">Show Admins</div>
                  </a>
                </li>
              </ul>
            </li>


          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center mt-3" id="navbar-collapse">
              <h4 class="">
                Dashboard
              </h4>
              <!-- Search -->
              <div class="navbar-nav align-items-center">

              </div>
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Place this tag where you want the button to render. -->

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="/assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="/assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block">{{Auth::user()->name}}</span>
                            <small class="text-muted">Admin</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>

                      <div class="dropdown-divider"></div>
                    <li>
                      <a class="dropdown-item" href="/admin/logout">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                    </li>
                  </ul>
                </li>

                <li class="nav-item lh-1 me-3">
                  <p>
                    {{Auth::user()->name}}
                  </p>
                  <p></p>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->


                          <!-- Content wrapper -->
                          <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                      <div class="row text-center" style="direction:rtl">
                        <div class="col-md-6 col-xl-6">
                            <a href="/years/2">
                                <div class="card bg-primary text-white mb-3">
                                    <div class="card-body">
                                      <h3 class="card-title text-white">الصف الثاني الثانوي</h3>
                                      <p class="card-text">اضغط هنا لأدارة محتوي الصف الثاني الثانوي ! </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-md-6 col-xl-6">
                            <a href="/years/3">
                                <div class="card bg-dark text-white mb-3">
                                    <div class="card-body">
                                        <h3 class="card-title text-white">الصف الثالث الثانوي</h3>
                                        <p class="card-text">اضغط هنا لأدارة محتوي الصف الثالث الثانوي !</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                      </div>
                        <div class="row">
                            <div class="col-lg-8 mb-4 order-0">
                                <div class="card">
                                    <div class="d-flex align-items-end row">
                                        <div class="col-sm-7">
                                            <div class="card-body">
                                                <h5 class="card-title text-primary">Hello {{$user->fname}} {{ $user->lname }} ! 🎉</h5>
                                                <p class="mb-4">
                                                Welcome to Al-Mutamyzon Dashboard, where you have the power to ignite and elevate our company's success!
                                                </p>

                                                <a href="/admin/new-orders" class="btn btn-sm btn-outline-primary">New Orders</a>
                                            </div>
                                        </div>
                                        <div class="col-sm-5 text-center text-sm-left">
                                            <div class="card-body pb-0 px-0 px-md-4">
                                                <img src="../assets/img/illustrations/man-with-laptop-light.png" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 order-1">
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">
                                                        <img src="../assets/img/icons/unicons/chart-success.png" alt="chart success" class="rounded" />
                                                    </div>
                                                    <div class="dropdown">

                                                    </div>
                                                </div>
                                                <span class="fw-semibold d-block mb-1">Orders</span>
                                                <h3 class="card-title mb-2"> // Orders</h3>
                                                <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i>//</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-6 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">
                                                        <img src="../assets/img/icons/unicons/wallet-info.png" alt="Credit Card" class="rounded" />
                                                    </div>
                                                    <div class="dropdown">

                                                    </div>
                                                </div>
                                                <span>Products</span>
                                                <h3 class="card-title text-nowrap mb-1">// Products</h3>
                                                <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i>//</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Total Revenue -->
                            <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                                <div class="card">
                                    <div class="row row-bordered g-0">
                                        <div class="col-md-8">
                                            <h5 class="card-header m-0 me-2 pb-3">Total Revenue</h5>
                                            <div id="totalRevenueChart" class="px-2"></div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card-body">
                                                <div class="text-center">
                                                    <div class="dropdown">

                                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="growthReportId">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="growthChart"></div>
                                            <div class="text-center fw-semibold pt-3 mb-2">// vOrders Growth</div>

                                            <div class="d-flex px-xxl-4 px-lg-2 p-4 gap-xxl-3 gap-lg-1 gap-3 justify-content-between">
                                                <div class="d-flex">
                                                    <div class="me-2">
                                                        <span class="badge bg-label-primary p-2"><i class="bx bx-dollar text-primary"></i></span>
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <small>&copy; //</small>
                                                        <h6 class="mb-0">$32.5k</h6>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/ Total Revenue -->
                            <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
                                <div class="row">
                                    <div class="col-6 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">
                                                        <img src="../assets/img/icons/unicons/paypal.png" alt="Credit Card" class="rounded" />
                                                    </div>
                                                    <div class="dropdown">
                                                        <button class="btn p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                                            <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                                            <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <span class="d-block mb-1">Payments</span>
                                                <h3 class="card-title text-nowrap mb-2">//</h3>
                                                <small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i>//</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">
                                                        <img src="../assets/img/icons/unicons/cc-primary.png" alt="Credit Card" class="rounded" />
                                                    </div>
                                                    <div class="dropdown">
                                                        <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                              </button>
                                                        <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                                            <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                                            <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <span class="fw-semibold d-block mb-1">Categories</span>
                                                <h3 class="card-title mb-2">//</h3>
                                                <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i>//</small>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- </div>
    <div class="row"> -->
      
                                    <div class="col-12 mb-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                                                    <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                                        <div class="card-title">
                                                            <h5 class="text-nowrap mb-2">Profile Report</h5>
                                                            <span class="badge bg-label-warning rounded-pill">&copy; {{ date('Y') }}</span>
                                                        </div>
                                                        <div class="mt-sm-auto">
                                                            <small class="text-success text-nowrap fw-semibold"><i class="bx bx-chevron-up"></i> 68.2%</small
                                >
                                <h3 class="mb-0">$84,686k</h3>
                              </div>
                            </div>
                            <div id="profileReportChart"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <!-- Order Statistics -->


                                    <!-- Footer -->
                                    <footer class="content-footer footer bg-footer-theme">
              <div class="mb-2 mb-md-2" style="text-align: center;">
                ©
                <script>
                  document.write(new Date().getFullYear());
                </script>
                , powered by
                <a href="https://wa.me/201112377882" target="_blank" class="footer-link fw-bolder">Nassef</a>,
                all rights reserved.
              </div>
          </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->



        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->


    <!-- Core JS -->
    <!-- build:js /assets/js/core.js -->
    <script src="/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="/assets/vendor/libs/popper/popper.js"></script>
    <script src="/assets/vendor/js/bootstrap.js"></script>
    <script src="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="/assets/js/main.js"></script>
    <script src="/assets/vendor/libs/apex-charts/apexcharts.js"></script>
    <!-- Page JS -->
    <script src="/assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
