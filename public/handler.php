<?php
$user = 'root';
$pass = '';
$ds = 'groupe';
$db = new PDO("mysql:dbname=$ds;host=localhost",$user,$pass);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$task = "list";

if(array_key_exists("task", $_GET)){
    $task = $_GET['task'];
}
if($task == "write"){
    postMessage();
} else {
    getMessages();
}
function getMessages(){
    global $db;
    $resultats = $db->query("SELECT contenu_msg,sender FROM message ORDER BY datetemps_msg DESC LIMIT 20");
    $messages = $resultats->fetchAll();
    echo json_encode($messages);
}
function postMessage(){
    global $db;
    if(!array_key_exists('author', $_POST) || !array_key_exists('content', $_POST)){
        echo json_encode(["status" => "error", "message" => "One field or many have not been sent"]);
        return;
    }
    $author = $_POST['author'];
    $content = $_POST['content'];
    $query = $db->prepare('INSERT INTO message SET sender = :author, contenu_msg = :content, id_disc = 2');
    $query->execute([
        "author" => $author,
        "content" => $content
    ]);
    echo json_encode(["status" => "success"]);
}