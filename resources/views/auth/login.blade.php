<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Admin</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<style>
    body, html { height:100%; margin:0; }
    .video-bg {
        position: fixed; right:0; bottom:0; min-width:100%; min-height:100%; z-index:-1;
    }
    .login-card {
        backdrop-filter: blur(10px);
        background: rgba(255,255,255,0.2);
        border-radius: 10px;
    }
</style>
</head>
<body class="d-flex justify-content-center align-items-center">

<video autoplay muted loop class="video-bg">
    <source src="{{ asset('videos/yonsei.mp4') }}" type="video/mp4">
</video>

<div class="card p-4 shadow login-card" style="width:400px;">
    <h3 class="mb-4 text-center text-white">Admin Login</h3>
    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="text-white">Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="text-white">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
</div>

</body>
</html>
