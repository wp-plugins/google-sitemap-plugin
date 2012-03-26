<?php
/*
Plugin Name: Google sitemap plugin
Plugin URI:  http://bestwebsoft.com/plugin/
Description: Plugin to add google sitemap file in google webmaster tools account.
Author: BestWebSoft
Version: 1.06
Author URI: http://bestwebsoft.com/
License: GPLv2 or later
*/

/*  © Copyright 2011  BestWebSoft  ( admin@bestwebsoft.com )

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

//============================================ Function for adding style ====================
if( ! function_exists( 'gglstmp_add_my_stylesheet' ) ) {
	function gglstmp_add_my_stylesheet() {
		wp_register_style( 'google-sitemap-StyleSheets', plugins_url( 'css/stylesheet.css', __FILE__ ) );
		wp_enqueue_style( 'google-sitemap-StyleSheets' );
	}
}

//============================================ Function for adding page in admin menu ====================
if( ! function_exists( 'bws_add_menu_render' ) ) {
	function bws_add_menu_render() {
		global $title;
		$active_plugins = get_option('active_plugins');
		$all_plugins		= get_plugins();

		$array_activate = array();
		$array_install	= array();
		$array_recomend = array();
		$count_activate = $count_install = $count_recomend = 0;
		$array_plugins	= array(
			array( 'captcha\/captcha.php', 'Captcha', 'http://wordpress.org/extend/plugins/captcha/', 'http://bestwebsoft.com/plugin/captcha-plugin/', '/wp-admin/plugin-install.php?tab=search&type=term&s=Captcha+bestwebsoft&plugin-search-input=Search+Plugins', 'admin.php?page=captcha.php' ), 
			array( 'contact-form-plugin\/contact_form.php', 'Contact Form', 'http://wordpress.org/extend/plugins/contact-form-plugin/', 'http://bestwebsoft.com/plugin/contact-form/', '/wp-admin/plugin-install.php?tab=search&type=term&s=Contact+Form+bestwebsoft&plugin-search-input=Search+Plugins', 'admin.php?page=contact_form.php' ), 
			array( 'facebook-button-plugin\/facebook-button-plugin.php', 'Facebook Like Button Plugin', 'http://wordpress.org/extend/plugins/facebook-button-plugin/', 'http://bestwebsoft.com/plugin/facebook-like-button-plugin/', '/wp-admin/plugin-install.php?tab=search&type=term&s=Facebook+Like+Button+Plugin+bestwebsoft&plugin-search-input=Search+Plugins', 'admin.php?page=facebook-button-plugin.php' ), 
			array( 'twitter-plugin\/twitter.php', 'Twitter Plugin', 'http://wordpress.org/extend/plugins/twitter-plugin/', 'http://bestwebsoft.com/plugin/twitter-plugin/', '/wp-admin/plugin-install.php?tab=search&type=term&s=Twitter+Plugin+bestwebsoft&plugin-search-input=Search+Plugins', 'admin.php?page=twitter.php' ), 
			array( 'portfolio\/portfolio.php', 'Portfolio', 'http://wordpress.org/extend/plugins/portfolio/', 'http://bestwebsoft.com/plugin/portfolio-plugin/', '/wp-admin/plugin-install.php?tab=search&type=term&s=Portfolio+bestwebsoft&plugin-search-input=Search+Plugins', '' ),
			array( 'gallery-plugin\/gallery-plugin.php', 'Gallery', 'http://wordpress.org/extend/plugins/gallery-plugin/', 'http://bestwebsoft.com/plugin/gallery-plugin/', '/wp-admin/plugin-install.php?tab=search&type=term&s=Gallery+Plugin+bestwebsoft&plugin-search-input=Search+Plugins', '' ),
			array( 'adsense-plugin\/adsense-plugin.php', 'Google AdSense Plugin', 'http://wordpress.org/extend/plugins/adsense-plugin/', 'http://bestwebsoft.com/plugin/google-adsense-plugin/', '/wp-admin/plugin-install.php?tab=search&type=term&s=Adsense+Plugin+bestwebsoft&plugin-search-input=Search+Plugins', 'admin.php?page=adsense-plugin.php' ),
			array( 'custom-search-plugin\/custom-search-plugin.php', 'Custom Search Plugin', 'http://wordpress.org/extend/plugins/custom-search-plugin/', 'http://bestwebsoft.com/plugin/custom-search-plugin/', '/wp-admin/plugin-install.php?tab=search&type=term&s=Custom+Search+plugin+bestwebsoft&plugin-search-input=Search+Plugins', 'admin.php?page=custom_search.php' ),
			array( 'quotes_and_tips\/quotes-and-tips.php', 'Quotes and Tips', 'http://wordpress.org/extend/plugins/quotes-and-tips/', 'http://bestwebsoft.com/plugin/quotes-and-tips/', '/wp-admin/plugin-install.php?tab=search&type=term&s=Quotes+and+Tips+bestwebsoft&plugin-search-input=Search+Plugins', 'admin.php?page=quotes-and-tips.php' )
		);
		foreach($array_plugins as $plugins) {
			if( 0 < count( preg_grep( "/".$plugins[0]."/", $active_plugins ) ) ) {
				$array_activate[$count_activate]['title'] = $plugins[1];
				$array_activate[$count_activate]['link']	= $plugins[2];
				$array_activate[$count_activate]['href']	= $plugins[3];
				$array_activate[$count_activate]['url']	= $plugins[5];
				$count_activate++;
			}
			else if( array_key_exists(str_replace("\\", "", $plugins[0]), $all_plugins) ) {
				$array_install[$count_install]['title'] = $plugins[1];
				$array_install[$count_install]['link']	= $plugins[2];
				$array_install[$count_install]['href']	= $plugins[3];
				$count_install++;
			}
			else {
				$array_recomend[$count_recomend]['title'] = $plugins[1];
				$array_recomend[$count_recomend]['link']	= $plugins[2];
				$array_recomend[$count_recomend]['href']	= $plugins[3];
				$array_recomend[$count_recomend]['slug']	= $plugins[4];
				$count_recomend++;
			}
		}
		?>
		<div class="wrap">
			<div class="icon32 icon32-bws" id="icon-options-general"></div>
			<h2><?php echo $title;?></h2>
			<?php if( 0 < $count_activate ) { ?>
			<div>
				<h3><?php _e( 'Activated plugins', 'sitemap' ); ?></h3>
				<?php foreach( $array_activate as $activate_plugin ) { ?>
				<div style="float:left; width:200px;"><?php echo $activate_plugin['title']; ?></div> <p><a href="<?php echo $activate_plugin['link']; ?>" target="_blank"><?php echo __( "Read more", 'sitemap'); ?></a> <a href="<?php echo $activate_plugin['url']; ?>"><?php echo __( "Settings", 'sitemap'); ?></a></p>
				<?php } ?>
			</div>
			<?php } ?>
			<?php if( 0 < $count_install ) { ?>
			<div>
				<h3><?php _e( 'Installed plugins', 'sitemap' ); ?></h3>
				<?php foreach($array_install as $install_plugin) { ?>
				<div style="float:left; width:200px;"><?php echo $install_plugin['title']; ?></div> <p><a href="<?php echo $install_plugin['link']; ?>" target="_blank"><?php echo __( "Read more", 'sitemap'); ?></a></p>
				<?php } ?>
			</div>
			<?php } ?>
			<?php if( 0 < $count_recomend ) { ?>
			<div>
				<h3><?php _e( 'Recommended plugins', 'sitemap' ); ?></h3>
				<?php foreach( $array_recomend as $recomend_plugin ) { ?>
				<div style="float:left; width:200px;"><?php echo $recomend_plugin['title']; ?></div> <p><a href="<?php echo $recomend_plugin['link']; ?>" target="_blank"><?php echo __( "Read more", 'sitemap'); ?></a> <a href="<?php echo $recomend_plugin['href']; ?>" target="_blank"><?php echo __( "Download", 'sitemap'); ?></a> <a class="install-now" href="<?php echo get_bloginfo( "url" ) . $recomend_plugin['slug']; ?>" title="<?php esc_attr( sprintf( __( 'Install %s' ), $recomend_plugin['title'] ) ) ?>" target="_blank"><?php echo __( 'Install now from wordpress.org', 'sitemap' ) ?></a></p>
				<?php } ?>
				<span style="color: rgb(136, 136, 136); font-size: 10px;"><?php _e( 'If you have any questions, please contact us via plugin@bestwebsoft.com or fill in our contact form on our site', 'sitemap' ); ?> <a href="http://bestwebsoft.com/contact/">http://bestwebsoft.com/contact/</a></span>
			</div>
			<?php } ?>
		</div>
		<?php
	}
}

//============================================ Function for adding menu and submenu ====================
if( ! function_exists( 'gglstmp_add_pages' ) ) {
	function gglstmp_add_pages() {
		add_menu_page( __( 'BWS Plugins', 'sitemap' ), __( 'BWS Plugins', 'sitemap' ), 'manage_options', 'bws_plugins', 'bws_add_menu_render', WP_CONTENT_URL."/plugins/google-sitemap-plugin/images/px.png", 1001); 
		add_submenu_page( 'bws_plugins', __( 'Google Sitemap Options', 'sitemap' ), __( 'Google Sitemap', 'sitemap' ), 'manage_options', "google-sitemap-plugin.php", 'gglstmp_settings_page');
		
		global $url_home;
		global $url;
		global $url_send;
		global $url_send_sitemap;
		$url_home = home_url();
		$url = urlencode( $url_home . "/" );
		$url_send = "https://www.google.com/webmasters/tools/feeds/sites/";
		$url_send_sitemap = "https://www.google.com/webmasters/tools/feeds/";
	}
}

//============================================ Function for creating sitemap file ====================
if( ! function_exists( 'gglstmp_sitemapcreate' ) ) {
	function gglstmp_sitemapcreate() {
		global $wpdb; 
		$loc = $wpdb->get_results( "SELECT ID,post_modified,post_status,post_type,ping_status FROM wp_posts WHERE post_status = 'publish' AND ping_status = 'open' AND post_type <> 'nav_menu_item'" );
		$xml = new DomDocument('1.0','utf-8');
		$xml_stylesheet_path = "wp-content/plugins/google-sitemap-plugin/sitemap.xsl";
		$xslt = $xml->createProcessingInstruction( 'xml-stylesheet', "type=\"text/xsl\" href=\"$xml_stylesheet_path\"" );
		$xml->appendChild($xslt);
		$urlset = $xml->appendChild( $xml->createElementNS( 'http://www.sitemaps.org/schemas/sitemap/0.9','urlset' ) );
		foreach( $loc as $val ) {
			$url = $urlset->appendChild( $xml->createElement( 'url' ) );
			$loc = $url->appendChild( $xml->createElement( 'loc' ) );
			$permalink = get_permalink( $val->ID );
			$loc->appendChild( $xml->createTextNode( $permalink ) );
			$lastmod = $url->appendChild( $xml->createElement( 'lastmod' ) );
			$now = $val->post_modified;
			$date = date( 'Y-m-d\TH:i:sP', strtotime( $now ) );
			$lastmod->appendChild( $xml -> createTextNode( $date ) );
			$changefreq = $url -> appendChild( $xml->createElement( 'changefreq' ) );
			$changefreq->appendChild( $xml->createTextNode( 'monthly' ) );
			$priority = $url->appendChild( $xml->createElement( 'priority' ) );
			$priority->appendChild( $xml->createTextNode( 1.0 ) );
		}
		$xml->formatOutput = true;
		$xml->save( ABSPATH . 'sitemap.xml' );		
	}
}

//============================================ Function for creating setting page ====================
if ( !function_exists ( 'gglstmp_settings_page' ) ) {
	function gglstmp_settings_page () {
		global $url_home;
		global $url;
		$url_robot = ABSPATH . "robots.txt";
		$url_sitemap = ABSPATH . "sitemap.xml";
		$message = "";
		if( $_POST['new'] ) {
			$message =  "<p>".__( "Your sitemap file was created in the root directory of the site. ", 'sitemap' )."</p>";
			gglstmp_sitemapcreate();
		}
		?>
		<div class="wrap">
			<div class="icon32 icon32-bws" id="icon-options-general"></div>
			<h2><?php _e( "Google Sitemap options", 'sitemap' ); ?></h2>
			<div class="updated fade" <?php if( ! isset( $_REQUEST['new'] ) ) echo "style=\"display:none\""; ?>><p><strong><?php echo $message; ?></strong></p></div>
			<?php //=============================== Creating sitemap file ====================================
			if( file_exists( $url_sitemap ) ) {
				echo "<p>". __( "The sitemap file is already exists. If you want to change it for a new sitemap file check the necessary box below. In other case all actions will be performed over an existing file.", 'sitemap' ) . "</p>";
			}
			else {
				gglstmp_sitemapcreate();
				echo "<p>".__( "Your sitemap file was created in the root directory of the site. ", 'sitemap' ) . "</p>";	
			}
			//========================================== Recreating sitemap file ====================================				
			echo "<p>". __( "If you don't want to add this file automatically you may go through", 'sitemap' ) . " <a href=\"https://www.google.com/webmasters/tools/home?hl=en\">". __( "this", 'sitemap' ) . "</a> ". __( "link, sign in, select necessary site, select 'Sitemaps' and type in necessary field", 'sitemap' ) ." - '". $url_home."/sitemap.xml'.</p>";
			if ( function_exists( 'curl_init' ) ) {
				echo "<p>". __( "This hosting doesn't support CURL, so you can't add sitemap file automatically", 'sitemap' ). "</p>";	
				$curl_exist = 0;
			}
			else {
				$curl_exist = 1;
			}?>
			<form action="admin.php?page=google-sitemap-plugin.php" method='post' id="gglstmp_auth" name="gglstmp_auth">
				<p id="gglstmp_new_sitemap">
					<input type='checkbox' name='new'> <?php _e( "I want to create new sitemap file", 'sitemap' );	?>
				</p>
				<p id="gglstmp_robot">
					<input type='checkbox' name='ch1_robots'> <?php _e( "I want to add sitemap file path in robots.txt", 'sitemap' );	?>
				</p>
				<?php 
				if ( $curl_exist == 1 ) {
					echo "<p>". __( "Type here your login and password from google webmaster tools account to add or delete site and sitemap file automatically or to get information about this site in google webmaster tools.", 'sitemap' ) . "</p>";
				?>
				<p id="gglstmp_login">
					<label for='email'><?php _e( "Login* :", 'sitemap' );	?></label>
					<input type='text' name='email'><br/>
				</p>
				<p id="gglstmp_pass">
					<label for='passwd'><?php _e( "Password* :", 'sitemap' );	?></label>
					<input type='password' name='passwd'> <br/>
				</p>
				<p id="gglstmp_add_menu">
					<input type='radio' name='menu' value="ad"> <?php _e( "I want to add this site to the google webmaster tools", 'sitemap' );	?>
				</p>
				<p id="gglstmp_del_menu">
					<input type='radio' name='menu' value="del"> <?php _e( "I want to delete this site from google webmaster tools", 'sitemap' );	?>
				</p>
				<p id="gglstmp_info">
					<input type='radio' name='menu' value="inf"> <?php _e( "I want to get info about this site in google webmaster tools", 'sitemap' );	?>
				</p>
				<?php } ?>
				<p class="submit">
					<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
				</p>
			</form>
		</div>
		<?php
		//============================ Adding location of sitemap file to the robots.txt =============
		if( $_POST['ch1_robots'] ){
			if ( file_exists( $url_robot ) ) {		
				$fp = fopen( ABSPATH . 'robots.txt', "a+" );
				fwrite($fp, "\nSitemap: " . $url_home . "/sitemap.xml\n" );
				fclose ( $fp ); 
			}
			else{
				$fp = fopen( ABSPATH . 'robots.txt', "a+" );
				fwrite( $fp, "# User-agent: *\n
# Disallow: /wp-admin/\n 
# Disallow: /wp-includes/\n
# Disallow: /wp-trackback\n
# Disallow: /wp-feed\n
# Disallow: /wp-comments\n
# Disallow: /wp-content/plugins\n
# Disallow: /wp-content/themes\n
# Disallow: /wp-login.php\n
# Disallow: /wp-register.php\n
# Disallow: /feed\n
# Disallow: /trackback\n
# Disallow: /cgi-bin\n
# Disallow: /comments\n
# Disallow: *?s=
\nSitemap: " . $url_home . "/sitemap.xml" );
				fclose ($fp);
			}
		}
		//================================ Different checks for the valid entering data ===================
		if( ( ( $_POST['email'] ) && ( $_POST['passwd'] ) ) && ( ( $_POST['menu'] != "ad" ) && ( $_POST['menu'] != "del" ) && ( $_POST['menu'] != "inf" ) ) ) {
		?>
			<script type = "text/javascript"> alert( "<?php _e( 'You must choose at least one action', 'sitemap' );	?>" ) </script>
		<?php
		}
		else{
			if( ( ( !$_POST['email'] ) || ( !$_POST['passwd'] ) ) && ( ( $_POST['menu'] == "ad" ) || ( $_POST['menu'] == "del" ) || ( $_POST['menu'] == "inf" ) ) ) {
				?> <script type = "text/javascript"> alert( "<?php _e( 'You must enter login and password', 'sitemap' );	?>" ) </script>
			<?php
			}
			else{	
			// =================== Connecting to the google account =================
				$data = array( 'accountType' => 'GOOGLE',
					'Email' => $_POST['email'],
					'Passwd' => $_POST['passwd'],
					'source' =>'PHI-cUrl-Example',
					'service' =>'sitemaps'
				);  
				$ch = curl_init();    
				curl_setopt( $ch, CURLOPT_URL, "https://www.google.com/accounts/ClientLogin" );	
				curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0 );  
				curl_setopt( $ch, CURLOPT_POST, true );  
				curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );  
				curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );  
				curl_setopt( $ch,  CURLOPT_UNRESTRICTED_AUTH, true ); 
				$hasil = curl_exec( $ch );
				curl_close( $ch );
				$httpResponseAr = explode( "\n", $hasil );
				$httpParsedResponseAr = array();
				foreach ( $httpResponseAr as $i => $rVal ) {
					list( $qKey, $qVal ) = explode ( "=", $rVal );
					$httpParsedResponseAr[$qKey] = $qVal;
				}
				$au = $httpParsedResponseAr["Auth"];
				if ( ( !$au ) && ( $_POST['email'] ) && ( $_POST['passwd'] ) ) {
				?>
					<script type = "text/javascript"> alert( "<?php _e( "Login and password don\'t match, try again, please", 'sitemap' );	?>" ) </script>
				<?php
				}
				else {
					if( $_POST['menu'] == "inf" ) {
						gglstmp_info_site( $au );//getting info about the site in google webmaster tools account
					}
					else if( $_POST['menu'] == "ad" ) {
						gglstmp_add_site( $au ); //adding site and verifying its ownership
						gglstmp_add_sitemap( $au );//adding sitemap file to the google webmaster tools account
					}
					else if( $_POST['menu'] == "del" ) {
						gglstmp_del_site( $au );//deleting site from google webmaster tools
					}
				}	
			}
		}
	}
}

//============================================ Curl function ====================
if( ! function_exists( 'gglstmp_curl_funct' ) ) {
	function gglstmp_curl_funct( $au, $url_send, $type_request, $content ) {
		$headers  =  array ( "Content-type: application/atom+xml; charset=\"utf-8\"",
			"Authorization: GoogleLogin auth=" . $au
		);
		$chx = curl_init(); 
		curl_setopt( $chx, CURLOPT_URL, $url_send );
		curl_setopt( $chx, CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $chx, CURLOPT_SSL_VERIFYPEER, 0 );
		curl_setopt( $chx, CURLOPT_RETURNTRANSFER, true );
		if ( $type_request == "GET" ) {
			curl_setopt( $chx, CURLOPT_HTTPGET, true );
		}
		if ( $type_request == "POST" ) {
			curl_setopt( $chx, CURLOPT_POST, true );
			curl_setopt( $chx, CURLOPT_POSTFIELDS, $content );
		}
		if ( $type_request == "DELETE" ) {
			curl_setopt( $chx, CURLOPT_CUSTOMREQUEST, 'DELETE' );
		}
		if ( $type_request == "PUT" ) {
			curl_setopt( $chx, CURLOPT_CUSTOMREQUEST, 'PUT' );
			curl_setopt( $chx, CURLOPT_POSTFIELDS, $content );
		}
		$hasilx = curl_exec( $chx );
		curl_close( $chx );
		return $hasilx;
	}
}

//============================================ Function to get info about site ====================
if( ! function_exists( 'gglstmp_info_site' ) ) {	
	function gglstmp_info_site( $au ) {
		global $url_home;
		global $url;
		global $url_send;
		global $url_send_sitemap;
		$hasilx = gglstmp_curl_funct( $au, $url_send . $url, "GET", false );
		//========================= Getting info about site in google webmaster tools ====================
		echo "<h2><br />". __( "Info about this site in google webmaster tools", 'sitemap') ."</h2><br />";
		if ( $hasilx == "Site not found" ) {
			echo __( "This site is not added to the google webmaster tools account", 'sitemap');
		}
		else {
			$hasils = gglstmp_curl_funct( $au, $url_send . $url, "GET", false );
			echo "<pre>";
			$p = xml_parser_create();
			xml_parse_into_struct( $p, $hasils, $vals, $index );
			xml_parser_free( $p );  
			  foreach ( $vals as $val ) {
			  if( $val["tag"] == "WT:VERIFIED" )
					$ver = $val["value"];
				}
			$hasils = gglstmp_curl_funct( $au, $url_send_sitemap . $url . "/sitemaps/", "GET", false );
			echo "<pre>";
			$p = xml_parser_create();
			xml_parse_into_struct( $p, $hasils, $vals, $index );
			xml_parser_free( $p );  
			foreach ( $vals as $val ) {
			if( "WT:SITEMAP-STATUS" == $val["tag"] )
				$sit = $val["value"];
			}
			echo __( "Site url: ", 'sitemap') . $url_home . "<br />";
			echo __( "Site verification: ", 'sitemap'); 
			if( "true" == $ver ) 
				echo __( "verificated", 'sitemap') . "<br />"; 
			else 
				echo __( "non verificated", 'sitemap') . "<br />";
			echo __( "Sitemap file: ", 'sitemap');
			if( $sit ) 
				echo __( "added", 'sitemap') . "<br />"; 
			else 
				echo __( "not added", 'sitemap') . "<br />";
		}
	}
}

//============================================ Deleting site from google webmaster tools ====================
if( ! function_exists( 'gglstmp_del_site' ) ) {
	function gglstmp_del_site( $au ) {
		global $url, $url_send;
		$hasil3 = gglstmp_curl_funct( $au, $url_send. $url, "DELETE", false );
	}
}

//============================================ Adding site to the google webmaster tools ====================
if( ! function_exists( 'gglstmp_add_site' ) ) {
	function gglstmp_add_site( $au ) {
		global $url_home, $url, $url_send;
		$content = "<atom:entry xmlns:atom=\"http://www.w3.org/2005/Atom\" xmlns:wt=\"http://schemas.google.com/webmasters/tools/2007\">"
		 ."<atom:content src=\"" . $url_home . "\" />"
		 ."</atom:entry>\n";
		$hasil1 = gglstmp_curl_funct( $au, $url_send, "POST", $content );
		preg_match( '/(google)[a-z0-9]*\.html/', $hasil1, $matches );
		//===================== Creating html file for verifying site ownership ====================
		$m1="../" . $matches[0];
		if( ! ( file_exists ( $m1 ) ) ) {
		$fp = fopen ("../" . $matches[0], "w+" );
		fwrite( $fp, "google-site-verification: " . $matches[0] );
		fclose ( $fp );
		}
		//============================= Verifying site ownership ====================
		$content  = "<atom:entry xmlns:atom=\"http://www.w3.org/2005/Atom\" xmlns:wt=\"http://schemas.google.com/webmasters/tools/2007\">"
		."<atom:category scheme='http://schemas.google.com/g/2005#kind' term='http://schemas.google.com/webmasters/tools/2007#site-info'/>"
		."<wt:verification-method type=\"htmlpage\" in-use=\"true\"/>"
		."</atom:entry>";
		$hasil2 = gglstmp_curl_funct( $au, $url_send. $url, "PUT", $content );
	}
}

//============================================ Adding sitemap file ====================
if( ! function_exists( 'gglstmp_add_sitemap' ) ) {
	function gglstmp_add_sitemap( $au ) {
		global $url_home;
		global $url;
		global $url_send_sitemap;
		$content  = "<atom:entry xmlns:atom=\"http://www.w3.org/2005/Atom\" xmlns:wt=\"http://schemas.google.com/webmasters/tools/2007\">"
		."<atom:id>" . $url_home . "/sitemap.xml</atom:id>"
		."<atom:category scheme=\"http://schemas.google.com/g/2005#kind\" term=\"http://schemas.google.com/webmasters/tools/2007#sitemap-regular\"/>"
		."<wt:sitemap-type>WEB</wt:sitemap-type>"
		."</atom:entry>";
		$hasil1 = gglstmp_curl_funct( $au, $url_send_sitemap . $url . "/sitemaps/", "POST", $content );
	}
}

//============================================ Adding setting link in activate plugin page ====================
if( ! function_exists( 'gglstmp_action_links' ) ) {
	function gglstmp_action_links( $links, $file ) {
		//Static so we don't call plugin_basename on every plugin row.
		static $this_plugin;
		if ( ! $this_plugin ) 
			$this_plugin = plugin_basename( __FILE__ );
		if ( $file == $this_plugin ) {
			 $settings_link = '<a href="admin.php?page=google-sitemap-plugin.php">' . __( 'Settings', 'sitemap' ) . '</a>';
			 array_unshift( $links, $settings_link );
		}
		return $links;
	}
}

if ( ! function_exists ( 'gglstmp_plugin_init' ) ) {
	function gglstmp_plugin_init() {
		load_plugin_textdomain( 'sitemap', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' ); 
	}
}

add_action( 'wp_head', 'gglstmp_add_my_stylesheet' );
add_action( 'admin_head', 'gglstmp_add_my_stylesheet' );
add_action( 'admin_init', 'gglstmp_plugin_init' );
add_action( 'admin_menu', 'gglstmp_add_pages' );
add_filter( 'plugin_action_links', 'gglstmp_action_links', 10, 2 );
?>