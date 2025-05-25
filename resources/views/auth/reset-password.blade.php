<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation du mot de passe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 50px;
        }
        .reset-container {
            max-width: 450px;
            margin: 0 auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        .btn-primary {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            border-color: #4CAF50;
        }
        .btn-primary:hover {
            background-color: #45a049;
            border-color: #45a049;
        }
        .alert {
            margin-bottom: 20px;
        }
        .links {
            margin-top: 20px;
            text-align: center;
        }
        .links a {
            color: #4CAF50;
            text-decoration: none;
        }
        .links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="reset-container">
            <h2 class="text-center mb-4">Réinitialisation du mot de passe</h2>
            
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">
                
                <div class="form-group">
                    <label for="password">Nouveau mot de passe</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required autofocus>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="password-confirm">Confirmer le mot de passe</label>
                    <input type="password" class="form-control" id="password-confirm" name="password_confirmation" required>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Réinitialiser le mot de passe</button>
                </div>
                
                <div class="links">
                    <a href="{{ route('login') }}">Retour à la connexion</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>