<?php
class Smartid_model extends CI_Model {

	private $clientId = 'KDg6JNWLGUIg99B1o1hZ4VUO7OvHP3hR';
	private $clientSecret = 'eddCuf7n8KCWOAKlLHMxjQLKZprweUtv';
	private $redirectUrl = "https://www.medesteetika.ee/fake-emails/login/smartcallback";

	private $authorizeUrl = 'https://id.smartid.ee/oauth/authorize';
	private $accessTokenUrl = 'https://id.smartid.ee/oauth/access_token';

	private $client;

	public function __construct(){
		parent::__construct();
		require_once(APPPATH . '/third_party/smartid/Client.php');
		require_once(APPPATH . "/third_party/smartid/GrantType/IGrantType.php");
		require_once(APPPATH . "/third_party/smartid/GrantType/AuthorizationCode.php");

		$this->client = new OAuth2\Client($this->clientId, $this->clientSecret, OAuth2\Client::AUTH_TYPE_AUTHORIZATION_BASIC);
		$this->client->setCurlOption(CURLOPT_USERAGENT, "UserAgent");
	}

	public function login(){
		if (!isset($_GET["code"])) {
		    $authUrl = $this->client->getAuthenticationUrl($this->authorizeUrl, $this->redirectUrl, array());
		    header("Location: " . $authUrl);
		    die("Redirect");
		}
	}	

	public function getCallbackEmail(){
		if (isset($_GET["code"])) {
		    $params = array("code" => $_GET["code"], "redirect_uri" => $this->redirectUrl);
		    $response = $this->client->getAccessToken($this->accessTokenUrl, "authorization_code", $params);

		    $accessTokenResult = $response["result"];
		    $this->client->setAccessToken($accessTokenResult["access_token"]);
		    $this->client->setAccessTokenType(OAuth2\Client::ACCESS_TOKEN_BEARER);

		    $response = $this->client->fetch("https://id.smartid.ee/api/v2/user_data");

		    return $response["result"]["email"];
		    /* $response = array(3) {
			  ["result"]=> array(8) {
			    ["status"]=> string(2) "OK"
			    ["idcode"]=> string(11) "39609012156"
			    ["lastname"]=> string(8) "Last Name"
			    ["firstname"]=> string(13) "First name"
			    ["email"]=> string(24) "Email"
			    ["email_verified"]=> string(4) "true"
			    ["last_login_method"]=> string(8) "Smart-ID"
			    ["current_login_method"]=> string(8) "Smart-ID"
			  }
			  ["code"]=> int(200)
			  ["content_type"]=> string(16) "application/json"
			}
		    */
		}
	}
	
}
?>