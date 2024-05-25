<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta Tag Dasar -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SI Seleksi Atlet - Login</title>

    <!-- Ikon dan Gaya -->
    <link rel="apple-touch-icon" sizes="76x76" href="http://127.0.0.1:8000/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="http://127.0.0.1:8000/assets/img/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href="http://127.0.0.1:8000/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="http://127.0.0.1:8000/assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet">
    <link href="http://127.0.0.1:8000/assets/demo/demo.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <!-- Gaya Khusus untuk Halaman Login -->
    <style>
    body {
        background-color: #e3f2fd;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .login-card {
        width: 100%;
        max-width: 400px;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        background-color: #ffffff;
    }

    .login-card h1 {
        font-family: 'Montserrat', sans-serif;
        color: #1976d2;
        margin-bottom: 1rem;
        text-align: center;
    }

    .login-card label {
        font-weight: bold;
        color: #1565c0;
    }

    .login-card .form-control {
        border-radius: 0.25rem;
    }

    .login-card .btn {
        background-color: #42a5f5;
        border: none;
        color: #ffffff;
        font-weight: bold;
        transition: all 0.3s;
    }

    .login-card .btn:hover {
        background-color: #1e88e5;
        transform: scale(1.05);
    }

    .login-card .alert {
        font-size: 0.875rem;
        margin-top: 1rem;
    }
    </style>
</head>

<body>
    <!-- Menyertakan Alert dari SweetAlert -->
    @include('sweetalert::alert')

    <!-- Kartu Login -->
    <div class="login-card">
        <h1>Login <span class="text-primary">SI</span><span class="text-warning">Seleksi</span><span
                class="text-danger">Atlet</span></h1>

        <!-- Form Login -->
        <!-- Formulir ini menggunakan metode POST dan akan mengirimkan data ke rute yang dinamakan 'auth.login' -->
        <form method="post" action="{{ route('auth.login') }}">

            @csrf
            <!-- Input Username -->
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input required type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                    name="username" placeholder="Enter Your username" autocomplete="off">
                @error('username')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <!-- Input Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input required type="password" class="form-control @error('password') is-invalid @enderror"
                    id="password" name="password" placeholder="Enter Your Password" autocomplete="off">
                @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <!-- Tombol Login -->
            <button type="submit" class="btn btn-primary w-100">Sign In</button>
            <!-- Link ke Halaman Registrasi -->
            <div class="text-center">
                <a href="{{ route('auth.register') }}" class="text-center">Register</a>
            </div>
        </form>
    </div>

    <!-- Skrip JS -->
    <script src="http://127.0.0.1:8000/assets/js/core/jquery.min.js"></script>
    <script src="http://127.0.0.1:8000/assets/js/core/popper.min.js"></script>
    <script src="http://127.0.0.1:8000/assets/js/core/bootstrap.min.js"></script>
    <script src="http://127.0.0.1:8000/assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <script src="http://127.0.0.1:8000/assets/js/paper-dashboard.min.js?v=2.0.1"></script>
    <script src="http://127.0.0.1:8000/assets/demo/demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>