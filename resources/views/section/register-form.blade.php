<form id="registrationForm">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <label for="authority">Account Type<span class="text-danger">*</span></label>
                <div class="input-group input-group-outline mb-1">
                    <select class="form-control" name="authority" id="authority">
                        <option selected disabled>Select Account Type</option>
                    </select>
                    <small class="text-danger" id="authority-error"></small>
                </div>
            </div>
            <div class="col-md-6">
                <label for="usertype">User Type<span class="text-danger">*</span></label>
                <div class="input-group input-group-outline mb-1">
                    <select class="form-control" name="usertype" id="usertype">
                        <option selected disabled>Select User Type</option>
                    </select>
                    <small class="text-danger" id="usertype-error"></small>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="region">Region<span class="text-danger">*</span></label>
                <div class="input-group input-group-outline mb-1">
                    <select id="region" name="region" class="form-control">
                        <option selected disabled>Select Region</option>
                    </select>
                    <small class="text-danger" id="region-error"></small>
                </div>
            </div>

            <div class="col-md-6">
                <label for="division">Division<span class="text-danger">*</span></label>
                <div class="input-group input-group-outline mb-1">
                    <select id="division" name="division" class="form-control">
                        <option selected disabled>Select Division</option>
                    </select>
                    <small class="text-danger" id="division-error"></small>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="district">District<span class="text-danger">*</span></label>
                <div class="input-group input-group-outline mb-1">
                    <select id="district" name="district" class="form-control">
                        <option selected disabled>Select District</option>
                    </select>
                    <small class="text-danger" id="district-error"></small>
                </div>
            </div>
            <div class="col-md-6">
                <label for="school">School<span class="text-danger">*</span></label>
                <div class="input-group input-group-outline mb-1">
                    <select id="school" name="school" class="form-control">
                        <option selected disabled>Select School</option>
                    </select>
                    <small class="text-danger" id="school-error"></small>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-md-4">
                <label for="firstname">First Name<span class="text-danger">*</span></label>
                <div class="input-group input-group-outline mb-1">
                    <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name"
                        required>
                    <small class="text-danger" id="firstname-error"></small>
                </div>
            </div>
            <div class="col-md-4">
                <label for="lastname">Last Name<span class="text-danger">*</span></label>
                <div class="input-group input-group-outline mb-1">
                    <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name"
                        required>
                    <small class="text-danger" id="lastname-error"></small>
                </div>
            </div>
            <div class="col-md-4">
                <label for="username">Username<span class="text-danger">*</span></label>
                <div class="input-group input-group-outline mb-1">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username"
                        required>
                    <small class="text-danger" id="username-error"></small>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            @foreach ($contactTypes as $index => $type)
                <div class="col-md-4 mb-3">
                    <label for="contact|{{ $type->id }}">
                        {{ $type->name }}
                        @if ($type->name === 'Email')
                            <span class="text-danger">*</span>
                        @endif:
                    </label>
                    <div class="input-group input-group-outline mb-1">
                        <input type="hidden" name="contact_type_id[]" value="{{ $type->id }}">
                        <input type="text" class="form-control" id="contact|{{ $type->id }}"
                            name="contact_details|{{ $type->id }}" placeholder="Enter {{ $type->name }}"
                            @if ($type->name === 'Email') required @endif>
                        @error('contact_details.' . $type->id)
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                @if (($index + 1) % 3 == 0 && $index + 1 != $contactTypes->count())
        </div>
        <div class="row">
            @endif
            @endforeach
        </div>
        <div class="row mt-2">

            <div class="col-md-4">
                <label for="password">Password<span class="text-danger">*</span></label>
                <div class="input-group input-group-outline mb-1">
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Password" style="z-index: 2;">
                    <i class="ri-eye-off-line login_eye  px-2  " style="top:10%" id="loginEye"></i>
                    <small class="text-danger" id="password-error"></small>
                </div>
            </div>
            <div class="col-md-4">
                <label for="confirm_password">Confirm Password<span class="text-danger">*</span></label>
                <div class="input-group input-group-outline mb-1">
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                        placeholder="Confirm Password" style="z-index: 2;" required>
                    <i class="ri-eye-off-line login_eye  px-2" style="top:10%" id="loginEye2"></i>
                    <small class="text-danger" id="confirm-password-error"></small>
                </div>
            </div>
            <div class="col-md-4">
                <label for="tin_number">TIN Number<span class="text-danger">*</span></label>
                <div class="input-group input-group-outline mb-1">
                    <input type="number" class="form-control" id="tin_number" name="tin_number"
                        placeholder="TIN Number" min="0" required>
                    <small class="text-danger" id="tin-error"></small>
                </div>
            </div>
        </div>

        <div class="row mt-2">

        </div>

        <div class="row mt-3 pb-2">
            <div class="col-sm-12 d-flex justify-content-center ">
                <button type="submit" class="btn btn-primary shadow-dark me-1 submitbtn mx-4"
                    style="width: 130px">Submit</button>
                <a href="" type="button" id="" class="btn btn-primary  shadow-dark cancelbtn mx-4"
                    style="width: 130px" value="Reset" onclick="reset()">Reset<a>
            </div>
            <p style="color:#000000;font-family:Arial;font-size:13px;" class="text-center"> Already have an account?
                <a href="{{ url('/api/index') }}" class="signuplink">Login Here.</a> </span>
        </div>
    </div>
