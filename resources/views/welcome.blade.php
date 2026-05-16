<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .welcome-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            padding: 3rem;
            text-align: center;
            max-width: 500px;
        }
        
        .welcome-card h1 {
            color: #333;
            margin-bottom: 1rem;
            font-weight: bold;
        }
        
        .welcome-card p {
            color: #666;
            margin-bottom: 2rem;
            font-size: 1.1rem;
        }
        
        .welcome-icon {
            font-size: 4rem;
            color: #667eea;
            margin-bottom: 1rem;
        }
        
        .btn-primary-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 0.75rem 2rem;
            font-size: 1.1rem;
            transition: transform 0.3s ease;
            color: white;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn-primary-custom:hover {
            transform: translateY(-3px);
            color: white;
        }
    </style>
</head>
<body>
    <div class="welcome-card" role="region" aria-label="Selamat datang">
        <div class="welcome-icon" aria-hidden="true">
            <i class="fas fa-graduation-cap"></i>
        </div>
        <h1>Selamat Datang!</h1>
        <p class="lead">Sistem Manajemen Data Mahasiswa</p>
        <p class="text-muted" style="margin-bottom: 2rem;">Kelola data mahasiswa dengan mudah dan efisien</p>
        <a href="{{ route('students.index') }}" class="btn btn-lg btn-light text-primary">
            <i class="fas fa-arrow-right me-1"></i> Mulai Sekarang
        </a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
