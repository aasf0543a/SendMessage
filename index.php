<?php
$post_data = $_POST['message'];
echo $post_data;
$request = new HttpRequest();
$request->setUrl('https://notify-api.line.me/api/notify');
$request->setMethod(HTTP_METH_POST);

$request->setHeaders(array(
  'postman-token' => 'ebcc9260-3462-42c9-77ee-f3a8eb564f85',
  'cache-control' => 'no-cache',
  'content-type' => 'application/x-www-form-urlencoded',
  'authorization' => 'Bearer Zv3KWsygHysC16wv9igBc7JB0UgyU2hpX9sZsDYS9FT'
));

$request->setContentType('application/x-www-form-urlencoded');
$request->setPostFields($post_data);

try {
  $response = $request->send();

  echo $response->getBody();
} catch (HttpException $ex) {
  echo $ex;
?>
