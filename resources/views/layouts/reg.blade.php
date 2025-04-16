<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscription - GYDOC</title>
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
    input, select {
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
  </style>
</head>
<body>
  <div class="container">
    <div class="right">
      <img src="{{ asset('/frontend/dist/img/prepa-fp.png') }}" alt="Illustration" style="max-width: 300px; margin-bottom: 20px;">
      <h2>Bienvenue sur PREPA FP</h2>
      <x-validation-errors class="mb-4" />
      <p>Créez un compte pour commencer à utiliser notre plateforme sécurisée.</p>
    </div>
    <div class="left">
      <h2>Inscription</h2>
      <p>Merci de remplir les informations ci-dessous pour créer votre compte</p>
      <form method="POST" action="{{route ('register')}}">
        @csrf
        <input type="text" name="fname" id="fname" placeholder="Prénom" required> 
        <input type="text" name="lname" id="lname" placeholder="Nom" required>
        <input type="tel" name="phone" id="phone" placeholder="Téléphone" required>
        <input type="email" name="email" id="email" placeholder="Adresse email" required>
        <input type="password" name="password" id="password" placeholder="Mot de passe" required>
        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirmer le mot de passe" required>
        <button type="submit">Créer un compte</button>
        <div class="bottom-links">
          Déjà un compte ? <a href="/login">Se connecter</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
