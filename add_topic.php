<?php
/*	Project:	EQdkp-Plus
 *	Package:	Officer conference Portal Module
 *	Link:		http://eqdkp-plus.eu
 *
 *	Copyright (C) 2006-2015 EQdkp-Plus Developer Team
 *
 *	This program is free software: you can redistribute it and/or modify
 *	it under the terms of the GNU Affero General Public License as published
 *	by the Free Software Foundation, either version 3 of the License, or
 *	(at your option) any later version.
 *
 *	This program is distributed in the hope that it will be useful,
 *	but WITHOUT ANY WARRANTY; without even the implied warranty of
 *	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *	GNU Affero General Public License for more details.
 *
 *	You should have received a copy of the GNU Affero General Public License
 *	along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

define('EQDKP_INC', true);
define('IN_ADMIN', true);

$eqdkp_root_path = './../../';
include_once($eqdkp_root_path.'common.php');

class addtopic extends page_generic {
	private $module_id = 0;
	public function __construct() {
		$this->user->check_auth('a_');
		parent::__construct(false, false, array(), null, '', 'id');
		$this->module_id = $this->in->get('pmod_id', 0);
		$this->process();
	}
	
	private function expires() {
		$oc_date = $this->portal->get_module($this->module_id)->calc_date();
		list($h, $min, $s) = explode(':', $this->time->date('H:i:s', $oc_date));
		// find 5 o'clock in the morning
		$secs = $mins = $hs = 0;
		if($s != 0) {
			$secs = 60 - $s;
			$min++;
		}
		if($min != 0) {
			$mins = 60 - $min;
			$h++;
		}
		if($h >= 5) {
			$hs = 24 - $h + 5;
		} else {
			$hs = 5 - $h;
		}
		$add = $secs + 60*$mins + 3600*$hs;
		// minimum time 2 hours
		if($add < 7200) $add += 7200;
		return $oc_date + $add;
	}

	public function update() {
		$params = array(
			'topic_name' => $this->in->get('t_name', $this->user->lang('oc_no_name')),
			'topic_desc' => $this->in->get('t_desc', $this->user->lang('oc_no_desc')),
			'topic_position' => $this->in->get('t_posi', 9),
			'topic_time' => $this->in->get('t_time', 15),
			'topic_expires' => $this->expires()
		);
		if($this->url_id) {
			$resQuery = $this->db->prepare("UPDATE __module_offi_conf :p WHERE topic_id=?")->set($params)->execute($this->url_id);
		} else {
			$params['topic_creator'] = $this->user->id;
			$resQuery = $this->db->prepare("INSERT INTO __module_offi_conf :p")->set($params)->execute();		
		}
		$this->finish($resQuery, 'save');
	}

	public function delete() {
		$resQuery = $this->db->prepare("DELETE FROM __module_offi_conf WHERE (topic_id=? OR topic_expires < ? )")->execute($this->url_id, $this->time->time);
		$this->finish($resQuery, 'delete');
	}

	public function finish($boolsql, $type) {
		if($boolsql) {
			$this->core->message('', $this->user->lang('oc_'.$type.'_success'), 'green', true, false);
			$this->pdc->del('portal.module.officonf.out');
		} else {
			$this->core->message('', $this->user->lang('oc_'.$type.'_no_success'), 'red', true, false);
		}
		$this->tpl->add_js('jQuery.FrameDialog.closeDialog();');
		$this->core->set_vars(array(
			'page_title'		=> sprintf($this->user->lang('title_prefix'), $this->config->get('guildtag'), $this->config->get('dkp_name')).': '.$this->user->lang('user_list'),
			'template_path'		=> 'portal/offi_conf/templates/',
			'template_file'		=> 'add_topic.html',
			'header_format'		=> 'simple',
			'display'			=> true)
		);
	}

	public function display() {
		$data = array();
		if($this->url_id != 0) {
			$objQuery = $this->db->prepare("SELECT topic_name, topic_desc, topic_time, topic_position FROM __module_offi_conf WHERE topic_id = ?")->execute($this->url_id);
			if ($objQuery){
				$data = $objQuery->fetchAssoc();
				if ($objQuery->numRows){				
					$this->tpl->assign_vars(array(
						'TOPIC_NAME'	=> $data['topic_name'],
						'TOPIC_TIME'	=> $data['topic_time'],
						'TOPIC_POSI'	=> $data['topic_position'],
						'TOPIC_DESC'	=> $data['topic_desc'],
						'TOPIC_ID'		=> $this->url_id,
						'DELETE'		=> true
					));
				}
			}	
		}
		$this->tpl->assign_vars(array(
			'ACTION'	=> $this->env->phpself.$this->SID.$this->simple_head_url.$this->url_id_ext.'&amp;pmod_id='.$this->module_id,
		));
		$this->core->set_vars(array(
			'page_title'		=> sprintf($this->user->lang('title_prefix'), $this->config->get('guildtag'), $this->config->get('dkp_name')).': '.$this->user->lang('user_list'),
			'template_path'		=> 'portal/offi_conf/templates/',
			'template_file'		=> 'add_topic.html',
			'header_format'		=> 'simple',
			'display'			=> true)
		);
	}
}
registry::register('addtopic');
?>