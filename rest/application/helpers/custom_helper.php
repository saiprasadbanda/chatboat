<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2015, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package    CodeIgniter
 * @author    EllisLab Dev Team
 * @copyright    Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright    Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license    http://opensource.org/licenses/MIT	MIT License
 * @link    http://codeigniter.com
 * @since    Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter Array Helpers
 *
 * @package        CodeIgniter
 * @subpackage    Helpers
 * @category    Helpers
 * @author        EllisLab Dev Team
 * @link        http://codeigniter.com/user_guide/helpers/array_helper.html
 */

// ------------------------------------------------------------------------
/*if (!function_exists('generatePassword')) {
    function generatePassword($length)
    {
        return bin2hex(openssl_random_pseudo_bytes($length));
    }
}*/
if (!function_exists('generatePassword')) {
    function generatePassword($length = 8, $add_dashes = false, $available_sets = 'luds')
    {
        $sets = array();
        if(strpos($available_sets, 'l') !== false)
            $sets[] = 'abcdefghjkmnpqrstuvwxyz';
        if(strpos($available_sets, 'u') !== false)
            $sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
        if(strpos($available_sets, 'd') !== false)
            $sets[] = '23456789';
        if(strpos($available_sets, 's') !== false)
            $sets[] = '!@#$%&*?';
        $all = $password = '';
        foreach($sets as $set)
        {
            $password .= $set[array_rand(str_split($set))];
            $all .= $set;
        }
        $all = str_split($all);
        for($i = 0; $i < $length - count($sets); $i++)
            $password .= $all[array_rand($all)];
        $password = str_shuffle($password);
        if(!$add_dashes)
            return $password;
        $dash_len = floor(sqrt($length));
        $dash_str = '';
        while(strlen($password) > $dash_len)
        {
            $dash_str .= substr($password, 0, $dash_len) . '-';
            $password = substr($password, $dash_len);
        }
        $dash_str .= $password;
        return $dash_str;
    }
}
if (!function_exists('doUpload')) {
    function doUpload($temp_name, $image, $upload_path,$folder = '',$upload_type='')
    {
        $ext = pathinfo($image, PATHINFO_EXTENSION);
        if(!is_dir($upload_path.$folder)){ mkdir($upload_path.$folder); }

        /*if($upload_type=='image'){
            $allowed = array('jpeg', 'png', 'jpg', 'JPG', 'PNG', 'JPEG');
            $size=get_file_info($temp_name, 'size');

            if (!in_array($ext, $allowed)) {
                return 0;
                exit;
            }
            else if($size['size']>IMAGE_UPLOAD_SIZE)
            {
                return 2;
                exit;
            }

        }
        else if($upload_type=='video'){
            $allowed = array('3gp', 'mp4', '3GP', 'MP4');
            if (!in_array($ext, $allowed)) {
                return 0;
                exit;
            }
        }*/

        if($folder!='')
            $folder = $folder.'/';

        list($txt, $ext) = explode(".", $image);
        $imageName = str_replace(' ','_',$txt) . "_" . time() . "." . $ext;
        move_uploaded_file($temp_name, $upload_path.$folder . $imageName);
        return $folder.$imageName;
    }
}
if (!function_exists('getImageUrl')) {
    function getImageUrl($image, $type='')
    {
        if ($image != '') {
            if (file_exists('uploads/' . $image)) {
                return REST_API_URL . 'uploads/' . $image;
            }
        }

        if ($type == 'profile') {
            return REST_API_URL . 'images/default-img.png';
        } else if ($type == 'company') {
            return REST_API_URL . 'images/company-logo.jpg';
        } else if ($type == 'flag') {
            return REST_API_URL . 'images/default-flag.png';
        }
        else{
            return REST_API_URL . 'images/default-img.png';
        }
    }
}

