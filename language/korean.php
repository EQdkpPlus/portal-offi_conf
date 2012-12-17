<?php
/*
 * Project:     EQdkp-Plus
 * License:     Creative Commons - Attribution-Noncommercial-Share Alike 3.0 Unported
 * Link:		http://creativecommons.org/licenses/by-nc-sa/3.0/
 * -----------------------------------------------------------------------
 * Began:       2008
 * Date:        $Date: 2009-07-16 19:19:51 +0900 (2009-07-16, 목) $
 * -----------------------------------------------------------------------
 * @author      $Author: hoofy_leon $
 * @copyright   2006-2008 Corgan - Stefan Knaak | Wallenium & the EQdkp-Plus Developer Team
 * @link        http://eqdkp-plus.com
 * @package     eqdkp-plus
 * @version     $Rev: 5271 $
 *
 * $Id: english.php 5271 2009-07-16 10:19:51Z hoofy_leon $
 */

if ( !defined('EQDKP_INC') ){
    header('HTTP/1.0 404 Not Found');exit;
}

$plang = array_merge($plang, array(
	'offi_conf' => '오피서 회의 - 주제',
	'pk_oc_day'	=> '오피서 회의 일자',
	'pk_oc_end_time' => '오피서 회의 예정 종료 시간 (HH:MM)',
	'pk_oc_start_time' => '오피서 회의 예정 시작 시간 (HH:MM)',
	'pk_oc_time_type' => '오피서 회의 시작, 종료시간을 정하시겠습니까?',
	'oc_add_topic' => '주제 추가',
	'oc_upd_topic' => '주제 수정',
	'oc_next_topics' => '다음 주제',
	'oc_topic_name' => '이름',
	'oc_topic_time' => '이야기 시간 (분)',
	'oc_topic_posi' => '정렬',
	'oc_topic_desc' => '설명',
	'oc_save' => '저장',
	'oc_delete' => '삭제',
	'oc_save_success' => '저장 성공!',
	'oc_save_no_success' => '저장 실패!',
	'oc_delete_success' => '삭제 성공!',
	'oc_delete_no_success' => '삭제 실패!',
	'oc_no_name' => '이름 없음',
	'oc_no_desc' => '설명 없음',
	'oc_creator' => '제작자:',
	'oc_min' => 'min',
	'oc_next_oc' => '다음 오피서 회의',
    'oc_monday' => '월요일',
    'oc_tuesday' => '화요일',
	'oc_wednesday' => '수요일',
	'oc_thursday' => '목요일',
	'oc_friday' => '금요일',
	'oc_saturday' => '토요일',
	'oc_sunday' => '일요일',
	'oc_start' => '시작',
  	'oc_end' => '끝',
));
?>