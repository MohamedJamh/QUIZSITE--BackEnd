<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.5/dist/flowbite.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js'></script>
    <title>Home</title>
    <?php
        require_once 'controllers/quiz.controller.php';
    ?>
</head>
<body>
    <nav class="text-white border-gray-200 px-2 py-1 sm:px-4" >
        <div class="flex flex-wrap items-center justify-between mx-auto">
            <a href="https://flowbite.com/" class="flex items-center">
                <img src="https://flowbite.com/docs/images/logo.svg" class=" mr-3 sm:h-9" alt="Flowbite Logo" />
                <span class="self-center text-xl font-semibold whitespace-nowrap">Quizsite</span>
            </a>
            <div class="flex md:order-2">
                <?php
                    if(!isset($_SESSION['user'])){
                        echo '
                        <button class=" block text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-1 text-center " type="button" data-modal-toggle="authentication-modal" style="background-color:#16213E;">
                            Log
                        </button>
                        ';
                    }else{
                        $user = strtoupper($_SESSION['user']->getUsername());
                        echo "<span class='p-1 font-bold'>$user</span>";
                        echo "
                            <form class='' action='controllers/quiz.controller.php' method='GET' >
                                <button class='bg-sky-500 block text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-1 text-center' name='logout' type='submit'>
                                    Log out
                                </button>
                            </form>
                        ";
                    }
                ?>
            </div>
        </div>
    </nav>
    <div class="flex flex-wrap justify-center gap-16 p-10">
        <?php
            if(isset($_SESSION['user'])){
                getQuizes();
            }else{
                echo '
                    <div class="w-100 mx-auto text-white mt-10 font-bold text-4xl">
                        <p>
                            No Content Available For Now !
                        </p>
                    </div>
                ';
            }
        ?>
        
    </div>
    <div id="authentication-modal" tabindex="-1" data-modal-backdrop="static" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
        <div class="relative w-full h-full max-w-md md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="px-6 py-6 lg:px-8">
                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Submite Your Username</h3>
                    <form class="space-y-6" action="controllers/quiz.controller.php" method="GET">
                        <div>
                            <input type="text" name="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Your Full name or nickname" required>
                        </div>
                        <button type="submit" name="addAccount" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" >Start Browsing</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="p-2">
        
    </div>
    <script src="https://unpkg.com/flowbite@1.5.5/dist/flowbite.js"></script>
    <script>

    </script>
</body>
</html>