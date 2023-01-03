<?php
include "{$_SERVER['DOCUMENT_ROOT']}/QUIZSITE--BackEnd/classes/User.php";
include "{$_SERVER['DOCUMENT_ROOT']}/QUIZSITE--BackEnd/classes/Database.php";

session_start();

if(isset($_GET['addAccount'])) addAccount();
if(isset($_GET['getinto'])) getIntoQuiz();
if(isset($_GET['logout'])) logOut();
if(isset($_POST['correction'])) answers();
if(isset($_POST['quizScore'])) saveHistory();


function getOS() { 
    
    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    $os_platform  = "Unknown OS Platform";

    $os_array     = array(
                          '/windows nt 10/i'      =>  'Windows 10',
                          '/windows nt 6.3/i'     =>  'Windows 8.1',
                          '/windows nt 6.2/i'     =>  'Windows 8',
                          '/windows nt 6.1/i'     =>  'Windows 7',
                          '/windows nt 6.0/i'     =>  'Windows Vista',
                          '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                          '/windows nt 5.1/i'     =>  'Windows XP',
                          '/windows xp/i'         =>  'Windows XP',
                          '/windows nt 5.0/i'     =>  'Windows 2000',
                          '/windows me/i'         =>  'Windows ME',
                          '/win98/i'              =>  'Windows 98',
                          '/win95/i'              =>  'Windows 95',
                          '/win16/i'              =>  'Windows 3.11',
                          '/macintosh|mac os x/i' =>  'Mac OS X',
                          '/mac_powerpc/i'        =>  'Mac OS 9',
                          '/linux/i'              =>  'Linux',
                          '/ubuntu/i'             =>  'Ubuntu',
                          '/iphone/i'             =>  'iPhone',
                          '/ipod/i'               =>  'iPod',
                          '/ipad/i'               =>  'iPad',
                          '/android/i'            =>  'Android',
                          '/blackberry/i'         =>  'BlackBerry',
                          '/webos/i'              =>  'Mobile'
                    );

    foreach ($os_array as $regex => $value)
        if (preg_match($regex, $user_agent))
            $os_platform = $value;

    return $os_platform;
}
function getBrowser() {

    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    $browser        = "Unknown Browser";

    $browser_array = array(
                            '/msie/i'      => 'Internet Explorer',
                            '/firefox/i'   => 'Firefox',
                            '/safari/i'    => 'Safari',
                            '/chrome/i'    => 'Chrome',
                            '/edge/i'      => 'Edge',
                            '/opera/i'     => 'Opera',
                            '/netscape/i'  => 'Netscape',
                            '/maxthon/i'   => 'Maxthon',
                            '/konqueror/i' => 'Konqueror',
                            '/mobile/i'    => 'Handheld Browser'
                     );

    foreach ($browser_array as $regex => $value)
        if (preg_match($regex, $user_agent))
            $browser = $value;

    return $browser;
}

function addAccount(){
    $username = htmlspecialchars($_GET['username']);
    $user = new User($username,$_SERVER['REMOTE_ADDR'],getOS(),getBrowser());
    $user->createAccount();
    $_SESSION['user'] = $user;
    header('location: ../index.php');
}
function getQuizes(){
    $quizes = $_SESSION['user']->getAllQuizes();
    foreach ($quizes as $key => $value) {
        $id = $value['id'];
        $name = $value['name'];
        $img = $value['img_path'];
        echo "
            <form class='flex flex-col border border-white rounded-lg overflow-hidden' action='controllers/quiz.controller.php' method='GET' >
                <div class=''>
                    <img class='w-52 h-52' src='$img' alt=''>
                </div>
                <div class='p-2'>
                    <input class='hidden' type='text' name='quizid' value='$id'>
                    <input class='hidden' type='text' name='quizname' value='$name'>
                    <span class='text-white'>$name</span>
                    <button type='submit' name='getinto' class='float-right bg-white px-2 rounded'>Get Into</button>
                </div>
            </form>
        ";
    }
    
}

function getIntoQuiz(){
    $_SESSION['quizid'] = $_GET['quizid'];
    $_SESSION['quizname'] = $_GET['quizname'];
    header("location: ../quiz.php");
}
function answers(){
    $quiz_id = $_SESSION['quizid'];
    $result = $_SESSION['user']->quizAnswers($quiz_id);
    echo json_encode($result);
}
function saveHistory(){
    $os= getOS();
    $browser = getBrowser();
    $_SESSION['user']->submitScore($_SESSION['quizid'],$_POST['quizScore'],$_SERVER['REMOTE_ADDR'],$os,$browser);
}
function logOut(){
    session_destroy();
    header("location: ../index.php");
}
// $result = $_SESSION['user']->getQuiz(1);
// var_dump($result);
// echo json_encode($result);