<?php
$post_data = $_POST;
//echo $post_data;
//var_dump($post_data)
$request = new HttpRequest();
$request->setUrl('https://send-message.herokuapp.com/index.php');
$request->setMethod(HTTP_METH_POST);

$request->setHeaders(array(
  'Method' => 'POST',
  'content-type' => 'application/x-www-form-urlencoded',
  'authorization' => 'Bearer Zv3KWsygHysC16wv9igBc7JB0UgyU2hpX9sZsDYS9FT'
));

$request->setContentType('application/x-www-form-urlencoded');
$request->setPostFields(array(
  'message' => '好的老師帶你上天堂'
));

try {
  $response = $request->send();

  echo $response->getBody();
} catch (HttpException $ex) {
  echo $ex;
}
?>
