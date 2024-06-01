<?php
use Framework\Session;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/icon.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="text-gray-600">
    <div class="grid grid-cols-6"> <!--content wrapper-->
        <nav class="col-span-1 bg-slate-800 h-dvh">
            <div class="bg-slate-500 flex justify-center py-2 px-5 h-12 items-center">
                <h1 class="text-white text-3xl font-semibold">DoTeams</h1>
            </div>
            <div class="text-slate-100"> 
                <div class="p-5 border-b-2 border-slate-600">
                    <h3 class="text-lg font-semibold">Здравствуйте, <?=Session::get('user')['name']?></h3>
                    <h3 class="text-lg font-semibold">(Роль сотрудника)</h3>
                </div>
                <ul class="text-slate-300 mt-5 text-lg">
                    <li class="py-2 pl-5 hover:bg-slate-900 hover:text-slate-50 ">
                    <svg class="iconbig" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                    </svg>
                        <a href="/tasks" class="cursor-default w-full h-full">
                            <span>Все задачи</span>
                        </a>
                    </li>
                    <li class="py-2 pl-5 hover:bg-slate-900 hover:text-slate-50 ">
                    <svg class="iconbig" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                        <a href="/tasks/create" class="cursor-default">
                            <span>Добавить задачу</span>
                        </a>
                    </li>
                    <li class="py-2 pl-5 bg-slate-900 text-slate-50 ">
                    <svg class="iconbig" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                        <a href="/tasks/<?=$task['id']?>" class="cursor-default">
                            <span><?=$task['title']?></span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <main class="col-span-5 bg-slate-50 h-dvh">
            <header class="bg-slate-400 flex justify-end py-3 px-5">
            <svg class="icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.2" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                </svg>
            <form method="POST", action="/logout">
                    <button type="submit" class="text-white font-bold">Выйти</button>
                </form>
            </header>

            <div class="my-3 mx-5 bg-white rounded shadow-md border-t-4 border-slate-300">
                <div>
                    <div class="border-b border-gray-100 flex items-center justify-between">
                        <h1 class="text-2xl p-3 text-gray-700"><?=$task['title']?></h1>
                        <!-- <div class="pr-4">
                            <a href="#">Редактировать</a>
                            <a href="#">Удалить</a>
                        </div> -->
                    </div>
                    <form method="POST" action="/tasks/<?= $task['id']?>">
                    <input type="hidden" name="_method" value="PUT">
                        <?php if(isset($errors)) : ?>
                            <?php foreach($errors as $error) : ?>
                                <div class= "bg-red-400 text-white font-bold text-md p-2"><?=$error?></div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <div class="grid grid-cols-2">
                            <div class="p-4">
                                <h2 class="font-bold text-md pl-3 pb-2">Название дела</h2>
                                <input
                                type="text"
                                name="title"
                                placeholder="Введите название дела"
                                value="<?=$task['title'] ?? ''?>"
                                class="w-full px-4 py-2 border rounded focus:outline-none mb-4"
                                />
                                <h2 class="font-bold text-md pl-3 pb-2">Дедлайн</h2>
                                <input
                                type="date"
                                name="deadline"
                                placeholder="Введите крайнюю дату"
                                value="<?=$task['deadline'] ?? ''?>"
                                class="w-full px-4 py-2 border rounded focus:outline-none mb-4"
                                />
                                <h2 class="font-bold text-md pl-3 pb-2">Время</h2>
                                <input
                                type="time"
                                name="time"
                                placeholder="Введите время"
                                value="<?=$task['time'] ?? ''?>"
                                class="w-full px-4 py-2 border rounded focus:outline-none mb-4"
                                />
                            </div>
                            <div class="p-4">
                                <h2 class="font-bold text-md pl-3 pb-2">Комментарии</h2>
                                <textarea 
                                name="comment" 
                                placeholder="Введите комментарий"
                                class="w-full px-4 py-2 border rounded focus:outline-none mb-4 h-32 resize-none"
                                ><?=$task['comment'] ?? ''?></textarea>
                            </div>
                        </div>
                        <div class="flex justify-center items-center">
                            <button type="submit" class="w-96 bg-slate-500 hover:bg-slate-600 text-white px-4 py-2 rounded focus:outline-none mb-3">
                                Изменить дело
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </main>
    </div>
</body>
</html>