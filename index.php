<?php
$post_data = $_POST['message'];
//echo $post_data;

$request = new HttpRequest();
$request->setUrl('https://notify-api.line.me/api/notify');
$request->setMethod(HTTP_METH_POST);

$request->setHeaders(array(
  'authorization' => 'Bearer Zv3KWsygHysC16wv9igBc7JB0UgyU2hpX9sZsDYS9FT',
  'cache-control' => 'no-cache',
  'content-type' => 'application/x-www-form-urlencoded'
));

$request->setContentType('application/x-www-form-urlencoded');
$request->setPostFields(array(
  'message' => $post_data
));

try {
  $response = $request->send($post_data);
  echo $response->getBody();
}
