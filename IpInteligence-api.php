<?php
/*
    Plugin Name: IpInteligence API
    Plugin URI: https://getipintel.net/
    Description: Protect your WordPress Site from unwanted access attempts, by IP reputation data provided by the GetIntelIp service. BAD IP, High Risk IP, TOR, VPN, Geo IP. XMLRPC disabler, WP-login and protect contact pages.
    Author: Me
    Version: 1.0.4
    License: GPL-2.0+
    License URI: http://www.gnu.org/licenses/gpl-2.0.txt
*/

defined( 'ABSPATH' ) or die( 'Nope, not accessing this' );


add_action( 'admin_menu', 'tp_api_add_admin_menu' );
function tp_api_add_admin_menu(  ) {
    add_options_page( 'IpInteligence API', 'IpInteligence API', 'manage_options', 'IpInteligence-api-page', 'tp_api_options_page' );
}

add_action( 'admin_init', 'tp_api_settings_init' );
function tp_api_settings_init(  ) {
    register_setting( 'tpPlugin', 'tp_api_settings' );
    add_settings_section(
        'tp_api_tpPlugin_section',
        __( '', 'wordpress' ),
        'tp_api_settings_section_callback',
        'tpPlugin'
    );

    add_settings_field(
        'tp_api_text_field_0',
        __( 'API Subdomain', 'wordpress' ),
        'tp_api_text_field_0_render',
        'tpPlugin',
        'tp_api_tpPlugin_section'
    );

    add_settings_field(
        'tp_api_select_field_1',
        __( 'Country Blacklist', 'wordpress' ),
        'tp_api_select_field_1_render',
        'tpPlugin',
        'tp_api_tpPlugin_section'
    );

    add_settings_field(
        'tp_api_select_field_4',
        __( 'Country Whitelist', 'wordpress' ),
        'tp_api_select_field_4_render',
        'tpPlugin',
        'tp_api_tpPlugin_section'
    );

    add_settings_field(
        'tp_api_select_field_2',
        __( 'Redirection URL', 'wordpress' ),
        'tp_api_select_field_2_render',
        'tpPlugin',
        'tp_api_tpPlugin_section'
    );

    add_settings_field(
        'tp_api_select_field_3',
        __( 'Reject IP Risk >=', 'wordpress' ),
        'tp_api_select_field_3_render',
        'tpPlugin',
        'tp_api_tpPlugin_section'
    );

    add_settings_field(
        'tp_api_select_field_5',
        __( 'Reject BAD IP', 'wordpress' ),
        'tp_api_select_field_5_render',
        'tpPlugin',
        'tp_api_tpPlugin_section'
    );

    add_settings_field(
        'tp_api_select_field_6',
        __( 'IP to Bypass (Comma separated list)', 'wordpress' ),
        'tp_api_select_field_6_render',
        'tpPlugin',
        'tp_api_tpPlugin_section'
    );

    add_settings_field(
        'tp_api_select_field_7',
        __( 'Pages to check (Comma separated list)', 'wordpress' ),
        'tp_api_select_field_7_render',
        'tpPlugin',
        'tp_api_tpPlugin_section'
    );

    add_settings_field(
        'tp_api_select_field_8',
        __( 'Disable XMLRPC endpoint', 'wordpress' ),
        'tp_api_select_field_8_render',
        'tpPlugin',
        'tp_api_tpPlugin_section'
    );

    add_settings_field(
        'tp_api_select_field_9',
        __( 'Enable Mail Notifications', 'wordpress' ),
        'tp_api_select_field_9_render',
        'tpPlugin',
        'tp_api_tpPlugin_section'
    );

    add_settings_field(
        'tp_api_select_field_10',
        __( 'Email Address to Notify', 'wordpress' ),
        'tp_api_select_field_10_render',
        'tpPlugin',
        'tp_api_tpPlugin_section'
    );

}

