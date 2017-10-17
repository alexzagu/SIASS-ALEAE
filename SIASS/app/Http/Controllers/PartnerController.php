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

        $defaultPasswordChanged = $userInfo->defaultPasswordChanged;

        if ($defaultPasswordChanged == 0) {
            return view('pages.partner.changeDefaultPassword')->with(['user' => $user, 'userInfo' => $userInfo]);
        }
        else {
            return view('pages.user.home')->with(['user' => $user, 'userInfo' => $userInfo]);
        }
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
     * Show the form for registering a student to a social service
     *
     * @return \Illuminate\Http\Response
     */
    public function createStudentToSocialServiceRegistrationForm()
    {
        return view('pages.partner.registerStudentToSocialService');
    }

    /**
     * Show the form for changing a Partner's default password
     *
     * @return \Illuminate\Http\Response
     */
    public function changeDefaultPasswordForm()
    {
        return view('pages.partner.changeDefaultPassword');
    }

    /**
     * Changes a Partner's default password
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changeDefaultPassword(Request $request)
    {

        $newPassword = $request->newPassword;
        $newPasswordConfirm = $request->newPasswordConfirm;

        $uppercase = preg_match('@[A-ZÑ]@', $newPassword);
        $lowercase = preg_match('@[a-zñ]@', $newPassword);
        $number    = preg_match('@[0-9]@', $newPassword);
        $special_char = preg_match('@[_.,!#$%]@', $newPassword);

        if(!$uppercase || !$lowercase || !$number || !$special_char || strlen($newPassword) < 8) {
            // The new password doesn't respect the format
            return redirect('/partner/change-default-password')->with('default-password-changed-fail',
                'Error al intentar cambiar la contraseña default. La contraseña no respeta el formato establecido.');
        }
        else if (strcmp($newPassword, $newPasswordConfirm) != 0) {
            // Passwords are not the same
            return redirect('/partner/change-default-password')->with('default-password-changed-fail',
                'Error al intentar cambiar la contraseña default. Las contraseñas no coinciden; deben ser las mismas');
        }
        else {
            //Everything cool, proceed to store the password

            $partnerId = Auth::User()->id;

            //We need to use it as user to change the password
            $user = User::find($partnerId);
            $user->password = bcrypt($newPassword);
            $user->save();

            //Then, we need to use it as a partner to change de defaultPasswordChanged field
            $partner = Partner::find($partnerId);
            $partner->defaultPasswordChanged = 1;
            $partner->save();

            return redirect('/partner/home')->with('default-password-changed-success',
                'La contraseña default se ha cambiado correctamente');
        }

    }

    /**
     * Create a new StudentService object and store it.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeStudentServiceObject(Request $request)
    {

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
