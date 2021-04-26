<?php
//$db = new PDO('mysql:host=localhost;dbname=spirity;charset=utf8', 'root', '', [
//    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
//]);
//$task = "list";
//$user = $_POST("user");
//$mdp = $_POST("mdp");
//if(array_key_exists("task", $_GET)){
//    $task = $_GET['task'];
//}
//
//switch ($task) {
//    case 0:
//        $table = "simple";
//        break;
//    case 1:
//        $table = "psycho";
//        break;
//    case 2:
//        $table = "coach";
//        break;
//    case 3:
//        $table = "";
//        break;
//}
//if($task == "write"){
//    postMessage();
//} else if {
//    getMessages();
//}
//function simple(){
//    global $db;
//    global $user;
//    global $mdp;
//    $resultats = $db->query("SELECT username FROM  ORDER BY created_at DESC LIMIT 1");
//    $messages = $resultats->fetchAll();
//}
//
//function psycho(){
//    global $db;
//    global $user;
//    global $mdp;
//    $resultats = $db->query("SELECT * FROM messages ORDER BY created_at DESC LIMIT 20");
//}
//
//function coach(){
//    global $db;
//    global $user;
//    global $mdp;
//    $resultats = $db->query("SELECT * FROM messages ORDER BY created_at DESC LIMIT 20");
//}
//
//function nutri(){
//    global $db;
//    global $user;
//    global $mdp;
//    $resultats = $db->query("SELECT * FROM messages ORDER BY created_at DESC LIMIT 20");
//}
//function postMessage(){
//    global $db;
//    if(!array_key_exists('author', $_POST) || !array_key_exists('content', $_POST)){
//        echo json_encode(["status" => "error", "message" => "One field or many have not been sent"]);
//        return;
//    }
//    $author = $_POST['author'];
//    $content = $_POST['content'];
//    $query = $db->prepare('INSERT INTO messages SET author = :author, content = :content, created_at = NOW()');
//
//    $query->execute([
//        "author" => $author,
//        "content" => $content
//    ]);
//    echo json_encode(["status" => "success"]);
//}