function tp_api_text_field_0_render(  ) {
    $options = get_option( 'tp_api_settings' );
    ?>
    <input type='text' name='tp_api_settings[tp_api_text_field_0]' value='<?php echo $options['tp_api_text_field_0']; ?>'>
    <?php echo '<b>&#8505 An API subdomain is required - contact getipintel@gmail.com</b>'; ?>
    <?php
}

function tp_api_select_field_1_render(  ) {
    $options = get_option( 'tp_api_settings' );
    ?>
    <input type='text' name='tp_api_settings[tp_api_text_field_1]' value='<?php echo $options['tp_api_text_field_1']; ?>'>
    <?php echo '<b>&#8505 Countries to block, comma separated 2 char ISO codes.</b>'; ?>
    <?php
}

function tp_api_select_field_2_render(  ) {
    $options = get_option( 'tp_api_settings' );
    ?>
    <input type='text' size=50 name='tp_api_settings[tp_api_text_field_2]' value='<?php echo $options['tp_api_text_field_2']; ?>'>
    <?php echo '<b>&#8505 Redirection URL - This needs to be set to redirect the blocked access attempt.</b>'; ?>
    <?php
}

function tp_api_select_field_3_render(  ) {
    $options = get_option( 'tp_api_settings' );
    ?>
    <select name='tp_api_settings[tp_api_select_field_3]'>
        <option value='1' <?php selected( $options['tp_api_select_field_3'], 1 ); ?>>High</option>
        <option value='2' <?php selected( $options['tp_api_select_field_3'], 2 ); ?>>Consider</option>
        <option value='3' <?php selected( $options['tp_api_select_field_3'], 3 ); ?>>Low</option>
    </select>
    <?php echo '<b>&#8505 Reject IP risk based on rating.</b>'; ?>
    <?php
}

function tp_api_select_field_4_render(  ) {
    $options = get_option( 'tp_api_settings' );
    ?>
    <input type='text' name='tp_api_settings[tp_api_text_field_4]' value='<?php echo $options['tp_api_text_field_4']; ?>'>
    <?php echo '<b>&#8505 Countries to allow, comma separated 2 char ISO codes.</b>'; ?>
    <?php
}


function tp_api_select_field_5_render(  ) {
    $options = get_option( 'tp_api_settings' );
    ?>
    <select name='tp_api_settings[tp_api_select_field_5]'>
        <option value='1' <?php selected( $options['tp_api_select_field_5'], 1 ); ?>>Yes</option>
        <option value='2' <?php selected( $options['tp_api_select_field_5'], 2 ); ?>>No</option>
    </select>
    <?php echo '<b>&#8505 Reject Bad IP.</b>'; ?>
    <?php
}

function tp_api_select_field_6_render(  ) {
    $options = get_option( 'tp_api_settings' );
    ?>
    <input type='text' size=50 name='tp_api_settings[tp_api_text_field_6]' value='<?php echo $options['tp_api_text_field_6']; ?>'>
    <?php echo '<b>&#8505 IP Address to Bypass, comma separated. () i.e. 8.8.8.8,10.10.10.10</b>'; ?>
    <?php
}

function tp_api_select_field_7_render(  ) {
    $options = get_option( 'tp_api_settings' );
    ?>
    <input type='text' size=50 name='tp_api_settings[tp_api_text_field_7]' value='<?php echo $options['tp_api_text_field_7']; ?>'>
    <?php echo '<b>&#8505 Accepts slug name for custom pages (not admin) and is not case sensitive. i.e. contact,application-page. WP-Admin is protected by default and does not need to be included here.</b>'; ?>
    <?php
}

function tp_api_select_field_8_render(  ) {
    $options = get_option( 'tp_api_settings' );
    ?>
    <select name='tp_api_settings[tp_api_select_field_8]'>
        <option value='1' <?php selected( $options['tp_api_select_field_8'], 1 ); ?>>No</option>
        <option value='2' <?php selected( $options['tp_api_select_field_8'], 2 ); ?>>Yes</option>
    </select>
    <?php echo '<b>&#8505 XMLRPC.php is often enabled by default. This is a known attack vector and can be disabled. Requires write access to .htaccess</b>'; ?>
    <?php
}

