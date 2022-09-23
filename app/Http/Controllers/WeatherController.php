<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use Config;

use Inertia\Inertia;

use App\Models\Weathers;

class WeatherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sampleCities = Weathers::all();
        $weatherDatas = [];
        $imageDatas = [];
        // Load data
        foreach ($sampleCities as $sampleCity) {
            $getjson= Http::acceptJson()->get('https://api.openweathermap.org/data/2.5/weather?q='.$sampleCity->city_name.'&appid='.Config::get('services.openweathermap.key'));
            $weather = collect(json_decode($getjson, true));
            $weatherDatas[] = $weather->all();

            $getjson= Http::acceptJson()->get('https://pixabay.com/api/?key='.Config::get('services.pixabay.key').$sampleCity->city_name.'&image_type=photo');
            $image = collect(json_decode($getjson, true));
            $imageDatas[] = $image['hits'][0]['webformatURL'] ?? '';
        }

        return Inertia::render('Index', [
            'sampleCities' => fn() => $sampleCities->pluck('id')->toArray(),
            'weatherDatas' => $weatherDatas,
            'imageDatas' => $imageDatas,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // $sampleCities = Inertia::getShared('monitored');
        $sampleCity = new Weathers;
        $sampleCity->city_name = $request->input('new_city');
        $sampleCity->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $sampleCity = Weathers::find($request->input('id'));
        $sampleCity->delete();

        return back();
    }
}
