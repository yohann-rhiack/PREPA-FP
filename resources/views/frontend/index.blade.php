<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
        }

        .hero-section {
            background: url('{{ asset('frontend/dist/img/quiz_background.jpeg') }}') no-repeat center center;
            background-size: cover;
            height: 100vh;
            width: 100vw;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .hero-button {
            padding: 15px 30px;
            font-size: 20px;
            font-weight: bold;
            text-transform: uppercase;
            border: none;
            border-radius: 8px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
            transition: 0.3s;
            text-decoration: none;
        }

        .hero-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="hero-section">
        <a href="{{route('frontend.admin-dashboard')}}" class="hero-button">Accéder au Dashboard</a>
    </div>

</body>
</html>