function tp_api_select_field_9_render(  ) {
    $options = get_option( 'tp_api_settings' );
    ?>
    <select name='tp_api_settings[tp_api_select_field_9]'>
        <option value='1' <?php selected( $options['tp_api_select_field_9'], 1 ); ?>>Yes</option>
        <option value='2' <?php selected( $options['tp_api_select_field_9'], 2 ); ?>>No</option>
    </select>
    <?php echo '<b>&#8505 Email Notifications use wp_mail to send.</b>'; ?>
    <?php
}

function tp_api_select_field_10_render(  ) {
    $options = get_option( 'tp_api_settings' );
    ?>
    <input type='text' name='tp_api_settings[tp_api_text_field_10]' value='<?php echo $options['tp_api_text_field_10']; ?>'>
    <?php echo '<b>&#8505 Enter a valid email address.</b>'; ?>
    <?php
}

function tp_api_settings_section_callback(  ) {
    echo __( '<h1>IP Intelligence Security </h1>', 'wordpress' );
    echo __( '<p></>', 'wordpress' );
    echo __( '<li><b>Enter the information in the sections below to complete the API configuration</b></li><br>', 'wordpress' );
    echo __( '<li><i><b>Email getipintel@gmail.com for an API subdomain </b></i></li><br>', 'wordpress' );
    echo __( '<li><i><b>Documentation:- <a href="https://getipintel.net/free-proxy-vpn-tor-detection-api/">IP Intelligence Documentation</a></b></i></li>', 'wordpress' );
}

function tp_api_options_page(  ) {
    ?>
    <div class='wrap'>
        <form action='options.php' method='post'>

            <h2>IP Intelligence API Configuration</h2>

            <?php
            settings_fields( 'tpPlugin' );
            do_settings_sections( 'tpPlugin' );
            submit_button();
            ?>

        </form>
    </div>
    <?php
}

//Deactivate plugin remove entries from .htaccess

function deactivatetp(){

    require_once(ABSPATH . 'wp-admin/includes/file.php');
    require_once(ABSPATH . 'wp-admin/includes/misc.php');
    $htaccess = get_home_path().".htaccess";
    $lines = array();
    insert_with_markers($htaccess, "IP Intelligence IP", $lines);


    insert_with_markers($htaccess, "IP Intelligence XMLRPC", $lines);


}

register_deactivation_hook( __FILE__, 'deactivatetp' );

function disableXMLRPC(){
    //disable XMLRPC endpoint from
    $DisableXMLRPC = esc_attr( get_option('tp_api_settings')['tp_api_select_field_8']);

    if ($DisableXMLRPC == '2'){
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        require_once(ABSPATH . 'wp-admin/includes/misc.php');
        $htaccess = get_home_path().".htaccess";
        $lines = array();
        $lines[] ="<Files xmlrpc.php>";
        $lines[] ="order deny,allow";
        $lines[] ="deny from all";
        $lines[] ="allow from 181.169.58.73";
        $lines[] ="</Files>";
        insert_with_markers($htaccess, "IP Intelligence XMLRPC", $lines);
    }

    if ($DisableXMLRPC == '1'){
      require_once(ABSPATH . 'wp-admin/includes/file.php');
      require_once(ABSPATH . 'wp-admin/includes/misc.php');
      $htaccess = get_home_path().".htaccess";
      $lines = array();
      insert_with_markers($htaccess, "IP Intelligence XMLRPC", $lines);
    }
}
add_action( 'update_option_tp_api_settings', 'disableXMLRPC' );

