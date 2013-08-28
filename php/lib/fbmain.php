<?php
    //facebook application configuration -mahmud
    $fbconfig['appid' ] = "110759525760819";
    $fbconfig['secret'] = "ccf15ec6ec24276fbd830c30ca85d6bd";

    $fbconfig['baseUrl']    =   "http://www.appsbond.cl/powerade/tabs/test-rfid/";// "http://thinkdiff.net/demo/newfbconnect1/iframe/sdk3";
    $fbconfig['appBaseUrl'] =   "http://apps.facebook.com/powerade-wristaband";// "http://apps.facebook.com/thinkdiffdemo";
	$fbconfig['fanpageTab'] =	"http://apps.facebook.com/powerade-wristaband";
    
    /* 
     * If user first time authenticated the application facebook
     * redirects user to baseUrl, so I checked if any code passed
     * then redirect him to the application url 
     * -mahmud
     */
    if (isset($_GET['code'])){
        header("Location: " . $fbconfig['fanpageTab']);
        // header("Location: play.php");
        exit;
    }
    //~~
    
    //
    if (isset($_GET['request_ids'])){
        //user comes from invitation
        //track them if you need
    }
	
    
    $uid            =   null; //facebook user uid
	$fbme = null;
    try{
        include_once "facebook.php";
    }
    catch(Exception $o){
        //echo '<pre>';
        //print_r($o);
        //echo '</pre>';
    }
    // Create our Application instance.
    $facebook = new Facebook(array(
      'appId'  => $fbconfig['appid'],
      'secret' => $fbconfig['secret'],
      'cookie' => true,
    ));

    //Facebook Authentication part
    $uid       = $facebook->getUser();
    // We may or may not have this data based 
    // on whether the user is logged in.
    // If we have a $uid id here, it means we know 
    // the user is logged into
    // Facebook, but we don’t know if the access token is valid. An access
    // token is invalid if the user logged out of Facebook.
    $loginUrl   = $facebook->getLoginUrl(
            array(
				'display'   => 'page',
	            'canvas'    => 1,
	            'fbconnect' => 0,
                'scope'         => 'email,publish_stream,user_birthday,user_location,user_work_history,user_about_me,user_hometown,status_update' 
            )
    );
    if ($uid) {
      try {
        // Proceed knowing you have a logged in user who's authenticated.
        $fbme = $facebook->api('/me');
      } catch (FacebookApiException $e) {
        //you should use error_log($e); instead of printing the info on browser
        d($e);  // d is a debug function defined at the end of this file
        $uid = null;
      }
    }

    if (!$uid) {
		//echo "<script type='text/javascript'>alert('debe instalar la aplicacion!');</script>";
        //echo "<script type='text/javascript'>top.location.href = '$loginUrl';</script>";
        //exit;
    }
    
    //get user basic description
	if ($uid) {
		try {
			$userInfo = $facebook->api("/$uid");
		} catch (FacebookApiException $e) {
			//you should use error_log($e); instead of printing the info on browser
			d($e);  // d is a debug function defined at the end of this file
			$uid = null;
		}
	}

    function d($d){
        //echo '<pre>';
        //print_r($d);
        //echo '</pre>';
    }
?>