</form>
<script>
    $(document).ready(function() {
        $.ajax({
            url: '/api/authorities',
            method: 'GET',
            success: function(data) {
                data.forEach(function(authority) {
                    $('#authority').append(
                        `<option value="${authority.id}|${authority.authority_level}">${authority.name}</option>`
                    );
                });
            }
        });

        $('#authority').change(function() {
            const authorityValue = $(this).val();
            const authorityId = authorityValue ? authorityValue.split('|')[0] :
                null; // Extract the ID before the '|'

            // Clear and reset other dropdowns
            $('#usertype').empty().append('<option selected disabled>Select User Type</option>');
            $('#region').empty().append('<option selected disabled>Select Region</option>');
            $('#division').empty().append('<option selected disabled>Select Division</option>');
            $('#district').empty().append('<option selected disabled>Select District</option>');
            $('#school').empty().append('<option selected disabled>Select School</option>');

            // Fetch user types if a valid authority ID is selected
            if (authorityId) {
                $.ajax({
                    url: '/api/user-types',
                    method: 'GET',
                    data: {
                        authority_id: authorityId // Pass only the extracted ID
                    },
                    success: function(data) {
                        let options = '';
                        data.forEach(function(usertype) {
                            options +=
                                `<option value="${usertype.id}">${usertype.name}</option>`;
                        });
                        $('#usertype').append(options);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching user types:", error);
                        alert(
                            "An error occurred while fetching user types. Please try again."
                        );
                    }
                });
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        function fetchRegions() {
            $.ajax({
                url: '/api/regions',
                type: 'GET',
                dataType: 'json',
                success: function(regions) {
                    $('#region').html('<option selected disabled>Select Region</option>');

                    $.each(regions, function(index, region) {
                        $('#region').append('<option value="' + region.id + '">' + region
                            .station_name + '</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching regions: " + error);
                }
            });
        }

        fetchRegions();

        $('#authority').on('change', function() {
            fetchRegions();
        });
    });
</script>

<script>
    $(document).ready(function() {
        const fields = ['#region', '#division', '#district', '#school'];
        fields.forEach(field => $(field).closest('.col-md-6').hide());

        $('#authority').change(function() {
            const authorityValue = $(this).val();
            const userLevel = authorityValue ? authorityValue.split('|')[1] : null;

            fields.forEach(field => $(field).closest('.col-md-6').hide());

            switch (userLevel) {
                case "1":
                    break;
                case "2":
                    $('#region').closest('.col-md-6').show();
                    break;
                case "3":
                    $('#region, #division').closest('.col-md-6').show();
                    break;
                case "4":
                    $('#region, #division, #district').closest('.col-md-6').show();
                    break;
                case "5":
                    $('#region, #division, #district, #school').closest('.col-md-6').show();
                    break;
                default:
                    console.warn('Unknown user level:', userLevel);
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#region').change(function() {
            var region_id = $(this).val();
            $('#division').html('<option value="" disabled selected>Select Division</option>');
            $('#district').html('<option value="" disabled selected>Select District</option>');
            $('#school').html('<option value="" disabled selected>Select School</option>');
            if (region_id !== "") {
                $.ajax({
                    url: '/api/divisions',
                    type: 'GET',
                    data: {
                        region_id: region_id
                    },
                    success: function(divisions) {
                        if (divisions.length > 0) {
                            // $('#division').prop('disabled', false);
                            $.each(divisions, function(index, division) {
                                $('#division').append('<option value="' + division
                                    .id +
                                    '">' + division.station_name +
                                    '</option>');
                            });
                        }
                    }
                });
            }
        });
        $('#division').change(function() {
            var division_id = $(this).val();
            $('#district').html('<option value="" disabled selected>Select District</option>');
            $('#school').html('<option value="" disabled selected>Select School</option>');
            if (division_id !== "") {
                $.ajax({
                    url: '/api/districts',
                    type: 'GET',
                    data: {
                        division_id: division_id
                    },
                    success: function(districts) {
                        if (districts.length > 0) {
                            // $('#district').prop('disabled', false);
                            $.each(districts, function(index, district) {
                                $('#district').append('<option value="' + district
                                    .id +
                                    '">' + district.station_name +
                                    '</option>');
                            });
                        }
                    }
                });
            }
        });
        $('#district').change(function() {
            var district_id = $(this).val();
            $('#school').html('<option value="" disabled selected>Select School</option>');
            if (district_id !== "") {
                $.ajax({
                    url: '/api/schools',
                    type: 'GET',
                    data: {
                        district_id: district_id
                    },
                    success: function(schools) {
                        if (schools.length > 0) {
                            // $('#school').prop('disabled', false);
                            $.each(schools, function(index, school) {
                                $('#school').append('<option value="' + school.id +
                                    '">' + school.station_name +
                                    '</option>');
                            });
                        }
                    }
                });
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#registrationForm').on('submit', function(e) {
            e.preventDefault();
            $('small.text-danger').text(''); // Clear previous errors

            var isValid = true;
            var contactDetails = {};
            $('input[name^="contact_details"]').each(function() {
                var inputId = $(this).attr('id');
                var contactTypeId = inputId.split('|')[1];
                var contactValue = $(this).val().trim();
                if (contactValue) {
                    contactDetails[contactTypeId] = contactValue;
                }
            });

            if (isValid) {
                var formData = $(this).serializeArray();
                formData.push({
                    name: 'contactDetails',
                    value: JSON.stringify(contactDetails)
                });

                $.ajax({
                    url: '/pages/register',
                    type: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert(response.message);
                    },
                    error: function(xhr, status, error) {
                        if (xhr.status === 422) { // Validation error
                            // Collect all validation error messages
                            const errors = xhr.responseJSON.errors;
                            let errorMessage = '';
                            for (let field in errors) {
                                errorMessage += errors[field].join(', ') +
                                    '\n'; // Display all validation messages for each field
                            }
                            alert(errorMessage); // Show all validation errors
                        } else {
                            console.error('AJAX error:', error);
                            alert(
                                'An error occurred during registration. Please try again later.'
                            );
                        }
                    }
                });
            }
        });
    });
</script>
