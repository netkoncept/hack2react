<?php

namespace App\Services;

use App\Models\Alert;
use App\Models\AlertDeviceNotification;
use App\Models\Device;
use GuzzleHttp\Client;

class PushNotification
{
    public static function push(Alert $alert)
    {
        $curl = curl_init();

        $devices = Device::where('push_id', '!=', '')
            ->get();

        if ($devices->count() > 0) {
            $registrationIds = [];

            foreach ($devices as $device) {
                AlertDeviceNotification::create([
                    'alert_id' => $alert->id,
                    'device_id' => $device->id,
                ]);
                $registrationIds[] = $device->push_id;
            }

            curl_setopt_array($curl, [
                CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_POSTFIELDS => json_encode([
                    'registration_ids' => $registrationIds,
                    'notification' => [
                        'body' => $alert->description ?? '',
                        'title' => $alert->title
                    ],
                    'data' => [
                        'body' => $alert->description ?? '',
                        'title' => $alert->title,
                        'alert_id' => $alert->id
                    ]
                ]),
                CURLOPT_HTTPHEADER => [
                    "Authorization:key=" . env('PUSH_TOKEN'),
                    "cache-control: no-cache",
                    "content-type: application/json"
                ],
            ]);

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);
        }

        return $response ?? NULL;
    }
}
