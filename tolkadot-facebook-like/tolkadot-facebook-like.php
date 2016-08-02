<?php
/*
Plugin Name: dodder-facebook-like
Plugin URI: https://github.com/tolkadot/plugins
Description: simple facebook like button for blog posts
Version: 1.0
Author: Dee Bryant
Author URI: http://tolkadot.com
*/
function tolkadot_facebook_activation() {
}
register_activation_hook(__FILE__, 'tolkadot_facebook_activation');

function tolkadot_facebook_deactivation() {
}
register_deactivation_hook(__FILE__, 'tolkadot_facebook_deactivation');



add_action('admin_menu' , tolkadot_facebook_menu); /*this adds the admin end of the plugin*/

/*add_menu_page is a function that adds my plugin into the admin toolbar on the left
I could also use add_meun_options() which would add it under settings */
function tolkadot_facebook_menu() {
    
    add_menu_page('Facebook Link Settings', 'Facebook Link', 'manage_options', 'facebook-settings', 'facebook_settings_page', 'dashicons-facebook');
}

/*here we are defining the facebook_settings_page() function or how the page will look - this function is called as an option in add_menu_page(); */


function facebook_settings_page() {
?>
<div class="wrap">
<h2>Tolkadot plugin Facebook Link Options</h2>

<form method="post" action="options.php">
    <?php settings_fields( 'tweetlink_settings' ); ?> 
    <!-- the option for settings_fields needs to match the group name in register_setting below-->
    <?php do_settings_sections( 'tweetlink_settings' ); ?>
    <table class="form-table">        
        <tr valign="top">
        <th scope="row">Twitter Account</th>
        <td><input type="text" name="twitter_account" value="<?php echo esc_attr( get_option('twitter_account') ); ?>" /></td>
        </tr>
    </table>
    
 <?php echo get_option( 'twitter_account' ); ?>
    
    <?php submit_button(); ?>

</form>
</div>

<?php
}

add_action( 'admin_init', 'tweetlink_settings' );

function tweetlink_settings() {
	register_setting( 'tweetlink_settings', 'twitter_account' );
}



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
add_action('the_content','facebook_like_button');
