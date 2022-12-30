
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Home</title>
    <?php
        require_once 'controllers/quiz.controller.php';
    ?>
</head>
<body>
    <p>
        <h1>Hello sir 
            <?php 
                if(isset($_SESSION['user'])){
                    echo $_SESSION['user']->getUsername();
                }
            ?>
        </h1>
    </p>
    <div>
        <form action="controllers/quiz.controller.php" method="GET">
            <input type="text" name="username" required >
            <button type="submit" name="addAccount" >Start Browsing</button>
            <?php
                if(isset($_SESSION['message'])){
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                }
            ?>
        </form>
    </div>
    <p>
        <?php
            getQuizes();
        ?>
    </p>
</body>
</html>