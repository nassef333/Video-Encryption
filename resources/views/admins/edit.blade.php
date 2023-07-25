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

    <title>Edit User</title>

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
            <li class="menu-item open active">
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
                  <a href="#" class="menu-link">
                    <div data-i18n="Basic">Edit Product</div>
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
              Users
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
                  <br>
                  <span class="text-success">
                    {{Auth::user()->role}}  
                  </span>                    
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
              
              
              <div class="col-xl">
                <div class="card mb-4">
                  <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-4">Edit {{$user->name}}</h4>
                    <small class="text-muted float-end">Edit User</small>
                  </div>
                  <div class="card-body">
                    <form action="/update-admin/{{$user->id}}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <input type="hidden" name="_method" value="PUT">
                      <div class="d-flex">
                        <div class="mb-3 w-100">
                          <label class="form-label" for="basic-default-fullname">First Name</label>
                          <input type="text" class="form-control" id="basic-default-fullname" placeholder="First Name" name="fname" value="{{$user->fname}}" required>
                          @error('fname')
                          <div class="text-danger">{{ $message }}</div>
                          @enderror
                        </div>     
                        <div class="mb-3 w-100">
                          <label class="form-label" for="basic-default-fullname">Last Name</label>
                          <input type="text" class="form-control" id="basic-default-fullname" placeholder="Last Name" name="lname" value="{{$user->lname}}" required>
                          @error('lname')
                          <div class="text-danger">{{ $message }}</div>
                          @enderror
                        </div> 
                      </div>
                      <div class="d-flex">
                        <div class="mb-3 w-100">
                          <label class="form-label" for="basic-default-fullname">Phone</label>
                          <input type="text" class="form-control" id="basic-default-fullname" placeholder="Phone" name="email" value="{{$user->email}}" required>
                          @error('email')
                          <div class="text-danger">{{ $message }}</div>
                          @enderror
                        </div>
                        <div class="mb-3 w-100">
                          <label class="form-label" for="basic-default-fullname">role</label>
                          <select class="form-control" id="basic-default-fullname" name="role"  required>
                            <option value="1" @if($user->role == 1) selected @endif>admin</option>
                            <option value="2" @if($user->role == 2) selected @endif>super admin</option>
                          </select>
                          @error('role')
                          <div class="text-danger">{{ $message }}</div>
                          @enderror
                        </div> 
                      </div>
                      <div class="d-flex">
                        <div class="mb-3 w-100">
                          <label class="form-label" for="basic-default-fullname">Password</label>
                          <input type="text" class="form-control" id="basic-default-fullname" placeholder="password" name="password"  required>
                          @error('password')
                          <div class="text-danger">{{ $message }}</div>
                          @enderror
                        </div>  
                        <div class="mb-3 w-100">
                          <label class="form-label" for="basic-default-fullname">Password Confirmation</label>
                          <input type="text" class="form-control" id="basic-default-fullname" placeholder="password confirmation" name="password_confirmation"  required>
                          @error('password_confirmation')
                          <div class="text-danger">{{ $message }}</div>
                          @enderror
                        </div>  
                      </div>
                      <button type="submit" class="btn btn-primary">Edit User</button>
                    </form>
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
  function previewImage(event) {
var input = event.target;
var preview = document.getElementById('imagePreview');

if (input.files && input.files[0]) {
var reader = new FileReader();

reader.onload = function (e) {
  preview.innerHTML = '<img src="' + e.target.result + '" alt="Image Preview" class="img-thumbnail">';
};

reader.readAsDataURL(input.files[0]);
} else {
preview.innerHTML = '';
}
}

document.getElementById('addInputButton').addEventListener('click', function() {
  var inputContainer = document.createElement('div');
  inputContainer.className = 'mb-3';

  var label = document.createElement('label');
  label.className = 'form-label';
  label.textContent = 'image';

  var div = document.createElement('div');
  div.id = 'imagePreview';

  var input = document.createElement('input');
  input.type = 'file';
  input.className = 'form-control';
  input.name = 'image[]'; // Set the name attribute to "image[]"
  input.accept = 'image/*';
  input.placeholder = 'Upload Image';
  input.onchange = previewImage;
  input.value = '{{ old("image") }}';

  inputContainer.appendChild(label);
  inputContainer.appendChild(div);
  inputContainer.appendChild(input);

  document.getElementById('dynamicInputsContainer').appendChild(inputContainer);
});

</script>
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
