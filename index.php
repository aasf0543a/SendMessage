<?php
//example,
//post數據= "username=" & 帳號 & "&password=" & 密碼 & "&qeustions........"
//url = XXXXXXX?key=value&key=value
$post_safety = $_POST['safe'];
$post_token = $_POST['token'];
$post_backwork = $_POST['work'];
$post_manname = $_POST['name'];
$post_mess = "\r\n" . $post_manname . "\r\n" . $post_safety . "\r\n" . $post_backwork;
define('LINE_API_URL'  ,"https://notify-api.line.me/api/notify");
//define('LINE_API_TOKEN','Zv3KWsygHysC16wv9igBc7JB0UgyU2hpX9sZsDYS9FT');
define('API_TOKEN', $post_token);

function post_message($message){

    $data = array(
                        "message" => $message//先將message轉成索引数组
                     );
    $data = http_build_query($data, "", "&");//再將轉成變數=Value&變數=Value

    $options = array(
        'http'=>array(
            'method'=>'POST',
            'header'=>"Authorization: Bearer " . API_TOKEN . "\r\n"
                      . "Content-Type: application/x-www-form-urlencoded\r\n"
                      . "Content-Length: ".strlen($data)  . "\r\n" ,
            'content' => $data
        )
    );
    $context = stream_context_create($options);
    $resultJson = file_get_contents(LINE_API_URL,FALSE,$context );
    $resutlArray = json_decode($resultJson,TRUE);
    if( $resutlArray['status'] != 200)  {
        return false;
    }
    return true;
}

post_message($post_mess);

?>
