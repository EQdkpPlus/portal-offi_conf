<?php
/*
 * Project:     EQdkp-Plus
 * License:     Creative Commons - Attribution-Noncommercial-Share Alike 3.0 Unported
 * Link:		http://creativecommons.org/licenses/by-nc-sa/3.0/
 * -----------------------------------------------------------------------
 * Began:       2008
 * Date:        $Date: 2009-05-02 16:42:24 +0200 (Sa, 02 Mai 2009) $
 * -----------------------------------------------------------------------
 * @author      $Author: wallenium $
 * @copyright   2006-2008 Corgan - Stefan Knaak | Wallenium & the EQdkp-Plus Developer Team
 * @link        http://eqdkp-plus.com
 * @package     eqdkp-plus
 * @version     $Rev: 4712 $
 *
 * $Id: german.php 4712 2009-05-02 14:42:24Z wallenium $
 */

if ( !defined('EQDKP_INC') ){
    header('HTTP/1.0 404 Not Found');exit;
}

$plang = array_merge($plang, array(
	'offi_conf' => 'Offisitzung - Themen',
	'pk_oc_day'	=> 'Tag der Offisitzung',
	'pk_oc_end_time' => 'gewolltes Ende der Offisitzung (HH:MM)',
	'pk_oc_start_time' => 'gewollter Anfang der Offisitzung (HH:MM)',
	'pk_oc_time_type' => 'Start oder Ende der Offisitzung festlegen?',
	'oc_add_topic' => 'Thema hinzuf�gen',
	'oc_upd_topic' => 'Thema bearbeiten',
	'oc_next_topics' => 'N�chste Themen',
	'oc_topic_name' => 'Name',
	'oc_topic_time' => 'Besprechungsdauer (min)',
	'oc_topic_posi' => 'Sortierung',
	'oc_topic_desc' => 'Beschreibung',
	'oc_save' => 'Speichern',
	'oc_delete' => 'L�schen',
	'oc_save_success' => 'Speichern erfolgreich!',
	'oc_save_no_success' => 'Speichern nicht erfolgreich!',
	'oc_delete_success' => 'L�schen erfolgreich!',
	'oc_delete_no_success' => 'L�schen nicht erfolgreich!',
	'oc_no_name' => 'Kein Name',
	'oc_no_desc' => 'Ohne Beschreibung',
	'oc_creator' => 'erstellt von:',
	'oc_min' => 'min',
	'oc_next_oc' => 'N�chste Offisitzung',
    'oc_monday' => 'Montag',
    'oc_tuesday' => 'Dienstag',
	'oc_wednesday' => 'Mittwoch',
	'oc_thursday' => 'Donnerstag',
	'oc_friday' => 'Freitag',
	'oc_saturday' => 'Samstag',
	'oc_sunday' => 'Sonntag',
	'oc_start' => 'Beginn',
  	'oc_end' => 'Ende',
));
?>