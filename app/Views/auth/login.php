<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sispaldeba</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/main/app.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/pages/auth.css') ?>">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo/favicon.svg') ?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/logo/favicon.png') ?>" type="image/png">
</head>

<body>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12 ">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="index.html"><img src="<?php echo base_url('assets/images/logo/logo.svg') ?>" alt="Logo"></a>
                    </div>
                    <center>
                        <h5 class="auth-title">Log in </h5>
                    </center>
                    <!-- Alert pesan error -->
                    <?php if (session()->getFlashdata('error')) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><?= session()->getFlashdata('error'); ?></strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <form class="form-signin" method="post" action="<?= base_url('Auth/login'); ?>" role="form">
                        <?= csrf_field() ?>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl" id="username" name="username" value="" placeholder="Username" required autofocus>
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" id="password" name="password" value="" placeholder="Password" required>
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <div class="form-check form-check-lg d-flex align-items-end">
                            <input class="form-check-input me-2" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label text-gray-600" for="flexCheckDefault">
                                Keep me logged in
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="submit">Log in</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class="text-gray-600">Don't have an account? <a href="<?php echo base_url('Auth/regis') ?>" class="font-bold">Sign
                                up</a>.</p>

                        <p><a class="font-bold" href="<?php echo base_url('Auth/forget_pass') ?>">Forgot password?</a>.</p>
                    </div>
                </div>
            </div>
            <!-- <script type="text/javascript">
                function validasi() {
                    var username = document.getElementById("username").value;
                    var password = document.getElementById("password").value;
                    if (username != "" && password != "") {
                        return true;
                    } else {
                        alert('Username dan Password harus di isi !');
                        return false;
                    }
                }
            </script> -->

            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>

    </div>
</body>

</html>