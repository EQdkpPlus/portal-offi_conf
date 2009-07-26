<?php
/*
 * Project:     EQdkp-Plus
 * License:     Creative Commons - Attribution-Noncommercial-Share Alike 3.0 Unported
 * Link:		http://creativecommons.org/licenses/by-nc-sa/3.0/
 * -----------------------------------------------------------------------
 * Began:       2009
 * Date:        $Date$
 * -----------------------------------------------------------------------
 * @author      $Author$
 * @copyright   2006-2009 Corgan - Stefan Knaak | Wallenium & the EQdkp-Plus Developer Team
 * @link        http://eqdkp-plus.com
 * @package     eqdkp-plus
 * @version     $Rev$
 *
 * $Id$
 */

if ( !defined('EQDKP_INC') ){
  header('HTTP/1.0 404 Not Found');exit;
}

$portal_module['offi_conf'] = array(
			'name'           => 'Officer Conference',
			'path'           => 'offi_conf',
			'version'        => '1.1.0',
			'author'         => 'Hoofy',
			'contact'        => 'http://www.eqdkp-plus.com',
			'description'    => 'Admins can post topics for officer conference.',
			'positions'      => array('left1', 'left2', 'right'),
      'signedin'       => '1',
      'install'        => array(
			                      'autoenable'        => '1',
			                      'defaultposition'   => 'left2',
			                      'defaultnumber'     => '5',
			                      'customsql'		  => array(
			                      		"CREATE TABLE IF NOT EXISTS __module_offi_conf (
			                      			`topic_id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
			                      			`topic_name` VARCHAR(255) NOT NULL,
			                      			`topic_desc` TEXT DEFAULT NULL,
			                      			`topic_time` SMALLINT(3) NOT NULL,
			                      			`topic_expires` INT(10) NOT NULL,
			                      			`topic_creator` INT(11) NOT NULL,
			                      			`topic_position` SMALLINT(2) DEFAULT NULL
			                      		);")
			                    ),
    );

$portal_settings['offi_conf'] = array(
  'pk_oc_day'     => array(
        'name'      => 'pk_oc_day',
        'language'  => 'pk_oc_day',
        'property'  => 'dropdown',
        'help'      => '',
        'options'   => array(
        				1 => "oc_monday",
        				2 => "oc_tuesday",
        				3 => "oc_wednesday",
        				4 => "oc_thursday",
        				5 => "oc_friday",
        				6 => "oc_saturday",
        				7 => "oc_sunday")
      ),
  'pk_oc_time_type' => array(
  		'name'		=> 'pk_oc_time_type',
  		'language'	=> 'pk_oc_time_type',
  		'property'	=> 'dropdown',
  		'help'		=> '',
  		'options'	=> array(
  						'start' => "oc_start",
  						'end'	=> "oc_end")
     ),
  'pk_oc_time'		=> array(
  		'name'		=> 'pk_oc_time',
  		'language'	=> 'pk_oc_end_time',
  		'property'	=> 'text',
  		'size'		=> 6,
  		)
);

if(!function_exists('oc_username')) {
  function oc_username($id)
  {
	global $db;
	static $users;
	if(!$users) {
		$sql = "SELECT user_id, username FROM __users;";
		$result =  $db->query($sql);
		while ( $row = $db->fetch_record($result) ) {
			$users[$row['user_id']] = $row['username'];
		}
		$db->free_result($result);
	}
	return $users[$id];
  }
}

if(!function_exists('offi_conf_module'))
{
  function offi_conf_module()
  {
  	global $db, $eqdkp, $plang, $pdc, $eqdkp_root_path, $jqueryp, $html, $eqdkp_root_path, $conf_plus, $user;
  	if(!$user->check_auth('a_', false)) {
  		return '';
  	}
  	$out = "<script language=\"JavaScript\" type=\"text/javascript\">
  			function OpenTopicWindow(name,topic_id){";
  	$out .= $jqueryp->Dialog_URL('OCTopicWindow', "'+name+'", $eqdkp_root_path."portal/offi_conf/add_topic.php?id='+topic_id+'", "600", "400")."}</script>";
	$out .= "<table width='100%' cellpadding='2' cellspacing='1' class='borderless'><tr><th colspan='2'>".$plang['oc_next_topics']."</th></tr>";
	$offi_conf = $pdc->get('portal.modul.officonf',false,$eqdkp->config['enable_gzip']);
	if(!$offi_conf) {
		$offi_conf = '';
		$sql = "SELECT topic_id, topic_name, topic_time, topic_desc, topic_creator FROM __module_offi_conf WHERE topic_expires > '".time()."' ORDER BY topic_position ASC;";
		$result = $db->query($sql);
		$i = 1;
		$total = 0;
		while ( $row = $db->fetch_record($result) ) {
			$offi_conf .= "<tr class='".$eqdkp->switch_row_class()."'><td>".$i.". ".$row['topic_name']." ";
			$tooltip = $row['topic_desc']."<br />".$plang['oc_creator']." ".oc_username($row['topic_creator']);
			$offi_conf .= $html->ToolTip($tooltip, "<img src='".$eqdkp_root_path."libraries/pluginCore/images/help_small.png' border='0' alt='' align='absmiddle' />");
            $offi_conf .= " (".$row['topic_time'].$plang['oc_min'].")";
			$offi_conf .= "</td><td><img onclick=\"javascript:OpenTopicWindow('".$plang['oc_upd_topic']."',".$row['topic_id'].")\" src='".$eqdkp_root_path."images/admin/wrench_orange.png' style=\"cursor:pointer\" />";
			$offi_conf .= "</td></tr>";
			$total += $row['topic_time'];
			$i++;
		}
		//calc time
		$N = date('N');
		if($N != $conf_plus['pk_oc_day']) {
			$N = $conf_plus['pk_oc_day'] - $N;
			if($N < 0) {
				$N += 7;
			}
		}
		list($day,$mon,$yea) = explode('.', date('d.m.Y'));
		$day += $N;
		$time = mktime(0,0,0,$mon,$day,$yea);
		list($hour,$min) = explode(':', $conf_plus['pk_oc_time']);
		$secs = 3600*$hour + 60*$min;
		if($conf_plus['pk_oc_time_type'] == 'start') {
			$stime = $time + $secs;
			$etime = $time + $secs + 60*$total;
		} elseif($conf_plus['pk_oc_time_type'] == 'end') {
			$stime = $time + $secs - 60*$total;
			$etime = $time + $secs;
		}

		$offi_conf .= "<tr><th colspan='2'>".$plang['oc_next_oc']."</th></tr>";
		$offi_conf .= "<tr class='".$eqdkp->switch_row_class()."'><td colspan='2'>".date('d.m.y H:i:s', $stime)." - ".date('H:i:s', $etime)."</td></tr>";
		$pdc->put('portal.modul.officonf', $offi_conf);
    }
    $out .= $offi_conf;
	$out .= "<tr><th colspan='2'><input type='button' name='addtopic' onclick=\"javascript:OpenTopicWindow('".$plang['oc_add_topic']."',0)\" class='mainoption' value='".$plang['oc_add_topic']."' style=\"cursor:pointer\" /></th></tr></table>";
	return $out;
  }
}
?>