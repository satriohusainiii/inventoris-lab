<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Inventaris Lab</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background: linear-gradient(135deg,#0d6efd,#6f42c1);
            height:100vh;
        }

        .card{
            border:none;
            border-radius:15px;
            box-shadow:0 10px 30px rgba(0,0,0,.2);
        }

        .login-title{
            font-weight:bold;
            color:#0d6efd;
        }

        .btn-login{
            border-radius:30px;
        }
    </style>
</head>
<body>

<div class="container h-100">
    <div class="row justify-content-center align-items-center h-100">

        <div class="col-md-4">

            <div class="card">

                <div class="card-body p-4">

                    <h3 class="text-center login-title mb-4">
                        LOGIN INVENTARIS LAB
                    </h3>

                    <form action="proses_login.php" method="POST">

                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input
                                type="text"
                                name="username"
                                class="form-control"
                                placeholder="Masukkan Username"
                                required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                placeholder="Masukkan Password"
                                required>
                        </div>

                        <div class="d-grid">
                            <button class="btn btn-primary btn-login">
                                Login
                            </button>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>
</div>

</body>
</html>