<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="https://www.facebook.com/2008/fbml"><head>
    
	 	<meta property="fb:admins" content="637008951"/>
		<meta property="og:title" content="Powerade Wristband" /> 
		<meta property="og:type" content="website"/>
		<meta property="og:url" content="http://apps.facebook.com/social-wristaband"/>
		<meta property="og:image" content="http://www.appsbond.cl//appsbond.cl/html/powerade/tabs/test-rfid/compartelo.jpg"/>
		<meta property="og:description" content=""/>

		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>
		<script type="text/javascript" src="https://connect.facebook.net/en_US/all.js/es_LA"></script>		
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
		<script type="text/javascript">
			//This example uses static publishing with swfObject. Login is handled in the swf.
						
			//Note that the inner object tag requires an id and name attribute with the same value, and that its different from the outer object tag id. 
			//This 'name' attribute is REQUIRED for Chrome/Mozilla browsers. 
					
		</script>
        <script type="text/javascript">
		
			function redirect(id,perms,uri) {
     			var params = window.location.toString().slice(window.location.toString().indexOf('?'));
     			top.location = 'https://graph.facebook.com/oauth/authorize?client_id='+id+'&scope='+perms+'&redirect_uri='+uri+params;				 
			}

			function shareTWP(obj){
				var url = obj;
		    	var text = 'Lipsum Pumum';
		    	window.open('http://twitter.com/share?text='+encodeURIComponent(text)+'&url='+encodeURIComponent(url),'sharer','toolbar=0,status=0,width=626,height=436');
			}
			
			function shareFBPost(img){
			
		  	FB.ui({method: 'stream.publish',
		       message: '',
		       dialog: 'popup',
		       attachment: {
		         name: '',
		         description: "Comparte la aplicaci&oacute;n en tu muro para que tus amigos tambi&eacute;n puedan enviar su chamullo perfecto, y celebren el triunfo de la roja",
				 link: 'http://apps.facebook.com/social-wristaband/',
		         media: [{ 'type': 'image', 'src': img, 'href': 'http://apps.facebook.com/social-wristaband/'}],
		         href: 'http://apps.facebook.com/social-wristaband/'
		       },
		       action_links: [
		         { text: 'PUMA - Chamullo', href: 'http://apps.facebook.com/social-wristaband/' }
		         ],
		        user_prompt_message: ''
		     }, function(response){ 
					if (response.post_id != '') {
						trackEvent("Experiencia", "Compartir en Muro", "Compartir Exitoso");
					}
				});
			}
			
			
		</script>
        <!-- Customized functions Google Analytics -->
		<script type="text/javascript">
		function trackPageview(page) {
			try {
			_gaq.push(['_trackPageview', page]);
			} catch(err) {}
			}
		
		function trackEvent(cat,act,lbl,val) {
			try {
			_gaq.push(['_trackEvent', cat,act,lbl,val]);
			} catch(err) {}
			}
		</script>	
        
    <style type="text/css">
    body {
		padding:0;
		margin:0;
		background-color:#FFFFFF;
	}
	#flashDiv{
		width:760px;
		height:1000px;
	}
    </style>
  </head>
<body>
	<div id="fb-root"></div>
	<div id="flashDiv">	
		
	</div>  
    	<script> 
			var flashvars = {};
			flashvars.rfid = '<?php echo $_GET['app_data'] ?>';
			swfobject.embedSWF('Preload.swf', 'flashDiv', '810', '800', '10.0.0', '', flashvars, { wmode: 'opaque', 'allowscriptaccess': 'always'} , {name: 'flashDiv'} );
		</script>	
</body>


</html>
