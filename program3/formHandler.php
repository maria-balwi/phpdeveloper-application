<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap 5 CSS -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

        <!-- SWEET ALERT 2 -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.3/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.3/dist/sweetalert2.all.min.js"></script>

        <!-- INPUT MASK -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7/jquery.inputmask.min.js"></script>

        <title>AJAX Form</title>
    </head>
    <body>
        <div class="container mt-5">
            <h2>Simple Form</h2>
            <form id="simpleForm">
                <div class="mb-3">
                    <label for="fullName" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="fullName" name="fullName" required>
                </div>

                <div class="mb-3">
                    <label for="emailAddress" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="emailAddress" name="emailAddress" required>
                </div>

                <div class="mb-3">
                    <label for="mobileNumber" class="form-label">Mobile Number</label>
                    <input type="number" class="form-control" id="mobileNumber" placeholder="09XX-XXX-XXXX" name="mobileNumber" maxlength="11" required>
                </div>

                <div class="mb-3">
                    <label for="dateOfBirth" class="form-label">Date of Birth</label>
                    <input type="date" class="form-control" id="dateOfBirth" name="dateOfBirth" required>
                </div>

                <div class="mb-3">
                    <label for="age" class="form-label">Age</label>
                    <input type="text" class="form-control" id="age" name="age" readonly>
                </div>

                <div class="mb-3">
                    <label for="gender" class="form-label">Gender</label>
                    <select class="form-select" id="gender" name="gender" required>
                        <option value="" disabled selected>Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

        <script>
            // jQuery for form validation and date computation
            $(document).ready(function() {

                // Validate mobile number format
                $('#mobileNumber').on('input', function() {
                    var mobile = $(this).val();
                    if (!/^09\d{9}$/.test(mobile)) {
                        $(this).addClass('is-invalid');
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                });

                // Compute age based on date of birth
                $('#dateOfBirth').on('change', function() {
                    var dob = new Date($(this).val());
                    var today = new Date();
                    var age = today.getFullYear() - dob.getFullYear();
                    var monthDiff = today.getMonth() - dob.getMonth();
                    if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
                    age--;
                    }
                    $('#age').val(age);
                });

                // Form submission
                $('#simpleForm').on('submit', function(e) {
                    e.preventDefault();
                    
                    let addData = new FormData(this);
                    let fullName = $('#fullName').val();
                    let emailAddress = $('#emailAddress').val();
                    let mobileNumber = $('#mobileNumber').val();
                    let dateOfBirth = $('#dateOfBirth').val();
                    let age = $('#age').val();
                    let gender = $('#gender').val();
                    
                    if (fullName === '' || emailAddress === '' || mobileNumber === '' || dateOfBirth === '' || age === '' || gender === '') {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Required Informaiton',
                            text: 'Please fill in all required fields'
                        });
                    }
                    else if ($('#mobileNumber').hasClass('is-invalid')) {
                        e.preventDefault();
                        alert("Please enter a valid mobile number."); 
                        return false;
                    }
                    else {
                        Swal.fire({
                            title: 'Submit Confirmation',
                            text: "Are you sure you want to submit this form?",
                            icon: 'question',
                            showCancelButton: true,
                            cancelButtonColor: '#6c757d',
                            confirmButtonColor: '#28a745',
                            confirmButtonText: 'Yes',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    type: "POST",
                                    url: "process.php",
                                    data: addData,
                                    contentType: false,
                                    processData: false,
                                    success: function (res) {
                                        const data = JSON.parse(res);
                                        var message = data.em;
                                        if (data.error == 0) {
                                            var id = data.id;
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Success',
                                                text: message,
                                                timer: 2000,
                                                showConfirmButton: false
                                            }).then(() => {
                                                window.location.reload();
                                            })
                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Error',
                                                text: message
                                            }) 
                                        }
                                    }
                                });
                            }
                        });
                    }
                });
            });
        </script>
    </body>
</html>