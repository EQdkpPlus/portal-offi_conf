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

define('EQDKP_INC', true);

$eqdkp_root_path = './../../';
include_once($eqdkp_root_path.'common.php');
$user->check_auth('a_');

if(!class_exists('AddTopic')) {
  class AddTopic
  {
  	private $id = 0;
  	private $type = 'edit';   // valid types: false, 'save', 'delete'

  	public function __construct()
  	{
  		global $in;
  		$this->id = $in->get('id', 0);
  		if($in->get('save', false)) {
  			$this->type = 'save';
  		} elseif($in->get('delete', false)) {
  			$this->type = 'delete';
  		}
  		call_user_func_array(array($this, $this->type), array());
    }

    private function save()
    {
    	global $in, $conf_plus, $user, $plang;
    	//update
    	if($this->id) {
    		$sql = "UPDATE __module_offi_conf SET
    			   		topic_name = '".$in->get('t_name', $plang['oc_no_name'])."',
    			   		topic_desc = '".$in->get('t_desc', $plang['oc_no_desc'])."',
    			   		topic_position = '".$in->get('t_posi', 9)."',
    			   		topic_time = '".$in->get('t_time', 15)."'
    			    WHERE topic_id = '".$this->id."';";
    	} else {
    		//calc expire
    		$soll = $conf_plus['pk_oc_day'];
    		list($N, $h, $min, $s) = explode(':', date('N:H:i:s'));
    		if($s != 0) {
    			$secs = 60 - $s;
    			$min++;
    		}
    		if($min != 0) {
    			$mins = 60 - $min;
    			$h++;
    		}
    		if($h >= 5) {
                $hs = 24 - ($h - 5);
    			$N++;
    		}
    		if($N != $soll) {
    			$days = $soll - $N;
    			if($days < -1) {
    				$days = $days + 7;
    			}
    		}
    		$days++; //next day morning
    		$add = $secs + 60*$mins + 3600*$hs + 3600*24*$days;
    		$expire = time() + $add;

    		$sql = "INSERT INTO __module_offi_conf
    				 (topic_name, topic_desc, topic_position, topic_time, topic_expires, topic_creator)
    				VALUES
    				 ('".$in->get('t_name', $plang['oc_no_name'])."', '".$in->get('t_desc', $plang['oc_no_desc'])."', '".$in->get('t_posi', 9)."', '".$in->get('t_time', 15)."', '".$expire."', '".$user->data['user_id']."');";
    	}
    	$this->do_sql($sql, 'save');
    }

    private function delete()
    {
    	$sql = "DELETE FROM __module_offi_conf WHERE topic_id = '".$this->id-"';";
    	$this->do_sql($sql, 'delete');
    }

    private function do_sql($sql, $type)
    {
    	global $db, $plang, $user, $eqdkp, $tpl, $pdc;
    	if($db->query($sql)) {
            System_Message('', $plang['oc_'.$type.'_success'], 'green');
            $pdc->del_suffix('officonf');
    	} else {
    		System_Message('', $plang['oc_'.$type.'_no_success'], 'red');
    	}
        $tpl->assign_var('CLOSE', true);
        $eqdkp->set_vars(array(
            'page_title'    => sprintf($user->lang['title_prefix'], $eqdkp->config['guildtag'], $eqdkp->config['dkp_name']).': '.$user->lang['user_list'],
            'template_path' => 'portal/offi_conf/templates/',
            'template_file' => 'add_topic.html',
            'gen_simple_header' => true,
            'display'       => true)
        );
    }

    private function edit()
    {
    	global $db, $tpl, $eqdkp, $plang, $jqueryp;

		$data = array();
		if($this->id != 0) {
			$sql = "SELECT topic_name, topic_desc, topic_time, topic_position FROM __module_offi_conf WHERE topic_id = '".$this->id."';";
			$result = $db->query($sql);
			$data = $db->fetch_record($result);
			$data = array(
				'TOPIC_NAME' => $data['topic_name'],
				'TOPIC_TIME' => $data['topic_time'],
				'TOPIC_POSI' => $data['topic_position'],
				'TOPIC_DESC' => $data['topic_desc'],
				'TOPIC_ID'	 => $this->id,
            	'DELETE'	 => true
			);
			$db->free_result($result);
		}
		$template = array(
			'L_ADD_TOPIC' 	=> $plang['oc_add_topic'],
			'L_TOPIC_NAME' 	=> $plang['oc_topic_name'],
			'L_TOPIC_TIME' 	=> $plang['oc_topic_time'],
			'L_TOPIC_POSI' 	=> $plang['oc_topic_posi'],
			'L_TOPIC_DESC' 	=> $plang['oc_topic_desc'],
			'L_SAVE' 		=> $plang['oc_save'],
			'L_DELETE' 		=> $plang['oc_delete']
		);
		$tpl->assign_vars(array_merge($data, $template));

		$eqdkp->set_vars(array(
		    'page_title'    => sprintf($user->lang['title_prefix'], $eqdkp->config['guildtag'], $eqdkp->config['dkp_name']).': '.$user->lang['user_list'],
		    'template_path' => 'portal/offi_conf/templates/',
		    'template_file' => 'add_topic.html',
		    'gen_simple_header' => true,
		    'display'       => true)
		);
	}
  }
}
$addtopic = new AddTopic();
?>