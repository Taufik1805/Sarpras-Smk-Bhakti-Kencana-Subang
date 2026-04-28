<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Sarpras</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<style>
body {
    height: 100vh;
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background: url('<?= base_url('uploads/bg-sekolah.jpg') ?>') no-repeat center center;
    background-size: cover;
}

/* overlay */
.overlay {
    position: absolute;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.55);
}

/* wrapper */
.login-wrapper {
    position: relative;
    z-index: 2;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* box */
.login-box {
    width: 360px;
    text-align: center;
}

/* logo */
.logo {
    width: 90px;
    margin-bottom: 10px;
}

/* title */
.title {
    color: white;
    font-size: 26px;
    font-weight: bold;
}

.subtitle {
    color: #ccc;
    margin-bottom: 25px;
}

/* input */
.form-control {
    border-radius: 12px;
    padding: 12px;
    border: none;
}

/* focus */
.form-control:focus {
    box-shadow: 0 0 5px rgba(0,201,167,0.7);
}

/* password icon */
.password-wrapper {
    position: relative;
}

.password-wrapper i {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    color: #555;
}

/* button */
.btn-login {
    background: #1f2a6c;
    border-radius: 12px;
    padding: 12px;
    color: white;
    font-weight: bold;
    transition: 0.3s;
}

.btn-login:hover {
    background: #16205a;
}

/* lupa */
.lupa {
    color: #ffc107;
    font-size: 14px;
    text-decoration: none;
}

.lupa:hover {
    text-decoration: underline;
}

/* error */
.alert {
    text-align: left;
    font-size: 14px;
}
</style>
</head>

<body>

<div class="overlay"></div>

<div class="login-wrapper">
    <div class="login-box">

        <!-- LOGO -->
        <img src="<?= base_url('uploads/logo.png') ?>" class="logo">

        <div class="title">SMK Kes. Bhakti Kencana Subang</div>
        <div class="subtitle">Sistem Sarana Prasarana</div>

        <!-- ERROR -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <i class="fa fa-exclamation-circle"></i>
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <!-- FORM -->
        <form action="<?= site_url('login/process') ?>" method="post">

            <div class="mb-3">
                <input type="text" name="username" class="form-control" placeholder="Masukkan Email" required>
            </div>

            <div class="mb-3 password-wrapper">
                <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan Password" required>
                <i class="fa fa-eye" onclick="togglePassword()"></i>
            </div>

            <button type="submit" class="btn btn-login w-100">
                Login
            </button>

        </form>

        <div class="mt-3">
            <a href="#" class="lupa">Lupa Password?</a>
        </div>

    </div>
</div>

<!-- SCRIPT -->
<script>
function togglePassword() {
    const pass = document.getElementById("password");
    pass.type = pass.type === "password" ? "text" : "password";
}
</script>

</body>
</html>