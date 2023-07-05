<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAlertRequest;
use App\Http\Requests\UpdateAlertRequest;
use App\Models\Alert;
use App\Models\AlertArea;
use App\Models\AlertAreaCords;
use App\Models\Category;
use App\Services\PushNotification;
use App\Services\Teryt;

class AlertController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->view('alerts.index', [
            'alerts' => Alert::all(),
            'alert_types' => [
                1 => 'Promień',
                2 => 'Obszar',
                3 => 'Teryt',
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->view('alerts.create', [
            'categories' => Category::all(),
            'communes' => Teryt::communes(1417),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAlertRequest $request)
    {
        $alertObj = Alert::create([
            'title' => $request['title'],
            'description' => $request['description'],
            'category_id' => $request['category_id'],
            'valid_from' => $request['valid_from'],
            'valid_to' => $request['valid_to'],
        ]);

        PushNotification::push($alertObj);

        $alertArea['alert_id'] = $alertObj->id;
        $alertAreaData = [];

        if ($request['alert-area-type'] === '0') {
            $latLngs = json_decode($request['area-lat-lngs']);
            if ($request['area-type'] === 'radius') {
                $alertArea['type'] = 1;
                $alertAreaData[] = [
                    'lat' => $latLngs->lat,
                    'lng' => $latLngs->lng,
                ];
                $alertAreaData[] = [
                    'lat' => $request['area-radius'],
                    'lng' => $request['area-radius']
                ];
            } elseif ($request['area-type'] === 'polygon') {
                $alertArea['type'] = 2;
                foreach ($latLngs[0] as $latLng) {
                    $alertAreaData[] = [
                        'lat' => $latLng->lat,
                        'lng' => $latLng->lng,
                    ];
                }
            }
        } else {
            $alertArea['type'] = 3;
            $alertAreaData['teryt_commune'] = !empty($request['teryt-commune']) ? $request['teryt-commune'] : null;
            $alertAreaData['teryt_city'] = !empty($request['teryt-city']) ? $request['teryt-city'] : null;
            $alertAreaData['teryt_street'] = !empty($request['teryt-street']) ? $request['teryt-street'] : null;
        }

        $alertAreaObj = AlertArea::create($alertArea);

        if ($request['alert-area-type'] === '0') {
            foreach ($alertAreaData as $data) {
                AlertAreaCords::create([
                    'alert_area_id' => $alertAreaObj->id,
                    'lat' => $data['lat'],
                    'lng' => $data['lng'],
                ]);
            }
        } else {
            AlertAreaCords::create([
                'alert_area_id' => $alertAreaObj->id,
                'teryt_commune' => $alertAreaData['teryt_commune'],
                'teryt_city' => $alertAreaData['teryt_city'],
                'teryt_street' => $alertAreaData['teryt_street'],
            ]);
        }

        session()->flash('flash.banner', 'Dodano alert: ' . $request->get('title'));
        return to_route('alerts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Alert $alert)
    {
        return response()->view('alerts.show', [
            'alert' => $alert
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alert $alert)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAlertRequest $request, Alert $alert)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alert $alert)
    {
        //
    }
}
