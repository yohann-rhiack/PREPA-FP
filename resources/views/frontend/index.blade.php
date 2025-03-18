<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hero Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="relative w-full h-screen bg-cover bg-center" style="background-image: url('https://source.unsplash.com/1600x900/?travel,landscape');">
        <div class="absolute inset-0 bg-black bg-opacity-50 flex flex-col items-center justify-center text-center text-white p-4">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">Bienvenue</h1>
            <p class="text-lg md:text-2xl mb-8">Dans votre AppQuiz</p>
            <a href="/backend/dashboard" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg text-lg">Accéder au Dashboard</a>
        </div>
    </div>
</body>
</html>
