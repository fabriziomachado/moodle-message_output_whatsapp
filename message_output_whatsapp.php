<?php

namespace message_output_whatsapp;

use core\message\message;
use core\message\message_output;

class message_output_whatsapp extends message_output {

    public function send_message(message $event) {
        $phone = $this->get_user_whatsapp_number($event->userto);
        if (!$phone) {
            return false;
        }

        $message = $event->smallmessage ?? $event->fullmessage;
        $api = get_config('message_output_whatsapp', 'api');
        $url = get_config('message_output_whatsapp', 'apiurl');

        if ($api === 'twilio') {
            $payload = [
                'To' => 'whatsapp:' . $phone,
                'From' => get_config('message_output_whatsapp', 'twilio_from'),
                'Body' => $message
            ];

            $headers = [
                'Authorization: Basic ' . base64_encode(
                    get_config('message_output_whatsapp', 'twilio_sid') . ':' .
                    get_config('message_output_whatsapp', 'twilio_token')
                ),
                'Content-Type: application/x-www-form-urlencoded'
            ];

        } elseif ($api === 'evolution') {
            $payload = [
                'number' => $phone,
                'message' => $message,
                'instanceId' => get_config('message_output_whatsapp', 'evolution_instance')
            ];

            $headers = [
                'Content-Type: application/json',
                'apikey: ' . get_config('message_output_whatsapp', 'evolution_apikey')
            ];
        } else {
            return false;
        }

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, true);

        if ($api === 'twilio') {
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
        } else {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        }

        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        // Log para depuração (apenas em modo debug)
        if (debugging()) {
            error_log("[WhatsApp] API response code: $httpcode");
            error_log("[WhatsApp] API response: $response");
        }

        return $response !== false && $httpcode >= 200 && $httpcode < 300;
    }

    private function get_user_whatsapp_number($userid) {
        global $DB;
        $sql = "SELECT d.data FROM {user_info_data} d
                JOIN {user_info_field} f ON f.id = d.fieldid
                WHERE d.userid = :userid AND f.shortname = 'whatsapp'";

        return $DB->get_field_sql($sql, ['userid' => $userid]);
    }

    public function config_form($preferences) {
        // N/A – controlado via settings.php
    }

    public function process_form($form, $preferences) {
        return true;
    }

    public function load_data(&$preferences, $userid) {
        return true;
    }

    public function is_system_configured() {
        return true;
    }
}
