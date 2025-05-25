<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil utilisateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 50px;
        }
        .profile-container {
            max-width: 700px;
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
            background-color: #4CAF50;
            border-color: #4CAF50;
        }
        .btn-primary:hover {
            background-color: #45a049;
            border-color: #45a049;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .alert {
            margin-bottom: 20px;
        }
        .card {
            margin-bottom: 20px;
        }
        .card-header {
            background-color: #f8f9fa;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="profile-container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Profil utilisateur</h2>
                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Retour au tableau de bord</a>
            </div>
            
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Informations du profil</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('profile.update') }}">
                                @csrf
                                @method('PUT')
                                
                                <div class="form-group">
                                    <label for="name">Nom</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="email">Adresse e-mail</label>
                                    <input type="email" class="form-control" id="email" value="{{ $user->email }}" disabled>
                                    <small class="form-text text-muted">L'adresse e-mail ne peut pas être modifiée.</small>
                                </div>
                                
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Mettre à jour le profil</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Changer le mot de passe</div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('password.change') }}">
                                @csrf
                                @method('PUT')
                                
                                <div class="form-group">
                                    <label for="current_password">Mot de passe actuel</label>
                                    <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password" required>
                                    @error('current_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="password">Nouveau mot de passe</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="password-confirm">Confirmer le nouveau mot de passe</label>
                                    <input type="password" class="form-control" id="password-confirm" name="password_confirmation" required>
                                </div>
                                
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Changer le mot de passe</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-12 mt-3 text-center">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger">Se déconnecter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>