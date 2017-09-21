<?php

namespace App\Http\Controllers;

use App\SocialService;
use Dotenv\Validator;
use Illuminate\Http\Request;

class SocialServiceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.partner.registerSocialService');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        $id = str_random(10);

        $socialService = SocialService::create([
            'id' => $id,
            'partner_id' => $user->id,
            'name' => $request->name,
            'description' => $request->description,
            'totalHours' => $request->totalHours,
            'address' => $request->address,
            'managerName' => $request->managerName,
            'managerMail' => $request->managerMail,
            'managerPhone' => $request->managerPhone,
            'capability' => $request->capability,
            'currentCapability' => 0,
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
            'type' => $request->type,
            'period' => $request->period,
            'campus' => $request->campus
        ]);

        if ($socialService) {
            return redirect('/partner/home')->with('register-success', 'Se ha registrado el nuevo servicio social con éxito');
        } else {
            return redirect('/partner/home')->with('register-fail', 'Ha ocurrido un error al registrar el servicio social. Favor de intentar de nuevo');
        }
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
