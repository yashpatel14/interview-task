<!DOCTYPE html>
<html>

<head>
    <title>User Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <h3 class="text-center mb-4">User Login</h3>



                <form method="POST" action="{{ route('front.login.process') }}">
                    @csrf
                    <div class="mb-3">
                        <label>Email:</label>
                        <input type="email" name="email" class="form-control" required placeholder="Enter email">
                    </div>
                    <div class="mb-3">
                        <label>Password:</label>
                        <input type="password" name="password" class="form-control" required
                            placeholder="Enter password">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>

                <p class="text-center text-muted mt-3" style="font-size: 14px;">
                    Use <strong>user@example.com</strong> / <strong>user@123</strong>
                </p>
            </div>
        </div>
    </div>
</body>

</html>
