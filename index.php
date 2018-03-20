<?php
//$post_data = &_GET['manid'];
//print $post_data;
//$post_data = file_get_contents("php://input");
//$post_data = $_POST;
//var_dump($post_data);
$post_safety = post['safety'];
$post_token = post['manid'];
$post_char = post['char'];
$post_backwork = post['backwork'];
$post_manname = post['manname'];
$post_mess = post_char . post_manname\r\n . post_safety . post_backwork

define('LINE_API_URL'  ,"https://notify-api.line.me/api/notify");
//define('LINE_API_TOKEN','Zv3KWsygHysC16wv9igBc7JB0UgyU2hpX9sZsDYS9FT');

function post_message($message){

    $data = array(
                        "message" => $message
                     );
    $data = http_build_query($data, "", "&");

    $options = array(
        'http'=>array(
            'method'=>'POST',
            'header'=>"Authorization: Bearer " . post_token . "\r\n"
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
