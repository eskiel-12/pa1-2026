<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            overflow: hidden;
            backdrop-filter: blur(10px);
            background: rgba(255,255,255,0.95);
        }
        .card-header {
            background: linear-gradient(135deg, #c6a43b 0%, #8b7355 100%);
            color: white;
            text-align: center;
            padding: 20px;
            border-bottom: none;
        }
        .card-header h4 {
            margin: 0;
            font-weight: 600;
            font-size: 24px;
        }
        .card-body {
            padding: 30px;
        }
        .form-control {
            border-radius: 10px;
            border: 2px solid #e9ecef;
            padding: 12px 15px;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #c6a43b;
            box-shadow: 0 0 0 0.2rem rgba(198, 164, 59, 0.25);
        }
        .btn-dark {
            background: linear-gradient(135deg, #c6a43b 0%, #8b7355 100%);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        .btn-dark:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(198, 164, 59, 0.3);
        }
        .alert {
            border-radius: 10px;
            border: none;
        }
        .text-center a {
            color: #c6a43b;
            text-decoration: none;
            font-weight: 500;
        }
        .text-center a:hover {
            text-decoration: underline;
        }
        label {
            font-weight: 500;
            color: #495057;
            margin-bottom: 8px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Login Admin</h4>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">{{ $errors->first() }}</div>
                        @endif
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password" required>
                            </div>
                            <button type="submit" class="btn btn-dark w-100">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>