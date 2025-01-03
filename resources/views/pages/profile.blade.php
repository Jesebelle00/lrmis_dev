@extends('layout.layout')
@section('content')

<link rel="stylesheet" href="{{ asset('assets/css/profilepage.css') }}">

    <div class="row mx-4">
      <div class="container-fluid cont-prof py-0">
          <div class="row row_card">
              <div class="ccol-sm-6 col-md-4 col-lg-4 mt-3 ">
                  <div class="card card-small mb-4">
                      <div class="card-header border-bottom text-center" style="background-color: #fff; padding-bottom: 3px">
                          <div class="user-profile">
                              <div class="user-avatar">
                                  <img  src="{{ asset('profile_picture/default-icon.jpg') }}" alt="image" srcset="" class="profilepic" style="text-align: center"><br>
                              </div>
                          </div>

                          {{-- <h6 class="fullname mt-2 mb-0"><?php echo ' '.$user_details[0]['first_name'].' '.$user_details[0]['last_name'].''?></h6>
                          <p class="usertype my-0 py-0"><?php echo ' '. htmlspecialchars($user_details[0]['user_type_name']);?></p>
                          <p class="username">@<?php echo htmlspecialchars($user_details[0]['name']);?></p> --}}
                      </div>
                      <div class="card-body p-0 px-1 pb-2">
                          <div class="mx-0" id="myDIV">
                              <div class="accordion accordion-flush" >
                                  <div class="accordion-item mb-1">
                                      <h2 class="accordion-header text-center" style="text-align: center" >
                                      <button class="btn1 active1" style="width: 100%" type="button"  aria-expanded="false">
                                        <a href="#personal_information" style="width: 100%; text-decoration:none; color: white; font-size: 16px;" onclick="showSection('personal_information'); return false;">
                                            Personal Information
                                        </a>
                                      </button>
                                      </h2>
                                  </div>
                                  <div class="accordion-item mb-1">
                                      <h2 class="accordion-header text-center" >
                                      <button class="" style="width: 100%" type="button"  aria-expanded="false">
                                        <a href="#contact_details" class="" style="width: 100%; text-decoration:none; color: #344767; font-size: 16px;" onclick="showSection('contact_details'); return false;">
                                            Contact Details
                                        </a>
                                      </button>
                                      </h2>
                                  </div>
                                  <div class="accordion-item mb-1">
                                      <h2 class="accordion-header text-center" >
                                      <button class="" style="width: 100%" type="button"  aria-expanded="false">
                                          <a href="#profile_picture" style="color:  #344767;  text-decoration:none; font-size: 16px" onclick="showSection('profile_picture'); return false;">  Profile Picture </a>
                                      </button>
                                      </h2>
                                  </div>
                                  <div class="accordion-item">
                                      <h2 class="accordion-header text-center" >
                                      <button class="" style="width: 100%" type="button" >
                                          <a href="#user_password" style="color: #344767; text-decoration:none; font-size: 16px" onclick="showSection('user_password'); return false;"> Password</a>
                                      </button>
                                      </h2>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <!-- PROFILE INFORMATION -->
              <div class="col-sm-12 col-md-8  my-3 section" id="personal_information">
                  <div class="card card-small mb-2" style="border-radius: 25px">
                      <div class="card-header border-bottom text-left pt-1" style="background-color: #0071BD; padding-bottom: 0px;">
                      <p style="color: white; font-size: 18px; font-weight: 400" class="mt-2" >Personal Information</p>
                      </div>
                  <div class="mx-3 mt-4">
                    <form id="informationForm">
                      <div class="row">
                          <div class="col-md-6 col-sm-12">
                          <!-- First Name -->
                          <label for="" class="form-label fw-bold required">First Name</label>
                          <span id="errorF"></span>
                            <div class="input-group input-group-outline mb-1">
                                <input id="first_name"  type="text" name="first_name" class="form-control" value="{{$profileService->Firstname}}" >

                            </div>
                          </div>

                          <div class="col-md-6 col-sm-12">
                          <!-- Last Name -->
                          <label for="" class="form-label fw-bold required">Last Name</label>
                            <div class="input-group input-group-outline mb-1">
                                <input id="last_name" type="text" name="last_name" class="form-control" value="{{$profileService->Lastname}}" class="" >
                                <span class=""  id="errorL"></span>
                            </div>
                          </div>

                          <div class="col-md-6 col-sm-12">
                          <!-- Username -->
                          <label for="" class="form-label fw-bold required">Username</label>
                            <div class="input-group input-group-outline mb-1 ">
                                <input id="username"  type="text" name="username" class="form-control px-2 " value=" {{$profileService->Username}}" >
                                <span class=""  id="error"></span>
                            </div>
                          </div>

                          <div class="col-md-6 col-sm-12">
                          <!-- TIN -->
                          <label for="" class="form-label fw-bold required">TIN</label>
                            <div class="input-group input-group-outline mb-1 ">
                                <input id="tin"  type="text" name="tin"
                                class="form-control px-2 "
                                value=" {{$profileService->TIN}}" >
                                <span class=""  id="error"></span>
                            </div>
                          </div>
                      </div>

                      </div>

                      <div class="row mt-4 my-0 pb-3 col-sm-12">
                        <div class="col-sm-12 d-flex justify-content-center">
                          <button type="button" class="shadow-dark submitbtn" id="saveInformation" style="width: 130px">Update</button>
                        </div>
                      </div>
                    </form>
                  </div>
              </div>

              <script>
                $('#saveInformation').on('click', function(e) {
                    e.preventDefault();

                    $('#errorF').text('');
                    $('#errorL').text('');
                    $('#error').text('');

                    let isValid = true;

                    const firstName = $('#first_name').val().trim();
                    const lastName = $('#last_name').val().trim();
                    const username = $('#username').val().trim();
                    const tin = $('#tin').val().trim();

                    if (firstName === '') {
                      $('#errorF').text('First Name is required.');
                      isValid = false;
                    }
                    if (lastName === '') {
                      $('#errorL').text('Last Name is required.');
                      isValid = false;
                    }
                    if (username === '') {
                      $('#error').text('Username is required.');
                      isValid = false;
                    }
                    if (tin === '') {
                      $('#error').text('TIN is required.');
                      isValid = false;
                    }

                    if (isValid) {
                      const formData = {
                        first_name: firstName,
                        last_name: lastName,
                        username: username,
                        tin: tin
                      };

                      $('#saveInformation').prop('disabled', true);

                      $.ajax({
                        url: 'user_profile/update_information.php',
                        type: 'POST',
                        data: formData,
                        success: function(response) {
                          const result = JSON.parse(response);
                          alert(result.message);
                          if (result.success) {
                            location.reload()
                          }
                        },
                        error: function(xhr, status, error) {
                          console.error('AJAX error:', error);
                          alert('An error occurred. Please try again.');
                        },
                        complete: function() {
                          $('#saveInformation').prop('disabled', false);
                        }
                      });
                    }
                  });

              </script>
              <!-- PROFILE DETAILS END -->

              <!-- CONTACT DETAILS -->
              <div class="col-sm-12 col-md-8  my-3 section" id="contact_details" style="display: none;">
                  <div class="card card-small mb-2" style="border-radius: 25px">
                      <div class="card-header border-bottom text-left pt-1" style="background-color: #0071BD; padding-bottom: 0px;">
                        <p style="color: white; font-size: 18px; font-weight: 400" class="mt-2" >Contact Details</p>
                      </div>
                    <form id="contactForm">
                      <div class="mx-3 mt-4" >
                        <div class="row">
                            <h6>
                                {{-- @if (!empty($profileService->Contacts) && is_iterable($profileService->Contacts))
                                    {{ 'Contacts Loaded' }}
                                    <pre>
                                        {{ print_r($profileService->Contacts, true) }}
                                    </pre>
                                @else
                                    {{ 'No Contacts Available' }}
                                @endif --}}
                            </h6>
                            @php
                                $email = $fax = $instant_messaging = $mobile_number = $phone = $social_media = "";
                                $email_id = $fax_id = $instant_messaging_id = $mobile_number_id = $phone_id = $social_media_id = 0;
                                $email_type_id = $fax_type_id = $instant_messaging_type_id = $mobile_number_type_id = $phone_type_id = $social_media_type_id = 0;
                            @endphp

                            @if (!empty($profileService->Contacts) && is_iterable($profileService->Contacts))
                                @foreach ($profileService->Contacts as $contact)
                                    @php

                                        $contact_type_id = $contact['contact_type_id'] ?? null;
                                        $contact_value = $contact['contact_value'] ?? null;
                                        $contact_id = $contact['contact_id'] ?? null;

                                        if (!empty($contact_type_id)) {
                                            switch ($contact_type_id) {
                                                case 1:  // Email
                                                    $email = $contact_value ?? $email;
                                                    $email_id = $contact_id ?? $email_id;
                                                    $email_type_id = $contact_type_id ?? $email_type_id;
                                                    break;
                                                case 2:  // Fax
                                                    $fax = $contact_value ?? $fax;
                                                    $fax_id = $contact_id ?? $fax_id;
                                                    $fax_type_id = $contact_type_id ?? $fax_type_id;
                                                    break;
                                                case 3:  // Instant Messaging
                                                    $instant_messaging = $contact_value ?? $instant_messaging;
                                                    $instant_messaging_id = $contact_id ?? $instant_messaging_id;
                                                    $instant_messaging_type_id = $contact_type_id ?? $instant_messaging_type_id;
                                                    break;
                                                case 4:  // Mobile Number
                                                    $mobile_number = $contact_value ?? $mobile_number;
                                                    $mobile_number_id = $contact_id ?? $mobile_number_id;
                                                    $mobile_number_type_id = $contact_type_id ?? $mobile_number_type_id;
                                                    break;
                                                case 5:  // Phone
                                                    $phone = $contact_value ?? $phone;
                                                    $phone_id = $contact_id ?? $phone_id;
                                                    $phone_type_id = $contact_type_id ?? $phone_type_id;
                                                    break;
                                                case 6:  // Social Media
                                                    $social_media = $contact_value ?? $social_media;
                                                    $social_media_id = $contact_id ?? $social_media_id;
                                                    $social_media_type_id = $contact_type_id ?? $social_media_type_id;
                                                    break;
                                            }
                                        }
                                    @endphp
                                @endforeach
                            @endif

                            <div class="col-md-6 col-sm-12">
                                <!-- Email Address -->
                                <label for="" class="form-label fw-bold required" data-toggle="tooltip" data-placement="top">Email Address</label>
                                <div class="input-group input-group-outline mb-1">
                                    <input id="email" type="email" name="email" class="form-control" value="{{ $email }}" data-toggle="tooltip" data-placement="top">
                                    <input id="email_id" type="text" name="email_id" class="form-control" value="{{ $email_id }}">
                                    <input id="email_type_id" type="text" name="email_type_id" class="form-control" value="{{ $email_type_id }}">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <!-- FAX -->
                                <label for="" class="form-label fw-bold" data-toggle="tooltip" data-placement="top">FAX</label>
                                <div class="input-group input-group-outline mb-1">
                                    <input id="fax" type="text" name="fax" class="form-control" value="{{ $fax }}" data-toggle="tooltip" data-placement="top">
                                    <input id="fax_id" type="text" name="fax_id" class="form-control" value="{{ $fax_id }}">
                                    <input id="fax_type_id" type="text" name="fax_type_id" class="form-control" value="{{ $fax_type_id }}">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <!-- Instant Messaging -->
                                <label for="" class="form-label fw-bold" data-toggle="tooltip" data-placement="top">Instant Messaging</label>
                                <div class="input-group input-group-outline mb-1">
                                    <input id="instant_messaging" type="text" name="instant_messaging" class="form-control" value="{{ $instant_messaging }}" data-toggle="tooltip" data-placement="top">
                                    <input id="instant_messaging_id" type="text" name="instant_messaging_id" class="form-control" value="{{ $instant_messaging_id }}">
                                    <input id="instant_messaging_type_id" type="text" name="instant_messaging_type_id" class="form-control" value="{{ $instant_messaging_type_id }}">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <!-- Mobile Number -->
                                <label for="" class="form-label fw-bold" data-toggle="tooltip" data-placement="top">Mobile Number</label>
                                <div class="input-group input-group-outline mb-1">
                                    <input id="mobile_number" type="text" name="mobile_number" class="form-control" value="{{ $mobile_number }}" data-toggle="tooltip" data-placement="top">
                                    <input id="mobile_number_id" type="text" name="mobile_number_id" class="form-control" value="{{ $mobile_number_id }}">
                                    <input id="mobile_number_type_id" type="text" name="mobile_number_type_id" class="form-control" value="{{ $mobile_number_type_id }}">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <!-- Phone -->
                                <label for="" class="form-label fw-bold" data-toggle="tooltip" data-placement="top">Phone</label>
                                <div class="input-group input-group-outline mb-1">
                                    <input id="phone" type="text" name="phone" class="form-control" value="{{ $phone }}" data-toggle="tooltip" data-placement="top">
                                    <input id="phone_id" type="text" name="phone_id" class="form-control" value="{{ $phone_id }}">
                                    <input id="phone_type_id" type="text" name="phone_type_id" class="form-control" value="{{ $phone_type_id }}">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <!-- Social Media -->
                                <label for="" class="form-label fw-bold" data-toggle="tooltip" data-placement="top">Social Media</label>
                                <div class="input-group input-group-outline mb-1">
                                    <input id="social_media" type="text" name="social_media" class="form-control" value="{{ $social_media }}" data-toggle="tooltip" data-placement="top">
                                    <input id="social_media_id" type="text" name="social_media_id" class="form-control" value="{{ $social_media_id }}">
                                    <input id="social_media_type_id" type="text" name="social_media_type_id" class="form-control" value="{{ $social_media_type_id }}">
                                </div>
                            </div>
                        </div>


                        </div>

                        <div class="row mt-4 my-0 pb-3 col-sm-12">
                          <div class="col-sm-12 d-flex justify-content-center">
                            <button type="button" class="shadow-dark submitbtn" id="saveContact" style="width: 130px">Update</button>
                          </div>
                        </div>
                      </form>
                  </div>
              </div>

              <script>
                // $(document).ready(function() {
                //   $('#saveContact').on('click', function() {
                //       const email = $('#email').val();

                //       if (!email) {
                //           alert('Email is required.');
                //           return;
                //       }

                //       const formData = {
                //           email: email,
                //           email_id: $('#email_id').val(),
                //           email_type_id: $('#email_type_id').val(),
                //           fax: $('#fax').val(),
                //           fax_id: $('#fax_id').val(),
                //           fax_type_id: $('#fax_type_id').val(),
                //           instant_messaging: $('#instant_messaging').val(),
                //           instant_messaging_id: $('#instant_messaging_id').val(),
                //           instant_messaging_type_id: $('#instant_messaging_type_id').val(),
                //           mobile_number: $('#mobile_number').val(),
                //           mobile_number_id: $('#mobile_number_id').val(),
                //           mobile_number_type_id: $('#mobile_number_type_id').val(),
                //           phone: $('#phone').val(),
                //           phone_id: $('#phone_id').val(),
                //           phone_type_id: $('#phone_type_id').val(),
                //           social_media: $('#social_media').val(),
                //           social_media_id: $('#social_media_id').val(),
                //           social_media_type_id: $('#social_media_type_id').val()
                //       };
                //       console.log(formData);
                //       $('#saveContact').prop('disabled', true);

                //       $.ajax({
                //           url: 'user_profile/update_contact.php',
                //           type: 'POST',
                //           data: formData,
                //           success: function(response) {
                //               const result = JSON.parse(response);
                //               alert(result.message);
                //               if (result.success) {
                //                   location.reload();
                //               }
                //           },
                //           error: function(xhr, status, error) {
                //               console.error('AJAX error:', error);
                //               alert('An error occurred. Please try again.');
                //           },
                //           complete: function() {
                //               $('#saveContact').prop('disabled', false);
                //           }
                //       });
                //   });
              });


              </script>
              <!-- CONTACT DETAILS END -->

              <!-- PROFILE PIC -->
              <div class="col-sm-12 col-md-8  my-3 section" id="profile_picture" style="display: none;">
                <div class="card card-small mb-2 py-2">
                  <div class="card-header border-bottom text-left pt-1" style="background-color: #0071BD; padding-bottom: 0px">
                    <p style="color: white; font-size: 18px; font-weight: 400" class="mt-2" >Profile Picture</p>
                  </div>
                  <div class=" ">
                      <div class="row" style="margin-left: 20px; margin-right: 20px; width:90% flex">
                        <div class="col-md-12 col-sm-12"  >
                          <div style="text-align:center;">
                          </div>

                          <div class="grid">
                            <div class="form-element text-center mb-3 mt-3">
                                <img src="../lrmis/profile_picture/default-icon.jpg" class="profilepic_update" alt="">
                            </div>
                        </div>
                        <div class="text-center mt-1 my-1 mb-4">
                          <a class="shadow-dark fw-bold cancelbtn me-2 mb-4" data-bs-toggle="modal" data-bs-target="#logoModal" style="text-decoration: none;">Choose Image</a>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>

              <!-- MODAL -->
              <div class="modal fade" id="logoModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-text="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header" style="background-color: #e91e63">
                      <h5 class="modal-title" id="staticBackdropLabel" style="color:#fff; font-weight:600">Update Profile Picture</h5>
                      <button type="button" class="btn-close" style="border-radius: 50px; margin-top:0px; background-color: #b6003d;" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form class="form" method="post" enctype="multipart/form-data" id="image-upload-form">
                        <div class="grid">
                          <div class="form-element img-thumbnail">
                            <input type="file" id="logo-1" name="file" accept="image/*">
                            <label for="logo-1" id="logo-1-preview">
                              <img class="img-fluid" src="https://bit.ly/3ubuq5o" alt="logo" style="max-width:200px; max-height:200px;">
                              <div>
                                <span class="bi bi-upload" style="width:20%; height: 20%;"> Choose Image</span>
                              </div>
                            </label>
                          </div>
                        </div>
                        <br>
                        <div class="container" style="text-align: center">
                          <input type="text" name="sessionIdImg" value="<?php  ?>">
                          <input type="submit" class="shadow-dark submitbtn" name="submit" value="Upload Image">
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
               <!-- MODAL END -->
               <script>
                $(document).ready(function() {
                    const validImageTypes = ['image/jpeg', 'image/png'];

                    function prevLogo(id) {
                        $("#" + id).on("change", function(e) {
                            if (e.target.files.length == 0) return;

                            const file = e.target.files[0];

                            if (!validImageTypes.includes(file.type)) {
                                alert("Invalid file type. Only JPG, JPEG, and PNG files are allowed.");
                                $(this).val('');
                                return;
                            }

                            const reader = new FileReader();
                            reader.onload = function(e) {
                                const img = new Image();
                                img.src = e.target.result;

                                img.onload = function() {
                                    const canvas = document.createElement('canvas');
                                    const ctx = canvas.getContext('2d');

                                    const maxWidth = 300;
                                    const maxHeight = 800;
                                    let width = img.width;
                                    let height = img.height;

                                    if (width > height) {
                                        if (width > maxWidth) {
                                            height *= maxWidth / width;
                                            width = maxWidth;
                                        }
                                    } else {
                                        if (height > maxHeight) {
                                            width *= maxHeight / height;
                                            height = maxHeight;
                                        }
                                    }

                                    canvas.width = width;
                                    canvas.height = height;
                                    ctx.drawImage(img, 0, 0, width, height);

                                    let quality = 0.9;
                                    let compressedDataUrl;
                                    let fileSize;

                                    do {
                                        compressedDataUrl = canvas.toDataURL('image/jpeg', quality);
                                        fileSize = dataURLToFileSize(compressedDataUrl);
                                        quality -= 0.05;
                                    } while (fileSize > 40 * 1024 && quality > 0);

                                    $("#" + id + "-preview img").attr("src", compressedDataUrl);
                                    $("#" + id + "-preview div").text(file.name);
                                };
                            };
                            reader.readAsDataURL(file);
                        });
                    }

                    function dataURLToFileSize(dataURL) {
                        const head = 'data:image/jpeg;base64,';
                        return Math.round((dataURL.length - head.length) * 3 / 4);
                    }

                    function dataURLToBlob(dataURL) {
                        const binary = atob(dataURL.split(',')[1]);
                        const array = [];
                        for (let i = 0; i < binary.length; i++) {
                            array.push(binary.charCodeAt(i));
                        }
                        return new Blob([new Uint8Array(array)], { type: 'image/jpeg' });
                    }

                    prevLogo("logo-1");

                    $('#image-upload-form').on('submit', function(e) {
                        e.preventDefault();

                        const fileInput = $("#logo-1")[0];
                        const file = fileInput.files[0];

                        if (!file) {
                            alert("Please select an image before uploading.");
                            return;
                        }

                        const compressedDataUrl = $("#logo-1-preview img").attr("src");
                        const compressedFileSize = dataURLToFileSize(compressedDataUrl) / 1024;

                        alert('New Compressed File Size: ' + compressedFileSize.toFixed(2) + ' KB');

                        const formData = new FormData(this);
                        const blob = dataURLToBlob(compressedDataUrl);
                        formData.set('file', blob, file.name);

                        $.ajax({
                            // url: '',
                            // type: 'POST',
                            // data: formData,
                            // contentType: false,
                            // processData: false,
                            // success: function(response) {
                            //     alert(response.message);
                            //     console.log(response);
                            // },
                            // error: function(xhr, status, error) {
                            //     alert('An error occurred while uploading the image.');
                            //     console.log(xhr, status, error);
                            // }
                        });
                    });
                });
              </script>

              <!-- PROFILE PIC END -->

              <!-- PASSWORD -->
              <div class="col-sm-8 col-md-12 col-lg-8 mt-2 mb-3 section" id="user_password" style="display: none;">
                <div class="card card-small mb-2">
                  <div class="card-header border-bottom text-left pt-1" style="background-color: #0071BD; padding-bottom: 0px">
                    <p style="color: white; font-size: 18px; font-weight: 400" class="mt-2" >Change Password</p>
                  </div>
                  <div class="mx-4">
                    <form id="passwordForm">
                      <div class="row mt-3 mb-3 d-flex justify-content-center">
                        <div class="col-sm-12 col-md-8">
                          <!-- Current Password -->
                          <label for="" class="form-label required ">Current Password</label>
                          <div class=" input-group input-group-outline  mb-1">
                            <div class="login_input py-0">
                              <input type="password"  class=" form-control "
                              value="" required
                              id="password" placeholder=" " name="password" value="" spellcheck="false" placeholder=" " style="z-index:2;" >
                              <span class="invalid-feedback"></span>
                              <i class="ri-eye-off-line login_eye  px-2  " style="top:10%" id="loginEye" ></i>
                            </div>
                          </div>
                        </div>

                        <div class="col-sm-12 col-md-8 ">
                          <!-- New Password -->
                          <label for="" class="form-label required">New Password</label>
                          <div class=" input-group input-group-outline  mb-1">
                            <div class="login_input py-0">
                              <input type="password" name="new_password" class=" form-control"
                              value=""  required
                              id="nP" placeholder=" "  value="" spellcheck="false" placeholder=" " style="z-index:2;" >
                              <span class="invalid-feedback"></span>
                              <i class="ri-eye-off-line login_eye px-2 " style="top:10%" id="loginEye3" ></i>
                            </div>
                          </div>
                        </div>

                        <div class="col-sm-12 col-md-8">
                          <!-- Retype New Password -->
                          <label for="" class="form-label required">Confirm Password</label>
                          <div class=" input-group input-group-outline  ">
                            <div class="login_input py-0">
                              <input type="password" name="confirm_password" class="form-control"
                              value=""  required
                              id="cP" placeholder=" "  placeholder=" " style="z-index:2;"  >
                              <span class="invalid-feedback"></span>
                              <i class="ri-eye-off-line login_eye  px-2"  style="top:10%" id="loginEye2" ></i>
                            </div>
                          </div>
                        </div>

                        <div class="row d-flex justify-content-center mt-4">
                          <button type="button" class="shadow-dark me-3 cancelbtn" id="resetButton" style="width: 130px">Reset</button>
                          <button type="button" class="shadow-dark submitbtn" id="savePassword" style="width: 130px">Save</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- PASSWORD VISIBILITY -->
              <script>
                function togglePasswordVisibility(passwordId, eyeIconId) {
                  $(`#${eyeIconId}`).on('click', function () {
                    const input = $(`#${passwordId}`);
                    if (input.attr('type') === 'password') {
                      input.attr('type', 'text');
                      $(this).addClass('ri-eye-line').removeClass('ri-eye-off-line');
                    } else {
                      input.attr('type', 'password');
                      $(this).removeClass('ri-eye-line').addClass('ri-eye-off-line');
                    }
                  });
                }
                togglePasswordVisibility('password', 'loginEye');
                togglePasswordVisibility('nP', 'loginEye3');
                togglePasswordVisibility('cP', 'loginEye2');

                $('#resetButton').on('click', function() {
                  $('#passwordForm')[0].reset();
                  $('#password, #nP, #cP').attr('type', 'password');
                  $('#loginEye, #loginEye3, #loginEye2').removeClass('ri-eye-line').addClass('ri-eye-off-line');
                  $('span.invalid-feedback').text(''); // Clear error messages
                });

                $('#savePassword').on('click', function(e) {
                  e.preventDefault();

                  $('span.invalid-feedback').text('');

                  let isValid = true;
                  const currentPassword = $('#password').val().trim();
                  const newPassword = $('#nP').val().trim();
                  const confirmPassword = $('#cP').val().trim();

                  if (currentPassword.length < 6) {
                    $('#password').siblings('.invalid-feedback').text('Current password is too short.');
                    isValid = false;
                  }
                  if (newPassword.length < 6) {
                    $('#nP').siblings('.invalid-feedback').text('New password must be at least 6 characters.');
                    isValid = false;
                  }
                  if (newPassword !== confirmPassword) {
                    $('#cP').siblings('.invalid-feedback').text('Passwords do not match.');
                    isValid = false;
                  }

                  if (isValid) {
                    const formData = {
                      current_password: currentPassword,
                      new_password: newPassword,
                      confirm_password: confirmPassword
                    };

                    $('#savePassword').prop('disabled', true);

                    $.ajax({
                      url: 'user_profile/change_pass.php',
                      type: 'POST',
                      data: formData,
                      success: function(response) {
                        const result = JSON.parse(response);
                        alert(result.message);
                        if (result.success) {
                          window.location.href = 'restructure/login/logout.php';
                        }
                      },
                      error: function(xhr, status, error) {
                        console.error('AJAX error:', error);
                        alert('An error occurred. Please try again.');
                      },
                      complete: function() {
                        $('#savePassword').prop('disabled', false);
                      }
                    });
                  }
                });

              </script>
              <!-- PASSWORD END -->

          </div>
      </div>
    </div>

    <script>
        function showSection(sectionId) {
          $('.section').hide();
          $('#' + sectionId).show();
          $('.accordion-header button').removeClass('active1').find('a').css('color', '#344767');
          $('a[href="#' + sectionId + '"]').closest('button').addClass('active1').find('a').css('color', 'white');
          localStorage.setItem('activeSection', sectionId);
        }
        $(document).ready(function() {
          var activeSection = localStorage.getItem('activeSection');
          if (activeSection) {
            showSection(activeSection);
          } else {
            showSection('personal_information');
          }
        });
      </script>


  <style>
    @media only screen and (max-width: 600px){
      .scroll-bar{
        border-radius: 20px;
        width: 280px;
        height: 100%;
        overflow-x: scroll;
      }
    }
  </style>
