<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion - GYDOC</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Inter', sans-serif; }
    body { background-color: #e7e9fd; display: flex; height: 100vh; }
    .container { display: flex; width: 100%; max-width: 100%; }
    .left, .right { width: 50%; display: flex; align-items: center; justify-content: center; padding: 40px; }
    .left {
      background-color: white;
      border-radius: 20px;
      margin: auto;
      max-width: 500px;
      flex-direction: column;
      box-shadow: 0px 5px 15px rgba(0,0,0,0.05);
    }
    .right {
      background-color: #e7e9fd;
      flex-direction: column;
      color: #4a4a4a;
      text-align: center;
    }
    h2 { font-size: 28px; margin-bottom: 10px; }
    p { font-size: 14px; margin-bottom: 20px; }
    form { width: 100%; }
    input {
      width: 100%;
      padding: 12px;
      margin-bottom: 15px;
      border-radius: 8px;
      border: 1px solid #ccc;
      background-color: #f1f1f8;
    }
    button {
      background-color: #7e5bef;
      color: white;
      border: none;
      padding: 12px;
      border-radius: 8px;
      width: 100%;
      font-weight: bold;
      cursor: pointer;
    }
    .bottom-links {
      margin-top: 15px;
      text-align: center;
      font-size: 14px;
    }
    .bottom-links a {
      color: #7e5bef;
      text-decoration: none;
      font-weight: 600;
    }
    a.forgot {
      font-size: 14px;
      color: #7e5bef;
      text-decoration: none;
      float: right;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="right">
      <img src="{{ asset('/frontend/dist/img/prepa-fp.png') }}" alt="Illustration" style="max-width: 300px; margin-bottom: 20px;">
      <h2>Content de vous revoir !</h2>
      <p>Connectez-vous pour accéder à votre espace <strong>PREPA FP</strong> sécurisé.</p>
    </div>
    <div class="left">
      <h2>Connexion</h2>
      <x-validation-errors class="mb-4" />
      <p>Veuillez entrer vos informations de connexion ci-dessous</p>
      <form method="POST" action="{{route('login')}}">
        @csrf
        <input type="email" name="email" placeholder="Adresse email" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <a href="#" class="forgot">Mot de passe oublié ?</a>
        <button type="submit">Se connecter</button>
        <div class="bottom-links">
          Pas de compte ? <a href="/register">S'inscrire</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
