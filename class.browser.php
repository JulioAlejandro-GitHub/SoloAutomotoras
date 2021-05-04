<?php
class Browser {
    static function getInfo() {
        $user_agent   = $_SERVER['HTTP_USER_AGENT'];
        $browser_name = 'Unknown';
        $platform     = 'Unknown';
        $version      = '';
        
        //first get the platform
        if ( preg_match('/linux/i', $user_agent) ) {
            $platform = 'linux'; 
        }
        elseif ( preg_match('/macintosh|mac os x/i', $user_agent) ) { 
            $platform = 'mac'; 
            
        }
        elseif ( preg_match('/windows|win32/i'     , $user_agent) ) {
            $platform = 'windows';
        }
        
        //next get the name of the useragent
        if ( preg_match('/MSIE/i', $user_agent) && !preg_match('/Opera/i', $user_agent) ) {
            $browser_name = 'Internet Explorer';
            $browser_user = 'MSIE';
        }
        elseif ( preg_match('/Firefox/i', $user_agent) ) {
            $browser_name = 'Mozilla Firefox';
            $browser_user = 'Firefox';
        }
        elseif ( preg_match('/Chrome/i', $user_agent) ) {
            $browser_name = 'Google Chrome';
            $browser_user = 'Chrome';
        }
        elseif ( preg_match('/Safari/i', $user_agent) ) {
            $browser_name = 'Apple Safari';
            $browser_user = 'Safari';
        } 
        elseif ( preg_match('/Opera/i', $user_agent) ) {
            $browser_name = 'Opera';
            $browser_user = 'Opera';
        }
        elseif ( preg_match('/Netscape/i', $user_agent) ) {
            $browser_name = 'Netscape';
            $browser_user = 'Netscape';
        }
        
        //finally get the correct version number
        $known   = array('Version', $browser_user, 'other');
        $pattern = '#(\?<browser>' . join('|', $known) . ')[/ ]+(\?<version>[0-9.|a-zA-Z.]*)#';
        
        if ( !preg_match_all($pattern, $user_agent, $matches) ) {
            //we have no matching number just continue
        }
        
        //see how many we have
        $i = count($matches['browser']);
        
        if ($i != 1) {
            //we will have two since we are not using 'other' argument yet
            //see if version is before or after the name
            if ( strripos($user_agent, "Version") < strripos($user_agent, $browser_user) ){
                $version = $matches['version'][0];
            }
            else {
                $version = $matches['version'][1];
            }
        }
        else {
            $version = $matches['version'][0];
        }
        
        // check if we have a number
        if ($version == null || $version == '') {
            $version = '?';
        }
        
        $info = array(
            'userAgent' => $user_agent,
            'name'      => $browser_name,
            'version'   => $version,
            'platform'  => $platform,
            'pattern'   => $pattern
        );
        
        return $info;
    }
    
    static function getPlatform() {
        $platform = "";
        //return $platform;
        $browser_info = self::getInfo();

        if( preg_match('/iPhone/', $browser_info['userAgent']) ) {
            $platform = "iphone";
        }
        elseif ( preg_match('/Android/', $browser_info['userAgent']) ) {
            //$platform = "android";
        }

        return $platform;
    }
}
?>
