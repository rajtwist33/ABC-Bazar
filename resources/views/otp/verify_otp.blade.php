<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ $setting != '' ? asset($setting->file_path) : '' }}" type="image/gif" />
    <link rel="stylesheet" href="{{ asset('backend/assets/css/styles.min.css') }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>

<body>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div
            class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="{{ url('/') }}"
                                    class="text-nowrap logo-img text-center d-block py-3 w-100">
                                    <img src=" {{ $setting != '' ? asset($setting->file_path) : '' }}" class="img-fluid"
                                        width="100" alt="" />
                                </a>

                                <form>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Phone Number: <code>use (+977
                                                Before Number )</code></label>
                                        <input type="text" class="form-control" name="phone" id="number"
                                            placeholder="+977 ********">
                                        <div id="recaptcha-container"></div>
                                    </div>
                                    <button type="button" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2"
                                        onclick="sendOTP()">Send
                                        OTP
                                    </button>

                                </form>

                                <div class="mb-5 mt-5">
                                    <h3>Add verification code</h3>
                                    <div class="alert alert-success" id="successOtpAuth" style="display: none;"></div>
                                    <form>
                                        <input type="text" name="verification" id="verification" class="form-control"
                                            placeholder="Verification code">
                                        <button type="button" class="btn btn-danger mt-3" onclick="verify()">Verify
                                            code</button>
                                    </form>
                                </div>
                                <div class="d-flex align-items-center justify-content-center">
                                    <p class="fs-4 mb-0 fw-bold">Already have an Account?</p>
                                    <a class="text-primary fw-bold ms-2" href="{{ route('login') }}">Sign
                                        In</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        var firebaseConfig = {
            apiKey: "AIzaSyCtlfh56N5G3h6xlhhdM1AmiszE162bR2Q",
            authDomain: "otp-verification-2a27b.firebaseapp.com",
            projectId: "otp-verification-2a27b",
            storageBucket: "otp-verification-2a27b.appspot.com",
            messagingSenderId: "229490937364",
            appId: "1:229490937364:web:5b351e576a14ec3a5b2101",
            measurementId: "G-K0BBWD13M7"
        };
        firebase.initializeApp(firebaseConfig);
    </script>
    <script type="text/javascript">
        window.onload = function() {
            render();
        };

        function render() {
            window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
            recaptchaVerifier.render();
        }

        function sendOTP() {
            var number = $("#number").val();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: "{{ route('phone_otp_store') }}",
                method: 'POST',
                headers: {
                    'X-CSRF-Token': csrfToken
                },
                data: {
                    phone: $("#number").val(),
                },
                success: function(response) {
                    var status = response.status;
                    var message = response.message;
                    if (status === "not_active") {
                        firebase.auth().signInWithPhoneNumber(number, window.recaptchaVerifier).then(function(
                            confirmationResult) {
                            window.confirmationResult = confirmationResult;
                            coderesult = confirmationResult;
                            console.log(coderesult);
                            toastr.success('Token has Send to Youp Phone.');
                        }).catch(function(error) {
                            $("#error").text(error.message);
                            $("#error").show();
                        });

                    } else if (status === "active") {
                        toastr.error(message);
                    }

                },
                error: function(error) {
                    console.error('Error storing data:', error);
                }
            });

        }

        function verify() {
            var code = $("#verification").val();
            var phone = $("#number").val();
            coderesult.confirm(code).then(function(result) {
                var user = result.user;
                console.log(user);
                $("#successOtpAuth").text("Auth is successful");
                $("#successOtpAuth").show();
                setTimeout(() => {
                    window.location.href = '/register/'+ phone;
                }, 3000);

            }).catch(function(error) {
                $("#error").text(error.message);
                $("#error").show();
            });
        }
    </script>
</body>

</html>