if (!function_exists('getExactImageUrl')) {
    function getExactImageUrl($image)
    {
        if ($image != '') {
            if (file_exists('uploads/' . $image)) {
                return REST_API_URL . 'uploads/' . $image;
            }
            else{
                return '';
            }
        }
        else{
            return '';
        }
    }
}

if (!function_exists('formatSizeUnits')) {
    function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }
        return $bytes;
    }
}

if (!function_exists('currentDate')) {
    function currentDate()
    {
        return date('Y-m-d H:i:s');
    }
}
if (!function_exists('getUserBrowser')) {
    function getUserBrowser($u_agent)
    {
        //$u_agent = $_SERVER['HTTP_USER_AGENT'];
        $bname = 'Unknown';
        $platform = 'Unknown';
        $version= "";

        //First get the platform?



        $platform = getUserOS($u_agent);
        /*if (preg_match('/linux/i', $u_agent)) {
            $platform = 'linux';
        }
        elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
            $platform = 'mac';
        }
        elseif (preg_match('/windows|win32/i', $u_agent)) {
            $platform = 'windows';
        }*/

        // Next get the name of the useragent yes seperately and for good reason
        if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
        {
            $bname = 'Internet Explorer';
            $ub = "MSIE";
        }
        elseif(preg_match('/Trident/i',$u_agent))
        { // this condition is for IE11
            $bname = 'Internet Explorer';
            $ub = "rv";
        }
        elseif(preg_match('/Edge/i',$u_agent))
        {
            $bname = 'Internet Explorer';
            $ub = "Edge";
        }
        elseif(preg_match('/Firefox/i',$u_agent))
        {
            $bname = 'Mozilla Firefox';
            $ub = "Firefox";
        }
        elseif(preg_match('/Chrome/i',$u_agent))
        {
            $bname = 'Google Chrome';
            $ub = "Chrome";
        }
        elseif(preg_match('/Safari/i',$u_agent))
        {
            $bname = 'Apple Safari';
            $ub = "Safari";
        }
        elseif(preg_match('/Opera/i',$u_agent))
        {
            $bname = 'Opera';
            $ub = "Opera";
        }
        elseif(preg_match('/Netscape/i',$u_agent))
        {
            $bname = 'Netscape';
            $ub = "Netscape";
        }

        // finally get the correct version number
        // Added "|:"
        $known = array('Version', $ub, 'other');
        $pattern = '#(?<browser>' . join('|', $known) .
            ')[/|: ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $u_agent, $matches)) {
            // we have no matching number just continue
        }

        // see how many we have
        $i = count($matches['browser']);
        if ($i != 1) {
            //we will have two since we are not using 'other' argument yet
            //see if version is before or after the name
            if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
                $version= $matches['version'][0];
            }
            else {
                $version= $matches['version'][1];
            }
        }
        else {
            $version= $matches['version'][0];
        }

        // check if we have a number
        if ($version==null || $version=="") {$version="?";}

        return $bname.'('.$version.') '.$platform;
        //return $browser = $ubrowser['name'].','.$ubrowser['version'].','.$ubrowser['platform'];
        /*return array(
            'userAgent' => $u_agent,
            'name'      => $bname,
            'version'   => $version,
            'platform'  => $platform,
            'pattern'    => $pattern
        );*/
    }
}
if (!function_exists('getUserOS')) {
function getUserOS($user_agent) {
    $os_platform    =   "Unknown OS Platform";

    $os_array       =   array(
        '/windows nt 10/i'     =>  'Windows 10',
        '/windows nt 6.3/i'     =>  'Windows 8.1',
        '/windows nt 6.2/i'     =>  'Windows 8',
        '/windows nt 6.1/i'     =>  'Windows 7',
        '/windows nt 6.0/i'     =>  'Windows Vista',
        '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
        '/windows nt 5.1/i'     =>  'Windows XP',
        '/windows xp/i'         =>  'Windows XP',
        '/windows nt 5.0/i'     =>  'Windows 2000',
        '/windows me/i'         =>  'Windows ME',
        '/win98/i'              =>  'Windows 98',
        '/win95/i'              =>  'Windows 95',
        '/win16/i'              =>  'Windows 3.11',
        '/macintosh|mac os x/i' =>  'Mac OS X',
        '/mac_powerpc/i'        =>  'Mac OS 9',
        '/linux/i'              =>  'Linux',
        '/ubuntu/i'             =>  'Ubuntu',
        '/iphone/i'             =>  'iPhone',
        '/ipod/i'               =>  'iPod',
        '/ipad/i'               =>  'iPad',
        '/android/i'            =>  'Android',
        '/blackberry/i'         =>  'BlackBerry',
        '/webos/i'              =>  'Mobile'
    );

    foreach ($os_array as $regex => $value) {

        if (preg_match($regex, $user_agent)) {
            $os_platform    =   $value;
        }

    }

    return $os_platform;
}
}
if (!function_exists('integerToRoman')) {
    function integerToRoman($integer) {
        // Convert the integer into an integer (just to make sure)
        $integer = intval($integer);
        $result = '';

        // Create a lookup array that contains all of the Roman numerals.
        $lookup = array('M' => 1000,
            'CM' => 900,
            'D' => 500,
            'CD' => 400,
            'C' => 100,
            'XC' => 90,
            'L' => 50,
            'XL' => 40,
            'X' => 10,
            'IX' => 9,
            'V' => 5,
            'IV' => 4,
            'I' => 1);

        foreach($lookup as $roman => $value){
            // Determine the number of matches
            $matches = intval($integer/$value);

            // Add the same number of characters to the string
            $result .= str_repeat($roman,$matches);

            // Set the integer to be the remainder of the integer and the value
            $integer = $integer % $value;
        }

        // The Roman numeral should be built, return it
        return $result;
    }
}
if (!function_exists('arrayToTable')) {
    function arrayToTable($array_data, $docname = '')
    {
        $i = 0;
        $width = '0%';
        if(count($array_data)>0)
            $width = (100/count($array_data)).'%';
        $table_data = '<table width="100%" style="border-color: #000000;width:100%;overflow:visible;">';
        foreach ($array_data as $v) {
            if ($i == 0)
                $table_data .= '<tr style="font-weight: bold;width:100%;">';
            else
                $table_data .= '<tr style="font-weight: bold;width:100%;">';
            foreach ($v as $vv) {
                if ($docname == 'termsheet') {
                    if ($vv != '' && is_numeric($vv)) {
                        $table_data .= '<td style="width: '.$width.';overflow:visible;">' . number_format($vv) . '</td>';
                    } else {
                        $table_data .= '<td style="width: '.$width.';overflow:visible;">' . $vv . '</td>';
                    }
                } else {
                    $table_data .= '<td style="width: '.$width.';overflow:visible;">' . $vv . '</td>';
                }
            }
            $i++;
        }
        $table_data .= '</table>';
        return $table_data;
    }
}
if (!function_exists('saveSendMail')) {
    function saveSendMail($to,$subject,$message) {
        $CI =& get_instance();
        $CI->db->insert('mailer', array(
            'mail_to' => $to,
            'mail_subject' => $subject,
            'mail_message' => $message,
        ));
        return 1;
    }
}

if(!function_exists('pk_encrypt')){
    function pk_encrypt($response){
        if($response!=NULL) {
            $aesObj = new AES();
            $response = $aesObj->encrypt($response, 'JKj178jircAPx7h4CbGyY', 'The@1234');
        }
        return $response;
    }
}

if(!function_exists('pk_decrypt')){
    function pk_decrypt($response){
        if($response!=NULL && $response!='') {
            $aesObj = new AES();
            $response = $aesObj->decrypt($response,'JKj178jircAPx7h4CbGyY');
            if($response>=0){

            }
            else{
                $result = array('status'=>FALSE, 'message' => 'Invalid access.', 'data'=>array());
                echo json_encode($result);exit;
            }
        }
        return $response;
    }
}
