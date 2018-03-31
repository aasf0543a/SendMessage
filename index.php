<?php
//example,
//post數據= "username=" & 帳號 & "&password=" & 密碼 & "&qeustions........"
//url = XXXXXXX?key=value&key=value
//$post_data = &_GET['manid'];
//print $post_data;
//$post_data = file_get_contents("php://input");
//$data1 = array(
//    $post_data
//    );
//$mess = $data1[1] . $data1[2] . $data1[3] . $data1[4];
//$post_data = $_POST;
//var_dump($post_data);
//$post_safety = $_POST['safety'];
$post_token = $_POST['token'];
//$post_char = $_POST['char'];
//$post_backwork = $_POST['backwork'];
//$post_manname = $_POST['manname'];
//$post_mess = $post_char . $post_manname . $post_safety . $post_backwork;
define('LINE_API_URL'  ,"https://notify-api.line.me/api/notify");
//define('LINE_API_TOKEN','Zv3KWsygHysC16wv9igBc7JB0UgyU2hpX9sZsDYS9FT');

function post_message($message){

    $data = array(
                        "message" => $message//先將message轉成索引数组
                     );
    $data = http_build_query($data, "", "&");//再將轉成變數=Value&變數=Value

    $options = array(
        'http'=>array(
            'method'=>'POST',
            'header'=>"Authorization: Bearer " . $post_token . "\r\n"
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

post_message($post_token);

?>
