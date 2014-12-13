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

if ( !defined('EQDKP_INC') ){
	header('HTTP/1.0 404 Not Found');exit;
}

$lang = array(
	'offi_conf'				=> 'Offisitzung - Themen',
	'offi_conf_name'		=> 'Offisitzungsthemen Modul',
	'offi_conf_desc'		=> 'Admins können Themen für die Offizierssitzung eintragen.',
	
	//settings
	'oc_f_day'				=> 'Tag der Offisitzung',
	'oc_f_end_time'			=> 'gewolltes Ende der Offisitzung (HH:MM)',
	'oc_f_start_time'		=> 'gewollter Anfang der Offisitzung (HH:MM)',
	'oc_f_time_type'		=> 'Start oder Ende der Offisitzung festlegen?',
	'oc_f_date'				=> 'Datum der nächsten Offisitzung',
	'oc_f_period2'			=> 'Offisitzung alle x Wochen',
	'oc_f_period3'			=> 'Offisitzung am x. Wochentag des Monats',
	'oc_f_type'				=> 'Art der Wiederholung',
	'oc_weekday'			=> 'an einem bestimmten Wochentag',
	'oc_xmonthday'			=> 'am x. Wochentag des Monats',
	'oc_manual'				=> 'manuelle Datumseingabe',
	'oc_monday'				=> 'Montag',
	'oc_tuesday'			=> 'Dienstag',
	'oc_wednesday'			=> 'Mittwoch',
	'oc_thursday'			=> 'Donnerstag',
	'oc_friday'				=> 'Freitag',
	'oc_saturday'			=> 'Samstag',
	'oc_sunday'				=> 'Sonntag',
	
	'oc_add_topic'			=> 'Thema hinzufügen',
	'oc_upd_topic'			=> 'Thema bearbeiten',
	'oc_next_topics'		=> 'Nächste Themen',
	'oc_topic_name'			=> 'Name',
	'oc_topic_time'			=> 'Besprechungsdauer (min)',
	'oc_topic_posi'			=> 'Sortierung',
	'oc_topic_desc'			=> 'Beschreibung',
	'oc_save'				=> 'Speichern',
	'oc_delete'				=> 'Löschen',
	'oc_save_success'		=> 'Speichern erfolgreich!',
	'oc_save_no_success'	=> 'Speichern nicht erfolgreich!',
	'oc_delete_success'		=> 'Löschen erfolgreich!',
	'oc_delete_no_success'	=> 'Löschen nicht erfolgreich!',
	'oc_no_name'			=> 'Kein Name',
	'oc_no_desc'			=> 'Ohne Beschreibung',
	'oc_creator'			=> 'erstellt von:',
	'oc_min'				=> 'min',
	'oc_next_oc'			=> 'Nächste Offisitzung',
	'oc_start'				=> 'Beginn',
	'oc_end'				=> 'Ende',
);
?>