<?

// https://developers.facebook.com/docs/graph-api/reference/v2.11/page/feed

require_once __DIR__ . '/../vendor/autoload.php';
	
$fb_config = array(
	'appId'  => $_ENV['FACEBOOK_APP_ID'],
	'secret' => $_ENV['FACEBOOK_APP_SECRET'],
);
$fb_page = $_ENV['FACEBOOK_PAGE'];
$access_token = $_ENV["FACEBOOK_ACCESS_TOKEN"];
if(!empty($access_token)){
	$fb_config['default_access_token'] = $access_token;
}
	
$fb = new \Facebook\Facebook($fb_config);

try {
  // Returns a `Facebook\FacebookResponse` object
  $response = $fb->get(
    "/{$fb_page}/feed",
    $access_token
  );
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}
$graphNode = $response->getGraphNode();

print_r($graphNode);