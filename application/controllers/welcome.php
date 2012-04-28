<?php
class Welcome extends CI_Controller {

	public $app_id;
	public $app_secret;
	public $fb_data;
	public $user;

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('mfacebook');
		$this->app_id ='Add your app id';
		$this->app_secret = 'add your app secret';
		$this->load->helper('url');
		
		$config = array(
						'appId'  => $this->app_id,
						'secret' => $this->app_secret,
						'fileUpload' => true, // Indicates if the CURL based @ syntax for file uploads is enabled.
						);
		
		$this->load->library('Facebook', $config);
		
		$this->user = $this->facebook->getUser();

		// We may or may not have this data based on whether the user is logged in.
		//
		// If we have a $user id here, it means we know the user is logged into
		// Facebook, but we don't know if the access token is valid. An access
		// token is invalid if the user logged out of Facebook.
		$profile = null;
		if($this->user)
		{
			try {
			    // Proceed knowing you have a logged in user who's authenticated.
				$profile = $this->facebook->api('/me?fields=id,name,link,email');
			} catch (FacebookApiException $e) {
				error_log($e);
			    $this->user = null;
			}		
		}
		
		$this->fb_data = array(
						'me' => $profile,
						'uid' => $this->user,
						'loginUrl' => $this->facebook->getLoginUrl(
							array(
								'scope' => 'email,user_birthday,publish_stream', // app permissions
								'redirect_uri' => site_url('welcome'), // URL where you want to redirect your users after a successful login
							)
						),
						'logoutUrl' => $this->facebook->getLogoutUrl(),
					);
		//$this->session->set_userdata('fb_data', $fb_data);// since fb uses session, here we don't use CI session
	}
	


	function index()
	{
		//$fb_data = $this->session->userdata('fb_data');
		$fb_data = $this->fb_data;
		$data['fb_data'] = $fb_data;

		//$data['me'] = $data['fb_data']['me'];
		if(isset($fb_data['me']))
		{
			$data['me']=$me = $fb_data['me'];
 			$user = $this->mfacebook->checkuser($me);
 			
 			if (empty($user)) 
		    {
		    	$this->mfacebook->insert_user($me);
		    }
		}
		
		$this->load->view('welcome', $data);
	}
	


	function facebook_friends()
	{
		$fb_data = $this->fb_data;
		
		if((!$fb_data['uid']) or (!$fb_data['me']))
		{
			redirect('welcome');
		}
		else
		{
			$data = array(
						'fb_data' => $fb_data,
						);
			$app_id = "fb_".$this->app_id."_access_token";
			$access_token = $_SESSION[$app_id];
			$url = 'https://graph.facebook.com/me/friends?access_token='.$access_token;
			$data['friends'] = json_decode(file_get_contents($url));
			$this->load->view('facebook_friends', $data);
		}
	}


	public function logout()
	{
		$_SESSION = array();

		if (isset($_COOKIE[session_name()])) 
		{
		    setcookie(session_name(), '', time() - 86400, '/ci_fb/');
		}
		session_destroy();
		//$this->session->unset_userdata('fb_data');
		//$this->session->sess_destroy();
		redirect('welcome');
	}

	function fbmain()
	{

		$loginUrl   = $facebook->getLoginUrl(
            array(
                'scope'         => 'email,offline_access,publish_stream,user_birthday,user_location,user_work_history,user_about_me,user_hometown',
                'redirect_uri'  => $fbconfig['baseurl']
            )
	    );
	 
	    $logoutUrl  = $facebook->getLogoutUrl();
		$this->load->view('fbmain', $data);
	}
}
?>