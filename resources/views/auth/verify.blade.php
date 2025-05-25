<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérification de l'adresse e-mail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 50px;
        }
        .verify-container {
            max-width: 450px;
            margin: 0 auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
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
        <div class="verify-container">
            <h2 class="text-center mb-4">Vérification de l'adresse e-mail</h2>
            
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            
            <div class="alert alert-info">
                Un lien de vérification a été envoyé à votre adresse e-mail. Veuillez vérifier votre boîte de réception et cliquer sur le lien pour activer votre compte.
            </div>
            
            <p>Si vous n'avez pas reçu l'e-mail, vous pouvez demander un nouveau lien de vérification.</p>
            
            <div class="links">
                <a href="{{ route('login') }}">Retour à la connexion</a>
            </div>
        </div>
    </div>
</body>
</html>