<?php

namespace App\Http\Controllers;

use App\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $userInfo = $user->userInfo;

        return view('pages.user.home')->with(['user' => $user, 'userInfo' => $userInfo]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.registerPartner');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userAdmin= Auth::user();

        $initials = $request->partnerName[0].$request->partnerName[1].$request->partnerName[2];
        $initials = strtoupper($initials);

        $year = date('Y');

        $id = $initials . $year . random_int(0, 30);

        $username = $id;

        $user = User::create([
            'id' => $id,
            'name' => $request->managerName,
            'email' => $request->managerMail,
            'password' => bcrypt($request->password),
            'username' => $username,
            'role' => 'partner'
        ]);

        $userPartner = new Partner();
        $userPartner -> user_id = $user->id;
        $userPartner -> partnerName = $request->partnerName;
        $userPartner -> partnerAddress = $request->partnerAddress;
        $userPartner -> partnerEmail = $request->partnerEmail;
        $userPartner -> managerName = $request->managerName;
        $userPartner -> managerMail = $request->managerMail;
        $userPartner -> managerPhone = $request->managerPhone;
        $userPartner -> registeredBy = $userAdmin->id;
        $userPartner -> save();

        if ($user && $userPartner) {
            return redirect('/admin/home')->with('register-success',
                'El usuario se ha registrado correctamente con los siguientes datos: username:'.$username." password: ".$request->password);
        } else {

            if ($user) {
                $user->delete();
            }

            if ($userPartner) {
                $userPartner->delete();
            }

            return redirect('/admin/home')->with('register-fail', 'Ha habido un error al registrar al socio. Favor de intentar más tarde.');
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