<style>
    #customers {
      font-family: Arial, Helvetica, sans-serif;
      border-collapse: collapse;
      width: 90%;
    }

    #customers td, #customers th {
      border: 1px solid #ddd;
      padding: 8px;
    }

    #customers tr:nth-child(even){background-color: #f2f2f2;}

    #customers tr:hover {background-color: #ddd;}

    #customers th {
      padding-top: 12px;
      padding-bottom: 12px;
      text-align: left;
      background-color: #04AA6D;
      color: white;
    }

  </style>

  <style>
    .form-label{
        font-weight: 500;
    }

    .active1, .btn1:hover {
        background-color: #0071BD;
        color: white;


    }
  </style>

      <style>
          .account-settings .user-profile {
              margin: 0 0 1rem 0;
              padding-bottom: 1rem;
              text-align: center;
          }
          .account-settings .user-profile .user-avatar {
              margin: 0 0 1rem 0;
          }
          .account-settings .user-profile .user-avatar img {
              width: 90px;
              height: 90px;
              -webkit-border-radius: 100px;
              -moz-border-radius: 100px;
              border-radius: 100px;
          }
          .account-settings .user-profile h5.user-name {
              margin: 0 0 0.5rem 0;
          }
          .account-settings .user-profile h6.user-email {
              margin: 0;
              font-size: 0.8rem;
              font-weight: 400;
              color: #9fa8b9;
          }
          .account-settings .about {
              margin: 2rem 0 0 0;
              text-align: center;
          }
          .account-settings .about h5 {
              margin: 0 0 15px 0;
              color: #007ae1;
          }
          .account-settings .about p {
              font-size: 0.825rem;
          }
          .form-control {
              border: 1px solid #cfd1d8;
              -webkit-border-radius: 2px;
              -moz-border-radius: 2px;
              border-radius: 2px;
              font-size: .825rem;
              background: #ffffff;
              color: #2e323c;
          }

          .card {
              background: #ffffff;
              -webkit-border-radius: 5px;
              -moz-border-radius: 5px;
              border-radius: 5px;
              border: 0;
              margin-bottom: 1rem;
          }
      </style>
  @endsection
