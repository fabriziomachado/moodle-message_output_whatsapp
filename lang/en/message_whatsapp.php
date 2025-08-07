<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 *  Whatsapp message processor language information
 *
 * @package    message_whatsapp
 * @copyright  2022 Cognize Learning
 * @author     Abhishek Kumar <abhishek@cognizelearning.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
$settings->add(new admin_setting_configselect(
    'message_output_whatsapp/api',
    'API WhatsApp',
    'Selecione qual API utilizar para envio de mensagens.',
    'twilio',
    ['twilio' => 'Twilio', 'evolution' => 'EvolutionAPI']
));

$settings->add(new admin_setting_configtext('message_output_whatsapp/apiurl', 'URL da API', 'Endpoint da API de envio de mensagens.', ''));

$settings->add(new admin_setting_configtext('message_output_whatsapp/twilio_sid', 'Twilio SID', '', ''));
$settings->add(new admin_setting_configtext('message_output_whatsapp/twilio_token', 'Twilio Token', '', ''));
$settings->add(new admin_setting_configtext('message_output_whatsapp/twilio_from', 'Twilio From (whatsapp:+)', '', ''));

$string['pluginname'] = 'Whatsapp';
$string['accountsid'] = 'Account SID';
$string['accountsid_desc'] = 'Twillio Account SID';
$string['authtoken'] = 'Auth Token';
$string['authtoken_desc'] = 'Twillio Auth Token';
$string['senderno'] = 'Sender Whatsapp No';
$string[''] = '';
$string[''] = '';
$string[''] = '';
$string[''] = '';
$string[''] = '';
$string[''] = '';
$string[''] = '';
$string[''] = '';
$string[''] = '';
$string[''] = '';
$string[''] = '';
$string[''] = '';
$string[''] = '';
$string[''] = '';
$string[''] = '';
$string[''] = '';
$string[''] = '';
$string[''] = '';
$string[''] = '';
$string[''] = '';
$string[''] = '';
$string[''] = '';
$string[''] = '';
