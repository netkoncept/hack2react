<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use App\Models\Device;
use App\Models\DeviceAddress;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function getDevice()
    {
        return response()->json(
            [
                'device' => request()->attributes->get('device')
            ]
        );
    }

    public function index()
    {
        $devices = Device::paginate();
        return view('devices.index', compact('devices'));
    }

    public function getNotifications()
    {
        $device = request()->attributes->get('device');
        $notifications = $device->notifications()
            ->limit(10)
            ->latest()
            ->get();

        $alerts = Alert::whereIn('id', $notifications->pluck('alert_id')->toArray())
            ->with('category')
            ->get();

        return response()->json(
            [
                'notifications' => $notifications,
                'alerts' => $alerts
            ]
        );
    }

    public function getAddreses()
    {
        $device = request()->attributes->get('device');

        return response()->json(
            [
                'addreses' => $device->addreses()->get(),
            ]
        );
    }

    public function addAddres(Request $request)
    {
        $device = request()->attributes->get('device');

        $address = DeviceAddress::create([
            'device_id' => $device->id,
            'street' => $request->get('street', ''),
            'number' => $request->get('number', ''),
            'city' => $request->get('city', ''),
            'latitude' => NULL,
            'longitude' => NULL,
            'teryt_province' => 14,
            'teryt_district' => 17,
            'teryt_commune' => $request->get('teryt_commune', NULL),
            'teryt_city' => $request->get('teryt_city', NULL),
            'teryt_street' => $request->get('teryt_street', NULL),
        ]);

        return response()->json(
            [
                'message' => 'dodano',
                'address' => $address
            ]
        );
    }

    public function removeAddres(Request $request)
    {
        if ($request->has('address_id')) {
            DeviceAddress::destroy($request->get('address_id'));
        }

        return response()->json(
            [
                'message' => 'usunięto',
            ]
        );
    }

    public function getAlerts()
    {
        $today = Carbon::now();
        $alerts = Alert::whereDate('valid_to', '>=', $today)
            ->with(['category', 'area'])
            ->get();

        $alertsResponse = [];

        foreach ($alerts as $alert) {
            $coords['coords'] = $alert->coords()->toArray();
            $alertsResponse[] = array_merge($alert->toArray(), $coords);
        }

        return response()->json(
            [
                'alerts' => $alertsResponse,
            ]
        );
    }
}
