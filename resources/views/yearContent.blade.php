<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-/assets-path="..//assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Courses</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/assets/img/favicon/favicon.ico" />
    <script src="https://kit.fontawesome.com/3b333d68c5.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <script src="https://kit.fontawesome.com/3b333d68c5.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="/assets/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="/assets/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="/assets/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="..//assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="/assets/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <style>
    .overlay-image {
      cursor: pointer;
    }

    .overlay-image.fullscreen {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: contain;
      z-index: 9999;
    }
    </style>


    <!-- Helpers -->
    <script src="/assets/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="..//assets/js/config.js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
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
            <li class="menu-item">
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
            <li class="menu-item active open">
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
                <li class="menu-item active">
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

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-fluid flex-grow-1 container-p-y">
              <!-- Layout Demo -->





<div class="card">
  <h2 class="card-header text-center">الصف {{ $year->name }} الثانوي</h2>
</div>

<div class="row mt-5">
    <div class="col-md-6 col-xl-6">
        <a href="/students/year/{{ $year->id }}">
            <div class="card bg-primary text-white mb-3">
            <div class="card-header"><i class="fa-solid fa-people-group fa-xl"></i></div>
            <div class="card-body">
                <h5 class="card-title text-white">Students ({{ $year->students }})</h5>
                <p class="card-text">Total number of enrolled students in year {{ $year->id }}.</p>
            </div>
            </div>
        </a>
      </div>
      
      <div class="col-md-6 col-xl-6 mb-2">
        <a href="/courses/year/{{ $year->id }}">
            <div class="card bg-secondary text-white mb-3">
            <div class="card-header"><i class="fa-regular fa-folder-open fa-xl"></i></div>
            <div class="card-body">
                <h5 class="card-title text-white">Courses ({{ $year->courses }})</h5>
                <p class="card-text">Number of courses available in year {{ $year->id }}.</p>
            </div>
            </div>
        </a>
      </div>
      
      <div class="col-md-6 col-xl-6 mb-2">
        <div class="card bg-success text-white mb-3">
          <div class="card-header"><i class="fa-regular fa-circle-question fa-xl"></i></div>
          <div class="card-body">
            <h5 class="card-title text-white">Questions ({{ $year->questions }})</h5>
            <p class="card-text">Total number of questions added in year {{ $year->id }}.</p>
          </div>
        </div>
      </div>
      
      <div class="col-md-6 col-xl-6 mb-2">
        <div class="card bg-danger text-white mb-3">
          <div class="card-header"><i class="fa-solid fa-list-check fa-xl"></i></div>
          <div class="card-body">
            <h5 class="card-title text-white">Exams ({{ $year->quizzes }})</h5>
            <p class="card-text">Total number of exams conducted in year {{ $year->id }}.</p>
          </div>
        </div>
      </div>
      
      <div class="col-md-6 col-xl-6 mb-2">
        <div class="card bg-warning text-white mb-3">
          <div class="card-header"><i class="fa-solid fa-book-open-reader fa-xl"></i></div>
          <div class="card-body">
            <h5 class="card-title text-white">Homeworks ({{ $year->homeworks }})</h5>
            <p class="card-text">Number of homework assignments given in year {{ $year->id }}.</p>
          </div>
        </div>
      </div>
      
      <div class="col-md-6 col-xl-6 mb-2">
        <div class="card bg-dark text-white mb-3">
          <div class="card-header"><i class="fa-solid fa-video fa-xl"></i></div>
          <div class="card-body">
            <h5 class="card-title text-white">Videos ({{ $year->videos }})</h5>
            <p class="card-text">Number of educational videos available in year {{ $year->id }}.</p>
          </div>
        </div>
      </div>
      
  </div>







              <!--/ Layout Demo -->
            </div>
            <!-- / Content -->

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
    <!-- build:js /assets/vendor/js/core.js -->
    <script src="/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="/assets/vendor/libs/popper/popper.js"></script>
    <script src="/assets/vendor/js/bootstrap.js"></script>
    <script src="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="/assets/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="/assets/js/main.js"></script>

    <!-- Page JS -->
    <script>
      function showConfirmationModal(ProductId) {
        var modal = $('#confirmationModal');
        var cancelBtn = modal.find('.btn-secondary');
        var confirmBtn = modal.find('#confirmDeleteBtn');

        cancelBtn.off('click').on('click', function() {
          modal.modal('hide');
        });

        confirmBtn.off('click').on('click', function() {
          deleteProduct(ProductId);
          modal.modal('hide');
        });

        modal.modal('show');
      }

      function deleteProduct(ProductId) {
        $.ajax({
          url: '/courses/' + ProductId,
          type: 'DELETE',
          data: {
            _token: '{{ csrf_token() }}'
          },
          success: function() {
            $('#deleteRow' + ProductId).remove();
          },
          error: function() {
            $('#deleteRow' + ProductId).remove();
          }
        });
      }

      function toggleOverlay(image) {
        image.classList.toggle("fullscreen");
      }

      function publish(courseId) {
        $.ajax({
          type: "GET",
          url: '/publish-course/' + courseId,
          success: function(response) {
            console.log(response);
          },
          error: function(error) {
            console.error(error);
          }
        });
      }
    </script>
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
