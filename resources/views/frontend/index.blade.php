<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Accueil</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Styles -->
        <style>
            body {
                margin: 0;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background-color: #e6e9ff;
            }

            .navbar {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 20px 40px;
            }

            .logo {
                font-weight: bold;
                font-size: 1.5rem;
                color: #5e3dea;
            }

            .nav-links a {
                text-decoration: none;
                margin-left: 20px;
                color: #5e3dea;
                font-weight: 500;
            }

            .main-content {
                display: flex;
                justify-content: center;
                align-items: center;
                height: calc(100vh - 100px);
                text-align: center;
                flex-direction: column;
            }

            .main-content h1 {
                font-size: 2.5rem;
                margin-bottom: 20px;
                color: #333;
            }

            .main-content .btn-start {
                background-color: #5e3dea;
                color: #fff;
                border: none;
                padding: 15px 30px;
                border-radius: 8px;
                font-size: 1rem;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }

            .main-content .btn-start:hover {
                background-color: #4c30c7;
            }
        </style>
    </head>
    <body>

        <div class="navbar">
            <div class="logo">PREPA FP</div>
            <div class="nav-links">
                <a href="{{ route('login') }}">Se connecter</a>
                <a href="{{ route('register') }}">Créer un compte</a>
            </div>
        </div>

        <div class="main-content">
            <h1>Bienvenue sur PREPA FP</h1>
            <a href="{{ route('login') }}">
                <button class="btn-start">Commencer</button>
            </a>
        </div>

    </body>
</html>
