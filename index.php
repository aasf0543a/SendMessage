<?php
$post_data = $_POST['message'];
//echo $post_data;

$request = new HttpRequest();
$request->setUrl('https://notify-api.line.me/api/notify');
$request->setMethod(HTTP_METH_POST);

$request->setHeaders(array(
  'postman-token' => '997280eb-dded-1202-2017-91216a9e2c87',
  'cache-control' => 'no-cache',
  'content-type' => 'application/x-www-form-urlencoded',
  'authorization' => 'Bearer Zv3KWsygHysC16wv9igBc7JB0UgyU2hpX9sZsDYS9FT'
));

$request->setContentType('application/x-www-form-urlencoded');
$request->setPostFields(array(
  'message' => $post_data
));

try {
  $response = $request->send();

  echo $response->getBody();
} catch (HttpException $ex) {
  echo $ex;
}
?>
