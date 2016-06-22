<?php
/*
Plugin Name: dodder-facebook-like
Plugin URI: https://github.com/tolkadot/plugins
Description: simple facebook like button for blog posts
Version: 1.0
Author: Dee Bryant
Author URI: http://tolkadot.com
*/


function facebook_like_button($content) {
	
	$current_url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];       
      
      
     if (is_home() || is_single()) {  
     $content .= '   
                     <div id="fb-root"></div>
            <script>(function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.6";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, \'script\', \'facebook-jssdk\'));
                </script>
  
  <div class="fb-like" data-href="'.	$current_url.' " data-layout="button" data-action="like" data-show-faces="false" data-share="false"></div>
                    '; 
}
   
       
        return $content;  
    }
add_action('the_content','facebook_like_button');
