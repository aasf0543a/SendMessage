<?php
$post_data = $_POST;
//echo $post_data;
//var_dump($post_data)

 public function send($post_data, $imagePath = null, $sticker = null) {

if (empty($post_data)) {
      return false;
    }
   
   $request_params = [
      'headers' => [
        'Authorization' => 'Bearer ' . 'Bearer Zv3KWsygHysC16wv9igBc7JB0UgyU2hpX9sZsDYS9FT'
      ],
    ];
   //Message always required
    $request_params['multipart'] = [
      [
        'name' => 'message',
        'contents' => $post_data
      ]
    ];
       if (!empty($imagePath) && preg_match("#^https?://#", $imagePath)) {
      // Remote HTTP / HTTPS image
      $request_params['multipart'][] = [
        'name' => 'imageThumbnail',
        'contents' => $imagePath
      ];
      
      $request_params['multipart'][] = [
        'name' => 'imageFullsize',
        'contents' => $imagePath
      ];
      
    if (!empty($imagePath) && file_exists($imagePath)) {
      // Local image
      $request_params['multipart'][] = [
        'name' => 'imageFile',
        'contents' => fopen($imagePath, 'r')
      ];
    }
    //https://devdocs.line.me/files/sticker_list.pdf
    if (!empty($sticker) 
      && !empty($sticker['stickerPackageId']) 
      && !empty($sticker['stickerId'])) {
      
      $request_params['multipart'][] = [
        'name' => 'stickerPackageId',
        'contents' => $sticker['stickerPackageId']
      ];
      
      $request_params['multipart'][] = [
        'name' => 'stickerId',
        'contents' => $sticker['stickerId']
      ];
      
    }
    $response = $this->http->request('POST', LineNotify::API_URL, $request_params);
    if ($response->getStatusCode() != 200) {
      return false;
    }
    $body = (string) $response->getBody();
    $json = json_decode($body, true);
    if (empty($json['status']) || empty($json['message'])) {
      return false;
    }
    return true;
  }
 
 
 
?>
