<?php

namespace App\Http\Controllers;

use App\SocialService;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Partner;
use App\Period;
use App\Sensibilization;

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
        $user = auth()->user();

        //$partners = DB::table('users')
            //->join('partners', 'users.id', '=', 'partners.user_id')
            //->select('users.*', 'partners.partnerName')
            //->get();

        $partners = Partner::all();
        $periods = Period::orderBy('id', 'desc')->get();

        return view('pages.partner.registerSocialService')->with(['user' => $user, 'partners' => $partners, 'periods' => $periods]);

    }

    /**
     * Confirms the information passed on the create form before creating a new entry en database
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function confirm(Request $request) {

        $user = auth()->user();
        $input = $request->all();

        $sensibilization = $request->sensibilization;

        if ($sensibilization == null) {
            return redirect()->back()->withInput()->withErrors(['no_competence_selected' => 'Necesita seleccionar al menos una competencia']);
        } else {
            return view('pages.user.confirmSocialService')->with(['user' => $user, 'input' => $input]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->edit) {
            return redirect('admin/register-social-service')->withInput();
        }

        $user = auth()->user();

        $id = str_random(11);

        $partnerid = $user -> id;

        $sensibilization = $request->sensibilization;

        $ethical_recognition = false;
        $empathy = false;
        $moral_judgement = false;

        foreach($sensibilization as $selected) {
            switch ($selected) {
                case 'Reconocimiento ético':
                    $ethical_recognition = true;
                    break;
                case 'Empatía':
                    $empathy = true;
                    break;
                case 'Juicio moral':
                    $moral_judgement = true;
                    break;
            }
        }


        if($user->isAdmin()){
            $partnerid = $request->get('partner_id');
        }

        $socialService = SocialService::create([
            'id' => $id,
            'partner_id' => $partnerid,
            'name' => $request->name,
            'description' => $request->description,
            'totalHours' => $request->totalHours,
            'address' => $request->address,
            'managerName' => $request->managerName,
            'managerMail' => $request->managerMail,
            'managerPhone' => $request->managerPhone,
            'capability' => $request->capability,
            'currentCapability' => 0,
            'startDate' => Carbon::parse($request->startDate)->toDateTimeString(),
            'endDate' => Carbon::parse($request->endDate)->toDateTimeString(),
            'type' => 'SSC',
            'social_cause' => $request->social_cause,
            'period' => $request->period,
            'campus' => $request->campus
        ]);

        $sensibilizationRecord = Sensibilization::create([
                'social_service_id' => $socialService->id,
                'ethical_recognition' => $ethical_recognition,
                'empathy' => $empathy,
                'moral_judgement' => $moral_judgement
        ]);

        if ($user->isAdmin()){
            if ($socialService && $sensibilizationRecord) {
                return redirect('admin/home')->with('success', 'Se ha registrado el nuevo servicio social con éxito');
            } else {
                return redirect('admin/home')->with('fail', 'Ha ocurrido un error al registrar el servicio social. Favor de intentar de nuevo');
            }
        }
        else{
            if ($socialService && $sensibilizationRecord) {
                return redirect('/partner/home')->with('success', 'Se ha registrado el nuevo servicio social con éxito');
            } else {
                return redirect('/partner/home')->with('fail', 'Ha ocurrido un error al registrar el servicio social. Favor de intentar de nuevo');
            }
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