add_action( 'login_head', 'get_ipintel_rep');
function get_ipintel_rep() {
    $key = esc_attr( get_option('tp_api_settings')['tp_api_text_field_0']);
    $countryconfig = esc_attr( get_option('tp_api_settings')['tp_api_text_field_1']);
    $redirect = esc_attr( get_option('tp_api_settings')['tp_api_text_field_2']);
    $iprisk = esc_attr( get_option('tp_api_settings')['tp_api_select_field_3']);
    $countrywhite = esc_attr( get_option('tp_api_settings')['tp_api_text_field_4']);
    $bad = esc_attr( get_option('tp_api_settings')['tp_api_select_field_5']);
    $bypasslist = esc_attr( get_option('tp_api_settings')['tp_api_text_field_6']);
    $mailon = esc_attr( get_option('tp_api_settings')['tp_api_select_field_9']);
    $emailaddress = esc_attr( get_option('tp_api_settings')['tp_api_text_field_10']);

    if ($iprisk == '1'){
        $ipriskn = 'High';
        $banOnProbability=0.989;
    }
    if ($iprisk == '2'){
        $ipriskn = 'Consider';
        $banOnProbability=0.85;
    }
    if ($iprisk == '3'){
        $ipriskn = 'Low';
        $banOnProbability=0.65;
    }

    $ip = $_SERVER['REMOTE_ADDR'];

    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }

    $url = 'http://' .$key. '.getipintel.net/check.php?ip=' .$ip. '&contact=' .$emailaddress. '&format=json&flags=f&oflags=cb';

    $arguments = array ('sslverify' => false,
        'headers' => array('X-Api-Key' => $key));

    $response = wp_remote_get( $url );

    if (is_wp_error( $response ) ) {

        echo 'Errors detected!';

    } elseif ($bypasslist !='' and strpos($bypasslist, $ip) !==false) {
        if ($mailon =='1'){
            $to = $emailaddress;
            $subject = 'IP Risk >= Cleared Bypass Ip Access';
            $body = 'IP Risk >= Admin Access Cleared IP ' .$ip. ' by the IP Intelligence Plugin';
            $headers = array('Content-Type: text/html; charset=UTF-8;');
            $sent = @wp_mail($to,$subject,$body,$headers);
        }

    } else {
        $body = wp_remote_retrieve_body( $response );
        $datapoint = json_decode( $body );
        $ipa  = $datapoint->queryIP;
        $risk = $datapoint->result;
        $pais = $datapoint->Country;
        $status = $datapoint->status;
        $query1 = $datapoint->queryFlags;
        $query2 = $datapoint->queryOFlags;
        $query3 = $datapoint->queryFormat;
        $owner = $datapoint->contact;
        $badip = $datapoint->BadIP;
        $rate = floatval($risk);

        if ($bad =='1' and $badip ===1 and $status == 'success') {
            if ($mailon =='1'){
                $to = $emailaddress;
                $subject = 'BAD IP access attempt';
                $body = 'IP Risk >= Admin Access Blocked IP ' .$ipa. ' with risk ' .$risk.  ' from ' .$pais. ' by the IP Intelligence Plugin';
                $headers = array('Content-Type: text/html; charset=UTF-8;');
                $sent = @wp_mail($to,$subject,$body,$headers);
            }
            wp_redirect( $redirect);
        }

        if ($ipriskn == 'High' and $rate > $banOnProbability and $status == 'success') {
            if ($mailon =='1'){
                $to = $emailaddress;
                $subject = 'IP Risk >= Blocked Admin Access';
                $body = 'IP Risk >= Blocked Admin Access IP ' .$ipa. ' with risk ' .$risk.  ' from ' .$pais.' by the IP Intelligence Plugin';
                $headers = array('Content-Type: text/html; charset=UTF-8;');
                $sent = @wp_mail($to,$subject,$body,$headers);
            }
            wp_redirect( $redirect);
        }
        if ($ipriskn == 'High' and $rate < $banOnProbability and $status == 'success') {
            if ($mailon =='1'){
                $to = $emailaddress;
                $subject = 'IP Risk >= Cleared Admin Access';
                $body = 'IP Risk >= Admin Access Cleared IP ' .$ipa. ' with risk ' .$risk.  ' from ' .$pais. ' by the IP Intelligence Plugin';
                $headers = array('Content-Type: text/html; charset=UTF-8;');
                $sent = @wp_mail($to,$subject,$body,$headers);
            }
        }
        if ($ipriskn == 'Consider' and $rate > $banOnProbability and $status == 'success') {
            if ($mailon =='1'){
                $to = $emailaddress;
                $subject = 'IP Risk >= Blocked Admin Access';
                $body = 'IP Risk >= Blocked Admin Access IP ' .$ipa. ' with risk ' .$risk.  ' from ' .$pais.' by the IP Intelligence Plugin';
                $headers = array('Content-Type: text/html; charset=UTF-8;');
                $sent = @wp_mail($to,$subject,$body,$headers);
            }
            wp_redirect( $redirect);
        }
        if ($ipriskn == 'Consider' and $rate < $banOnProbability and $status == 'success') {
            if ($mailon =='1'){
                $to = $emailaddress;
                $subject = 'IP Risk >= Cleared Admin Access';
                $body = 'IP Risk >= Admin Access Cleared IP ' .$ipa. ' with risk ' .$risk.  ' from ' .$pais. ' by the IP Intelligence Plugin';
                $headers = array('Content-Type: text/html; charset=UTF-8;');
                $sent = @wp_mail($to,$subject,$body,$headers);
            }
        }
        if ($ipriskn == 'Low' and $rate > $banOnProbability and $status == 'success') {
            if ($mailon =='1'){
                $to = $emailaddress;
                $subject = 'IP Risk >= Blocked Admin Access';
                $body = 'IP Risk >= Blocked Admin Access IP ' .$ipa. ' with risk ' .$risk.  ' from ' .$pais.' by the IP Intelligence Plugin';
                $headers = array('Content-Type: text/html; charset=UTF-8;');
                $sent = @wp_mail($to,$subject,$body,$headers);
            }
            wp_redirect( $redirect);
        }
        if ($ipriskn == 'Low' and $rate < $banOnProbability and $status == 'success') {
            if ($mailon =='1'){
                $to = $emailaddress;
                $subject = 'IP Risk >= Cleared Admin Access';
                $body = 'IP Risk >= Admin Access Cleared IP ' .$ipa. ' with risk ' .$risk.  ' from ' .$pais. ' by the IP Intelligence Plugin';
                $headers = array('Content-Type: text/html; charset=UTF-8;');
                $sent = @wp_mail($to,$subject,$body,$headers);
            }
        }
        if ($countryconfig !='' and $status == 'success' and strpos($countryconfig, $pais) !==false ) {
            if ($mailon =='1'){
                $to = $emailaddress;
                $subject = 'Blacklisted country access attempt';
                $body = 'IP Risk >= Admin Access Cleared IP ' .$ipa. ' with risk ' .$risk.  ' from ' .$pais. ' by the IP Intelligence Plugin';
                $headers = array('Content-Type: text/html; charset=UTF-8;');
                $sent = @wp_mail($to,$subject,$body,$headers);
            }
            wp_redirect( $redirect);
        }
        if ($countrywhite !='' and $status == 'success' and strpos($countrywhite, $pais) ===false) {
            if ($mailon =='1'){
                $to = $emailaddress;
                $subject = 'Blacklisted country access attempt';
                $body = 'IP Risk >= Admin Access Cleared IP ' .$ipa. ' with risk ' .$risk.  ' from ' .$pais. ' by the IP Intelligence Plugin';
                $headers = array('Content-Type: text/html; charset=UTF-8;');
                $sent = @wp_mail($to,$subject,$body,$headers);
            }
            wp_redirect( $redirect);
        }
        
    }
}

