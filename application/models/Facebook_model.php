<?php
class Facebook_model extends CI_Model {
	
	private $fb;

	public function __construct(){
		parent::__construct();
		$this->fb = new \Facebook\Facebook([
			'app_id' => '163711774288814',
			'app_secret' => '766dba50bd054df89e9b3ca8881bc2f3',
			'default_graph_version' => 'v2.2' 
		]); 
	}


	public function fbLogin(){
		$helper = $this->fb->getRedirectLoginHelper();

		$permissions = ['email'];
		$loginUrl = $helper->getLoginUrl(base_url() . 'login/fbcallback', $permissions);

		return '<a href="' . htmlspecialchars($loginUrl) . '">Log in with facebook!</a>';
	}

	public function fbCallback(){
		$helper = $this->fb->getRedirectLoginHelper();

		try {
		  $accessToken = $helper->getAccessToken();
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
		  // When Graph returns an error
		  return null;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		  // When validation fails or other local issues
		  return null;
		}

		if (! isset($accessToken)) {
		  if ($helper->getError()) {
		    header('HTTP/1.0 401 Unauthorized');
		  } else {
		    header('HTTP/1.0 400 Bad Request');
		  }
		  return null;
		}

		// Logged in
		// The OAuth 2.0 client handler helps us manage access tokens
		$oAuth2Client = $this->fb->getOAuth2Client();

		// Get the access token metadata from /debug_token
		$tokenMetadata = $oAuth2Client->debugToken($accessToken);

		// Validation (these will throw FacebookSDKException's when they fail)
		$tokenMetadata->validateAppId('163711774288814'); // Replace {app-id} with your app id
		// If you know the user ID this access token belongs to, you can validate it here
		//$tokenMetadata->validateUserId('123');
		$tokenMetadata->validateExpiration();

		if (! $accessToken->isLongLived()) {
		  // Exchanges a short-lived access token for a long-lived one
		  try {
		    $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
		  } catch (Facebook\Exceptions\FacebookSDKException $e) {
		    return null;
		  }
		}

		$_SESSION['fb_access_token'] = (string) $accessToken;

		try {
  		// Returns a `FacebookFacebookResponse` object
		  $response = $this->fb->get(
		    '/me?local=en_US&fields=name,email',
		    $_SESSION['fb_access_token']
		  );
		  $userNode = $response->getGraphUser();
		  return $userNode->getField('email');
		} catch(FacebookExceptionsFacebookResponseException $e) {
		  return null;
		} catch(FacebookExceptionsFacebookSDKException $e) {
		  return null;
		}
		//$graphNode = $response->getGraphNode();
		return null;
	}
}

?>