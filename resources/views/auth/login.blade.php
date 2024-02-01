<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login - SB Admin</title>
    <link href="{{ asset('../assets/css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="bg-success">
    <div id="layoutAuthentication" class="py-5">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <!-- Outer Row -->
                    <div class="row justify-content-center">
                        <div class="col-xl-10 col-lg-12 col-md-9">
                            <div class="card o-hidden border-0 shadow-lg my-5">
                                <div class="card-body p-0">
                                    <!-- Nested Row within Card Body -->
                                    <div class="row">
                                        <div class="col-lg-6 d-flex"
                                            style="background: url('{{ asset('../assets/img/logo-app-surfboard.png') }}') no-repeat center center;">
                                            <!-- This div will have the background image and will stretch to cover the half of the row -->
                                        </div>


                                        <div class="col-lg-6">
                                            <div class="p-5">
                                                <div class="text-center">
                                                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                                </div>
                                                @if ($errors->any())
                                                    <script>
                                                        document.addEventListener('DOMContentLoaded', function() {
                                                            Swal.fire({
                                                                icon: 'error',
                                                                title: 'Oops...',
                                                                text: '{{ $errors->first() }}',
                                                                toast: true,
                                                                position: 'top-end',
                                                                showConfirmButton: false,
                                                                timer: 5000,
                                                                timerProgressBar: true,
                                                            });
                                                        });
                                                    </script>
                                                @endif
                                                <form class="user" method="POST" action="/login">
                                                    @csrf
                                                    <div class="form-group mb-3">
                                                        <input type="email" class="form-control form-control-user"
                                                            id="inputEmail" aria-describedby="emailHelp"
                                                            placeholder="Enter Email Address..." name="email">
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <input type="password" class="form-control form-control-user"
                                                            id="inputPassword" placeholder="Password" name="password">
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <div class="custom-control custom-checkbox small">
                                                            <input type="checkbox" class="custom-control-input"
                                                                id="customCheck">
                                                            <label class="custom-control-label"
                                                                for="customCheck">Remember Me</label>
                                                        </div>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                                        Login
                                                    </button>
                                                </form>
                                                <hr>
                                                <div class="text-center">
                                                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('../assets/js/scripts.js') }}"></script>
</body>

</html>
