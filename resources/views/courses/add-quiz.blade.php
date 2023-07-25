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

    <title>Add Exam</title>

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
                <li class="menu-item">
                  <a href="#" class="menu-link">
                    <div data-i18n="Error">Edit Area</div>
                  </a>
                </li>
              </ul>
            </li>

            <!-- Components -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">ADMINS</span></li>
            
            <!-- Extended components -->
            <li class="menu-item open active">
              <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-copy"></i>
                <div data-i18n="Extended UI">Admins</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item active">
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

          <nav class="layout-navbar container-fluid navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>
          
            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input type="text" class="form-control border-0 shadow-none" placeholder="Search..." aria-label="Search..." />
                </div>
              </div>
              <!-- /Search -->
          
              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Place this tag where you want the button to render. -->
                <li class="nav-item lh-1 me-3">
                  <a class="github-button" href="https://github.com/themeselection/sneat-html-admin-template-free" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star themeselection/sneat-html-admin-template-free on GitHub">Star</a>
                </li>
          
                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="..//assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="..//assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block">John Doe</span>
                            <small class="text-muted">Admin</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">My Profile</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="bx bx-cog me-2"></i>
                        <span class="align-middle">Settings</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <span class="d-flex align-items-center align-middle">
                          <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                          <span class="flex-grow-1 align-middle">Billing</span>
                          <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="auth-login-basic.html">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                    </li>
                  </ul>
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
                    <h4 class="mb-4">Add Exam</h4>
                    <small class="text-muted float-end">Exam</small>
                  </div>
                  <div class="card-body">
                    <form onsubmit="submitExamForm(event)" id="examForm">
                      @csrf
                      <input type="hidden" id="formSubmitted" value="false">
                      <div class="d-flex">
                        <div class="mb-3 w-50">
                          <label class="form-label" for="basic-default-fullname">title</label>
                          <input type="text" class="form-control" id="basic-default-fullname" placeholder="title" name="title" required>
                          @error('title')
                          <div class="text-danger">{{ $message }}</div>
                          @enderror
                        </div> 
                        <div class="mb-3 w-50">
                            <label class="form-label" for="basic-default-fullname">Exam Minutes</label>
                            <input type="number" class="form-control" id="basic-default-fullname" placeholder="minutes" name="minutes" required>
                            @error('minutes')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                          </div> 
                      </div>
                      <div class="d-flex">
                        <div class="mb-3 w-50">
                            <label class="form-label" for="startInput">Start at:</label>
                            <input type="datetime-local" class="form-control" id="startInput" name="start" required>
                            @error('start')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                          </div>
                          <div class="mb-3 w-50">
                            <label class="form-label" for="endInput">End at:</label>
                            <input type="datetime-local" class="form-control" id="endInput" name="end" required>
                            @error('end')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                          </div>
                      </div>
                      <div class="d-flex">
                        <div class="mb-3 w-50">
                            <label class="form-label" for="basic-default-fullname">Model Answer:</label>
                            <select class="form-control" id="basic-default-fullname" name="answerTime" required>
                              <option value="0">Direct After Exam Finish</option>
                              <option value="1">After End Time Exceed</option>
                            </select>                          
                            @error('answerTime')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                          </div>
                          <div class="mb-3 w-50">
                            <label class="form-label" for="basic-default-fullname">Type of Models:</label>
                            <select class="form-control" id="basic-default-fullname" name="is_random" required>
                              <option value="0">Normal</option>
                              <option value="1">Random arrange</option>
                            </select>                          
                            @error('is_random')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                          </div>
                      </div>
                      <div class="d-flex">
                        <div class="mb-3 w-50">
                            <label class="form-label" for="basic-default-fullname">Prize (optional)</label>
                            <input type="text" class="form-control" id="basic-default-fullname" placeholder="Enter Prize" name="prize" required>
                            @error('minutes')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                          </div> 
                          <div class="mb-3 w-50">
                            <label class="form-label" for="basic-default-fullname">Prize Degree (optional)</label>
                            <input type="number" class="form-control" id="basic-default-fullname" placeholder="Enter Prize Degree" name="prizeDegree" required>
                            @error('minutes')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                          </div> 
                      </div>
                      

                      <input type="text" name="week_id" value="{{ request()->segment(2) }}" hidden>
                      <button type="button" class="btn btn-primary" onclick="submitExamForm(event)">Submit</button>
                    </form>

                    <h4 class="mt-5">Add Question</h4>

                    <form method="POST" id="questionForm" enctype="multipart/form-data">
                      @csrf
                      <div class="mb-3">
                        <label class="form-label" for="basic-default-company">image</label>
                        <div id="imagePreview" class="overflow-hidden">
                          <img src="" alt="" style="width: 100%; height: auto;">
                        </div> 
                        <input type="file" class="form-control" id="imageInput" name="img" accept="image/*" placeholder="Upload Image" onchange="previewImage(event)">
                      </div>
                      <div class="mb-3">
                        <label class="form-label" for="basic-default-fullname">Question</label>
                        <textarea class="form-control" id="basic-default-fullname" placeholder="Question" name="question" rows="4"></textarea>
                        @error('question')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div> 

                      
                      <div class="d-flex justify-content-between" style="direction:rtl">
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Choice 1</label>
                          <input type="text" class="form-control" id="basic-default-fullname" placeholder="Choice 1" name="c1" value="أ" >
                          @error('c1')
                          <div class="text-danger">{{ $message }}</div>
                          @enderror
                        </div>  
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Choice 2</label>
                          <input type="text" class="form-control" id="basic-default-fullname" placeholder="Choice 2" name="c2" value="ب">
                          @error('c2')
                          <div class="text-danger">{{ $message }}</div>
                          @enderror
                        </div>  
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Choice 3</label>
                          <input type="text" class="form-control" id="basic-default-fullname" placeholder="Choice 3" name="c3" value="ج">
                          @error('c3')
                          <div class="text-danger">{{ $message }}</div>
                          @enderror
                        </div>  
                        <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Choice 4</label>
                          <input type="text" class="form-control" id="basic-default-fullname" placeholder="Choice 4" name="c4" value="د">
                          @error('c4')
                          <div class="text-danger">{{ $message }}</div>
                          @enderror
                        </div>  
                      </div>
                      <div class="d-flex">
                        <div class="mb-3 w-50">
                          <label class="form-label" for="basic-default-fullname">Degree</label>
                          <input type="number" class="form-control" id="basic-default-fullname" placeholder="Enter Question Degree" name="degree" value="1">
                          @error('degree')
                          <div class="text-danger">{{ $message }}</div>
                          @enderror
                        </div>  
                        <div class="mb-3 w-50">
                          <label class="form-label" for="basic-default-fullname">Answer</label>
                          <select class="form-control" id="basic-default-fullname" name="answer">
                            <option value="1" >1</option>
                            <option value="2" >2</option>
                            <option value="3" >3</option>
                            <option value="4" >4</option>
                          </select>
                          @error('answer')
                          <div class="text-danger">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>

                        <div class="mb-3">
                          <label class="form-label" for="basic-default-fullname">Explain</label>
                          <input type="text" class="form-control" id="basic-default-fullname" placeholder="Answer Explain" name="answer_explain" >
                          <input type="text" name="quiz_id" value="{{ request()->segment(2) }}" hidden >
                          @error('canswer_explain')
                          <div class="text-danger">{{ $message }}</div>
                          @enderror
                        </div>                      
                        <input type="text" name="quiz_id" id="quizIdInput" hidden>

                        <div class="d-flex justify-content-start">
                          <button type="button" class="btn btn-primary" onclick="submitQuestionForm()">Add Question</button>
                        </div>
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
    {{-- <script>
      function submitExamForm(event) {
        // Check if the form has already been submitted
        var formSubmitted = document.getElementById('formSubmitted').value;
        if (formSubmitted === "true") {
          // Form already submitted, do nothing
          return;
        }
    
        // Prevent default form submission behavior
        event.preventDefault();
    
        // Get the form data
        var formData = new FormData(document.getElementById('examForm'));
    
        // Perform the asynchronous form submission using AJAX
        fetch('/submitQuiz', {
          method: 'POST',
          body: formData
        })
        .then(function(response) {
          if (response.ok) {
            return response.json(); // Extract the JSON body content from the response
          } else {
            throw new Error('Network response was not ok.');
          }
        })
        .then(function(data) {
          // Log the response data
          console.log(data);
    
          // Disable form fields to prevent further edits
          var formElements = document.getElementById('examForm').elements;
          for (var i = 0; i < formElements.length; i++) {
            formElements[i].disabled = true;
          }
    
          // Decrease form opacity
          document.getElementById('examForm').style.opacity = "0.5";
    
          // Update the formSubmitted field to mark the form as submitted
          document.getElementById('formSubmitted').value = "true";
        })
        .catch(function(error) {
          // Log and display the error if the form submission failed
          console.error('Error:', error);
          alert('Failed to submit the form.');
        });
      }
    </script> --}}
    

    {{-- <script>
     function submitQuestionForm() {
        var formData = new FormData(document.getElementById('questionForm'));

        fetch('/submitQuizQuestion', {
          method: 'POST',
          body: formData
        })
          .then(function (response) {
            console.log(response)
            if (response.ok) {
              return response.json(); // Extract the JSON body content from the response
            } else {
              throw new Error('Network response was not ok.');
            }
          })
          .then(function (data) {
            // Log the response data
            console.log(data);
            // You can also show a success message to the user if needed
            alert('Question submitted successfully!');

            // Reset the form fields to their initial state after successful submission
            document.getElementById('questionForm').reset();
            document.getElementById('imagePreview').innerHTML = '';
          })
          .catch(function (error) {
            // Log and display the error if the form submission failed
            console.error('Error:', error);
            alert('Failed to submit the question.');
          });
      }
    </script> --}}
    
    <script>
      let quizId = null;
    
      function submitExamForm(event) {
        var formSubmitted = document.getElementById('formSubmitted').value;
        if (formSubmitted === "true") {
          return;
        }
    
        event.preventDefault();
    
        var formData = new FormData(document.getElementById('examForm'));
    
        fetch('/submitQuiz', {
          method: 'POST',
          body: formData
        })
          .then(function (response) {
            if (response.ok) {
              return response.json();
            } else {
              throw new Error('Network response was not ok.');
            }
          })
          .then(function (data) {
            console.log(data);
    
            // Store the id from the response
            quizId = data.data.id;
            console.log(quizId);
    
            // Disable form fields to prevent further edits
            var formElements = document.getElementById('examForm').elements;
            for (var i = 0; i < formElements.length; i++) {
              formElements[i].disabled = true;
            }
    
            // Decrease form opacity
            document.getElementById('examForm').style.opacity = "0.5";
    
            // Update the formSubmitted field to mark the form as submitted
            document.getElementById('formSubmitted').value = "true";
    
            // Enable the question form and set quiz_id in the hidden input
            document.getElementById('quizIdInput').value = quizId;
            document.getElementById('questionForm').style.opacity = "1";
            var questionFormElements = document.getElementById('questionForm').elements;
            for (var j = 0; j < questionFormElements.length; j++) {
              questionFormElements[j].disabled = false;
            }
    
            // Enable the "Add Question" button
            document.querySelector('#questionForm button').disabled = false;
          })
          .catch(function (error) {
            console.error('Error:', error);
            alert('Failed to submit the form.');
          });
      }
    
      function submitQuestionForm() {
        // Check if the quizId is available
        if (!quizId) {
          alert('Please submit the first form (Add Exam) before submitting the second form (Add Question).');
          return;
        }
    
        var formData = new FormData(document.getElementById('questionForm'));
    
        // Set the quiz_id value in the form data
        formData.set('quiz_id', quizId);
    
        fetch('/submitQuizQuestion', {
          method: 'POST',
          body: formData
        })
          .then(function (response) {
            if (response.ok) {
              return response.json();
            } else {
              throw new Error('Network response was not ok.');
            }
          })
          .then(function (data) {
            console.log(data);
            alert('Question submitted successfully!');
    
            // Reset the form fields to their initial state after successful submission
            document.getElementById('questionForm').reset();
            document.getElementById('imagePreview').innerHTML = '';
          })
          .catch(function (error) {
            console.error('Error:', error);
            alert('Failed to submit the question.');
          });
      }
    </script>
    
    
    
    
  
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


<!-- Add this JavaScript code to your HTML page -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
