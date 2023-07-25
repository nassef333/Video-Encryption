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

    <!-- Fonts -->
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

          <nav
          class="layout-navbar container-fluid navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
          id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center mt-3" id="navbar-collapse">
              <h4 class="">
                Products
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
                    {{Auth::user()->fname}}

                    {{Auth::user()->lname}}
                    <br>
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

            <div class="container-fluid flex-grow-1 container-p-y">
              <!-- Layout Demo -->





<div class="card">
  <h2 class="card-header text-center">Course Students</h2>
  <p class="text-center">Total Students: {{ $students->total() }}</p>
  <div class="card-body">
    <div class="search mt-2 mb-5">
        {{-- <a href="#" type="button" class="btn btn-outline-danger btn-sm">Archieve <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAjZJREFUSEvVlU1rE1EUhp8zBeMHJgtRLEQoCgqNCLpyIVYRpLhQUCkiuHMhFErnJogo1YALkXTu0OAvcKEbCy78Al0VFFQUQbQupCCCIBGRbBpIMkcmxNo0zcyodOHdnve+z33PnTNXWOElK+xPLEA97yAi38SYt39zmHiAtQ+Aw0CJanVCisXGn4CSAF4Du9umzxEZFtf9kRQSCVDf70f1S4eZ6ktEhsSY+SSQaIDn3UBktMtI9aLk89f+CaDWuoDtYfJdjNkQ1rRczlKv75J8PryrrrVsAvX946hOR54wCAakUPik1k4Co4jkxHXnlu7pAujU1E6azRfAmkiAyKC47qxa+xAYBqbFmJORAC0WV5FOh19NLra/qdR6Go1+ms0PgNPSB0FOCoX3i/d2JFDfP4PqzVhzeIPjnCMIbgFbF/SqFySfv94bYO194EgCQBVId9+oPBbXDYdyYXUmsPYzkF1Ur7SNUgmgoWROjNkWBagBv81ETqM6BuxNCJgXY9YmTRCQSmWo1SYQOZ8Q8FWM2RwFuAOcaAsqYswmnZwcxHHeJQQ8FWP29QZ43iFEnrQFTbLZlIyMNNXau8CxWIjIZXHdqz0BYUGtvQ2caokcZ0jGx2e0XN5Io/EK2BIBqSCyfemftnuSS6V19PXNAHuAZ2Sz+1spfH8A1Xs9hrAOHBVjHkVO8q+iFourSacLwAEg7OuVVrpw0jOZMVTPAjuA8JWbBS6JMR+XSxf74MT2PUbw/wN+AmTpvRlizY8RAAAAAElFTkSuQmCC"/></a> --}}
    </div>
    <form action="/courses/{{ request()->segment(2) }}/students" method="GET" class="form-inline">
      @csrf
        <div class="input-group">
            <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
            <input type="text" class="form-control" placeholder="Search..." aria-label="Search..." aria-describedby="basic-addon-search31" name="searchTerm" value="{{ request('searchTerm') }}">
            <button type="submit" class="btn btn-primary ml-2">Search</button>
        </div>
    </form>
    </div>
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr>
            <th>user id</th>
            <th>name</th>
            <th>phone</th>
            <th>parent phone</th>
            <th>Degree</th>
            <th>Enrolled at</th>
            <th class="text-center">Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @foreach ($students as $student)
            <tr id="deleteRow{{$student->pivot['id']}}">
              <td>{{ $student->id }}</td>
              <td>{{ $student->fname }} {{ $student->lname }}</td>
              <td>{{ $student->email }}</td>
              <td>{{ $student->pphone }}</td>
              <td>{{ $student->pivot['score'] }}</td>
              <td>{{ $student->pivot['created_at'] }}</td>
              <td class="text-center">
                <div class="btn-group">
                    <button type="button" onclick="showConfirmationModal({{ $student->pivot['id'] }})" class="btn btn-outline-danger btn-sm">clear</button>
              </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="d-flex justify-content-center mb-1 mt-4">
      <nav aria-label="Page navigation">
        <ul class="pagination">

          <!-- First Page Link -->
          <li class="page-item {{ $students->onFirstPage() ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $students->url(1) }}" aria-label="First">
              <span aria-hidden="true">&laquo;&laquo;</span>
              <span class="sr-only"></span>
            </a>
          </li>

          <!-- Previous Page Link -->
          <li class="page-item {{ $students->onFirstPage() ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $students->previousPageUrl() }}" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
              <span class="sr-only"></span>
            </a>
          </li>

          <!-- Pagination Links -->
          @php
              $totalPages = $students->lastPage();
              $currentPage = $students->currentPage();
              $visiblePages = 5; // Number of visible pages (adjust as needed)
              $halfVisible = floor($visiblePages / 2);
              $startPage = max(min($currentPage - $halfVisible, $totalPages - $visiblePages + 1), 1);
              $endPage = min($startPage + $visiblePages - 1, $totalPages);
          @endphp

          @for ($page = $startPage; $page <= $endPage; $page++)
            <li class="page-item {{ $page == $students->currentPage() ? 'active' : '' }}">
              <a class="page-link" href="{{ $students->url($page) }}">{{ $page }}</a>
            </li>
          @endfor

          <!-- Next Page Link -->
          <li class="page-item {{ $students->currentPage() == $students->lastPage() ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $students->nextPageUrl() }}" aria-label="Next">
              <span aria-hidden="true">&raquo;</span>
              <span class="sr-only"></span>
            </a>
          </li>

          <!-- Last Page Link -->
          <li class="page-item {{ $students->currentPage() == $students->lastPage() ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $students->url($students->lastPage()) }}" aria-label="Last">
              <span aria-hidden="true">&raquo;&raquo;</span>
              <span class="sr-only"></span>
            </a>
          </li>

        </ul>
      </nav>
    </div>

    <!-- Page x of y -->
    <div class="d-flex justify-content-center">
      <p>Page {{ $students->currentPage() }} of {{ $students->lastPage() }}</p>
    </div>

  </div>
</div>
<!-- Confirmation Modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmationModalLabel">Confirm Deletion</h5>
      </div>
      <div class="modal-body">
        <p>Are you sure ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" id="confirmDeleteBtn" class="btn btn-danger">Delete</button>
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
          url: '/homeworks/students/clear/' + ProductId,
          type: 'GET',
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
