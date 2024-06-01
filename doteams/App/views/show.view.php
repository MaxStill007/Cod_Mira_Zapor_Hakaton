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
                <h1 class="text-white text-2xl font-semibold">Резюме Мастер</h1>
            </div>
            <div class="text-slate-100"> 
                <div class="p-5 border-b-2 border-slate-600">
                    <h3 class="text-lg font-semibold">Здравствуйте, <?=Session::get('user')['name']?></h3>
                    <h3 class="text-md font-semibold"><?=Session::get('user')['role']?></h3>
                </div>
                <ul class="text-slate-300 mt-5 text-md">
                    <li class="py-2 pl-5 hover:bg-slate-900 hover:text-slate-50">
                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                    </svg>
                        <a href="/resume" class="cursor-default w-full h-full">
                            <span>Все резюме</span>
                        </a>
                    </li>
                    <li class="py-2 pl-5 hover:bg-slate-900 hover:text-slate-50">
                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                        <a href="/resume/create" class="cursor-default">
                            <span>Добавить резюме</span>
                        </a>
                    </li>
                    <li class="py-2 pl-5 bg-slate-900 text-slate-50 ">
                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>
                        <a href="#" class="cursor-default">
                            <span><?=$resume['name']?></span>
                        </a>
                    </li>
                    <li class="py-2 pl-5 hover:bg-slate-900 hover:text-slate-50">
                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                        <a href="/templates" class="cursor-default w-full h-full">
                            <span>Шаблоны</span>
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
                    <?php if(isset($_SESSION['error_message'])) : ?>
                        <div class= "bg-red-300 text-white font-bold text-md p-2">
                            <?=
                            $_SESSION['error_message'];
                            Session::clearByKey('error_message');
                            ?>
                        </div>
                    <?php endif; ?>
                    <?php if(isset($_SESSION['success_message'])) : ?>
                        <div class= "bg-green-400 m-2 text-white font-bold text-md p-2">
                            <?=
                            $_SESSION['success_message'];
                            Session::clearByKey('success_message');
                            ?>
                        </div>
                    <?php endif; ?>
                    <div class="border-b border-gray-100 flex items-center justify-between px-5">
                        <h1 class="text-2xl p-3 text-gray-700"><?=$resume['name']?></h1>
                        <div class="pr-4 flex items-center justify-between">
                                <form method="POST">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class=" bg-red-700 hover:bg-red-800 text-white rounded text-sm w-fit font-bold p-2 ml-2 ">Удалить</button>
                                </form>
                        </div>
                    
                    </div>
                        <div class="flex px-10 gap-6">
                            <div class="">
                            <h2 class="text-md font-bold p-4">Навыки:<p class="pl-4 text-md font-normal"><?=$resume['skills']?></p></h2>
                            <h2 class="text-md font-bold p-4">Опыт работы:<p class="pl-4 text-md font-normal"><?=$resume['experience']?> г.</p></h2>
                            <h2 class="text-md font-bold p-4">Телефон:<p class="pl-4 text-md font-normal"><?=$resume['phone']?></p></h2>
                            <h2 class="text-md font-bold p-4">Email:<p class="pl-4 text-md font-normal"><?=$resume['email']?></p></h2>
                            <h2 class="text-md font-bold p-4">Добавлен:<p class="pl-4 text-md font-normal"><?=$resume['created_at']?></p></h2>
                            </div>
                            <div>
                            <h2 class="text-md font-bold p-4 py-10">Соответствует профессии "Системный аналитик" на:</h2>
                            <h2 class="text-md font-bold p-4 py-10">Соответствует профессии "Java разработчик" на:</h2>
                            <h2 class="text-md font-bold p-4 py-10">Соответствует профессии "Frontend разработчик" на:</h2>
                            </div>
                            <div class="">
                            <?php foreach($percents as $percent) : ?>
                            <?php if($percent < 40) : ?>
                                <div class="flex flex-col items-center block py-4">
                                <div class="bg-red-400 block w-32 h-20 col-span-1 ml-10 rounded-lg text-4xl text-white font-bold flex items-center justify-center"><h1><?=$percent?>%</h1></div>
                                </div>
                            <?php elseif($percent >=40 && $percent <=65) : ?>
                                <div class="flex flex-col items-center block py-4">
                                <div class="bg-yellow-400 block w-32 h-20 col-span-1 ml-10 rounded-lg text-4xl text-white font-bold flex items-center justify-center"><h1><?=$percent?>%</h1></div>
                                </div>
                            <?php else : ?>
                                <div class="flex flex-col items-center block py-4">
                                <div class="bg-green-400 block w-32 h-20 col-span-1 ml-10 rounded-lg text-4xl text-white font-bold flex items-center justify-center"><h1><?=$percent?>%</h1></div>
                                </div>        
                            <?php endif; ?>
                            <?php endforeach; ?>
                            </div>
                            
                        </div>
                        <div class="flex justify-center items-center">
                        <!-- <?php if(Session::get('user')['role']) : ?>
                            <?php if($resume['role'] === "") : ?>
                                <form method="POST" action="/resume/status/<?= $resume['id']?>">
                                <input type="hidden" name="_method" value="PUT">
                                <button type="submit" class="w-72 bg-green-600 hover:bg-green-500 text-white px-4 py-2  text-lg rounded focus:outline-none mb-3">
                                    Завершить дело
                                </button>
                                </form>
                            <?php else : ?>
                                <form method="POST" action="/resume/status/<?= $resume['id']?>">
                                <input type="hidden" name="_method" value="PUT">
                                <button type="submit" class="w-72 bg-slate-400 hover:bg-slate-600 text-white px-4 py-2  text-lg rounded focus:outline-none mb-3">
                                    Возобновить дело
                                </button>
                                </form>
                            <?php endif; ?>
                         <?php endif; ?> -->
                        </div>
                    </form>
                </div>
            </div>

        </main>
    </div>
</body>
</html>