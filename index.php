<?php
//example,
//post數據= "username=" & 帳號 & "&password=" & 密碼 & "&qeustions........"
//url = XXXXXXX?key=value&key=value
/////////////////////////////////////////////////////////////
$post_token = $_POST['token'];
/////////////////////////////////////////////////////////////
$post_manname = $_POST['name'];
$post_safety = $_POST['safe'];
$post_backwork = $_POST['work'];
$post_mess = "\r\n" . $post_manname . "\r\n" . $post_safety . "\r\n" . $post_backwork;
define('LINE_API_URL'  ,"https://notify-api.line.me/api/notify");
define('API_TOKEN', $post_token);
//define('LINE_API_TOKEN','Zv3KWsygHysC16wv9igBc7JB0UgyU2hpX9sZsDYS9FT');
////////////////////////////////////////////////////////////
if(isset($_Post['token']) && (isset($_Post['image']))
{
  $post_token = $_Post['token'];
  $jpg = base64_To_jpeg($_Post['image'], 'test_png');
  SendImage($post_token, $jpg);
}
else
{
    post_message($post_mess);
}
////////////////////////////////////////////////////////////
//function base64_To_jpeg($base64_string,$output_file)
//{
//  if(empty($base64_string))
//  {
//      return 0;
//  }
//  $base64_string = str_replace('','+',base64_string);
//  $base64_string = base64_decode($base64_string);
//  $filename = 'tmp/' . $output_file;
//  $jpg = imagecreatfrompng($filename);
//  return $jpg;
//}
//
//////////////////////////////////////////////////////////////////////////////
//function SendImage($message)
//{
//  $data = array(
//                      "message" => $message//先將message轉成索引数组
//                    );
//  $data = http_build_query($data, "", "&");//再將轉成變數=Value&變數=Value
//
//  $options = array(
//        'http'=>array(
//            'method'=>'POST',
//            'header'=>"Authorization: Bearer " . API_TOKEN . "\r\n"
//                      . "Content-Type: multipart/form-data; boundary=----boundary\r\n"
//                      . "Content-Length: ".strlen($data)  . "\r\n" ,
//           'content' => $data
//        )
//    );
//////////////////////////////////////////////////////////////////////////////
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

?>
