<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/css/styles.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-300">
    <div class="mt-48 flex justify-center items-center">
        <div class="flex flex-col items-center">
            <h1 class="text-5xl font-bold pb-2 text-gray-800">Резюме мастер</h1>
            <!-- <h2 class="text-4xl pb-6 text-gray-800">Делайте вместе. Делайте вовремя.</h2> -->
                <div class="bg-gray-50 w-96 rounded-md px-6">
                    <h2 class="text-3xl font-bold text-center mt-6 mb-6">Вход</h2>
                    <?php if(isset($errors)) : ?>
                            <?php foreach($errors as $error) : ?>
                                <div class= "bg-red-400 text-white font-bold text-md p-2"><?=$error?></div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <form method="POST" action="/login">
                        <input
                        type="email"
                        name="email"
                        placeholder="Email"
                        class="w-full px-4 py-2 border rounded focus:outline-none mb-4"
                        />
                        <input
                        type="password"
                        name="password"
                        placeholder="Пароль"
                        class="w-full px-4 py-2 border rounded focus:outline-none mb-4"
                        />
                        <button type="submit" class="w-full bg-slate-500 hover:bg-slate-600 text-white px-4 py-2 rounded focus:outline-none mb-6">
                            Войти
                        </button>
                    </form>
                </div>
        </div>
    </div>
</body>
</html>