add_action( 'wp_head', 'get_ipintel_rep2',1 );
function get_ipintel_rep2( ) {
    $pageList = esc_attr( get_option('tp_api_settings')['tp_api_text_field_7']);
    $pageArray =explode(',', $pageList);

    foreach ($pageArray as $value){
        if( is_page($value)){
            $key = esc_attr( get_option('tp_api_settings')['tp_api_text_field_0']);
            $countryconfig = esc_attr( get_option('tp_api_settings')['tp_api_text_field_1']);
            $redirect = esc_attr( get_option('tp_api_settings')['tp_api_text_field_2']);
            $iprisk = esc_attr( get_option('tp_api_settings')['tp_api_select_field_3']);
            $countrywhite = esc_attr( get_option('tp_api_settings')['tp_api_text_field_4']);
            $bad = esc_attr( get_option('tp_api_settings')['tp_api_select_field_5']);
            $bypasslist = esc_attr( get_option('tp_api_settings')['tp_api_text_field_6']);
            $mailon = esc_attr( get_option('tp_api_settings')['tp_api_select_field_9']);
            $emailaddress = esc_attr( get_option('tp_api_settings')['tp_api_text_field_10']);

            if ($iprisk == '1'){
              $ipriskn = 'High';
              $banOnProbability=0.989;
            }
            if ($iprisk == '2'){
              $ipriskn = 'Consider';
              $banOnProbability=0.85;
            }
            if ($iprisk == '3'){
              $ipriskn = 'Low';
              $banOnProbability=0.65;
            }

            $ip = $_SERVER['REMOTE_ADDR'];

            if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            }

            $url = 'http://' .$key. '.getipintel.net/check.php?ip=' .$ip. '&contact=' .$emailaddress. '&format=json&flags=f&oflags=cb';

            $arguments = array ('sslverify' => false,
              'headers' => array('X-Api-Key' => $key));

            $response = wp_remote_get( $url );

            if (is_wp_error( $response ) ) {

                echo 'Errors detected!';

            } elseif ($bypasslist !='' and strpos($bypasslist, $ip) !==false) {
                if ($mailon =='1'){
                    $to = $emailaddress;
                    $subject = 'IP Risk >= Cleared Bypass Ip Access';
                    $body = 'IP Risk >= Admin Access Cleared IP ' .$ip. ' by the IP Intelligence Plugin';
                    $headers = array('Content-Type: text/html; charset=UTF-8;');
                    $sent = @wp_mail($to,$subject,$body,$headers);
                }

            } else {
                $body = wp_remote_retrieve_body( $response );
                $datapoint = json_decode( $body );
                $ipa  = $datapoint->queryIP;
                $risk = $datapoint->result;
                $pais = $datapoint->Country;
                $status = $datapoint->status;
                $query1 = $datapoint->queryFlags;
                $query2 = $datapoint->queryOFlags;
                $query3 = $datapoint->queryFormat;
                $owner = $datapoint->contact;
                $badip = $datapoint->BadIP;
                $rate = floatval($risk);

                if ($bad =='1' and $badip ===1 and $status == 'success') {
                    if ($mailon =='1'){
                        $to = $emailaddress;
                        $subject = 'BAD IP access attempt';
                        $body = 'IP Risk >= Blocked Page Access IP ' .$ipa. ' with risk ' .$risk.  ' page ' .$value.' from ' .$pais.    ' by the IP Intelligence Plugin';
                        $headers = array('Content-Type: text/html; charset=UTF-8;');
                        $sent = @wp_mail($to,$subject,$body,$headers);
                    }
                    wp_redirect( $redirect);
                    exit;
                }
                if ($ipriskn == 'High' and $rate > $banOnProbability and $status == 'success') {
                    if ($mailon =='1'){
                        $to = $emailaddress;
                        $subject = 'IP Risk >= Blocked Page Access';
                        $body = 'IP Risk >= Blocked Page Access IP ' .$ipa. ' with risk ' .$risk.  ' page ' .$value.' from ' .$pais.    ' by the IP Intelligence Plugin';
                        $headers = array('Content-Type: text/html; charset=UTF-8;');
                        $sent = @wp_mail($to,$subject,$body,$headers);
                    }
                    wp_redirect( $redirect);
                    exit;
                }
                if ($ipriskn == 'High' and $rate < $banOnProbability and $status == 'success') {
                    if ($mailon =='1'){
                        $to = $emailaddress;
                        $subject = 'IP Risk >= Cleared Page Access';
                        $body = 'IP Risk >= Page Access Cleared IP ' .$ipa. ' with risk ' .$risk.  ' page ' .$value. ' from ' .$pais.  ' by the IP Intelligence Plugin';
                        $headers = array('Content-Type: text/html; charset=UTF-8;');
                        $sent = @wp_mail($to,$subject,$body,$headers);
                    }
                }
                if ($ipriskn == 'Consider' and $rate > $banOnProbability and $status == 'success') {
                    if ($mailon =='1'){
                        $to = $emailaddress;
                        $subject = 'IP Risk >= Blocked Page Access';
                        $body = 'IP Risk >= Blocked Page Access IP ' .$ipa. ' with risk ' .$risk.  ' page ' .$value.' from ' .$pais.    ' by the IP Intelligence Plugin';
                        $headers = array('Content-Type: text/html; charset=UTF-8;');
                        $sent = @wp_mail($to,$subject,$body,$headers);
                    }
                    wp_redirect( $redirect);
                    exit;
                }
                if ($ipriskn == 'Consider' and $rate < $banOnProbability and $status == 'success') {
                    if ($mailon =='1'){
                        $to = $emailaddress;
                        $subject = 'IP Risk >= Cleared Page Access';
                        $body = 'IP Risk >= Page Access Cleared IP ' .$ipa. ' with risk ' .$risk.  ' page ' .$value. ' from ' .$pais.  ' by the IP Intelligence Plugin';
                        $headers = array('Content-Type: text/html; charset=UTF-8;');
                        $sent = @wp_mail($to,$subject,$body,$headers);
                    }
                }
                if ($ipriskn == 'Low' and $rate > $banOnProbability and $status == 'success') {
                    if ($mailon =='1'){
                        $to = $emailaddress;
                        $subject = 'IP Risk >= Blocked Page Access';
                        $body = 'IP Risk >= Blocked Page Access IP ' .$ipa. ' with risk ' .$risk.  ' page ' .$value.' from ' .$pais.    ' by the IP Intelligence Plugin';
                        $headers = array('Content-Type: text/html; charset=UTF-8;');
                        $sent = @wp_mail($to,$subject,$body,$headers);
                    }
                    wp_redirect( $redirect);
                    exit;
                }
                if ($ipriskn == 'Low' and $rate < $banOnProbability and $status == 'success') {
                    if ($mailon =='1'){
                        $to = $emailaddress;
                        $subject = 'IP Risk >= Cleared Page Access';
                        $body = 'IP Risk >= Page Access Cleared IP ' .$ipa. ' with risk ' .$risk.  ' page ' .$value. ' from ' .$pais.  ' by the IP Intelligence Plugin';
                        $headers = array('Content-Type: text/html; charset=UTF-8;');
                        $sent = @wp_mail($to,$subject,$body,$headers);
                    }
                }
                if ($countryconfig !='' and $status == 'success' and strpos($countryconfig, $pais) !==false) {
                    if ($mailon =='1'){
                        $to = $emailaddress;
                        $subject = 'Blacklisted country access attempt';
                        $body = 'IP Risk >= Blocked Page Access IP ' .$ipa. ' with risk ' .$risk.  ' page ' .$value.' from ' .$pais.    ' by the IP Intelligence Plugin';
                        $headers = array('Content-Type: text/html; charset=UTF-8;');
                        $sent = @wp_mail($to,$subject,$body,$headers);
                    }
                    wp_redirect( $redirect);
                    exit;
                }
                if ($countrywhite !='' and $status == 'success' and strpos($countrywhite, $pais) ===false) {
                    if ($mailon =='1'){
                        $to = $emailaddress;
                        $subject = 'Blacklisted country access attempt';
                        $body = 'IP Risk >= Blocked Page Access IP ' .$ipa. ' with risk ' .$risk.  ' page ' .$value.' from ' .$pais.    ' by the IP Intelligence Plugin';
                        $headers = array('Content-Type: text/html; charset=UTF-8;');
                        $sent = @wp_mail($to,$subject,$body,$headers);
                    }
                    wp_redirect( $redirect);
                    exit;
                }
            }
        }
    }
}
