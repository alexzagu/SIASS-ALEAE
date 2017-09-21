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
        //
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


       return redirect('/admin/home');
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
