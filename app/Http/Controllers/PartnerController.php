<?php

namespace App\Http\Controllers;

use App\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Student;
use App\SocialService;
use App\StudentService;
use Carbon\Carbon;


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

        if ($request->password != $request->passwordConfirm) {
            return redirect()->back()->with('fail', 'La contraseña no coincide con la confirmación, favor de verificarla e intentar de nuevo.')->withInput();
        }

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
        $userPartner -> defaultPasswordChanged = false;
        $userPartner -> save();

        if ($user && $userPartner) {
            return redirect('/admin/home')->with('success',
                'El usuario se ha registrado correctamente con los siguientes datos: username:'.$username." password: ".$request->password);
        } else {

            if ($user) {
                $user->delete();
            }

            if ($userPartner) {
                $userPartner->delete();
            }

            return redirect('/admin/home')->with('fail', 'Ha habido un error al registrar al socio. Favor de intentar más tarde.');
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
            return redirect('/partner/change-default-password')->with('fail',
                'Error al intentar cambiar la contraseña default. La contraseña no respeta el formato establecido.');
        }
        else if (strcmp($newPassword, $newPasswordConfirm) != 0) {
            // Passwords are not the same
            return redirect('/partner/change-default-password')->with('fail',
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

            return redirect('/partner/home')->with('success',
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
        if ($request->filled('studentID') && $request->filled('socialServiceID')) {
            $studentID = $request->studentID;
            $socialServiceID = $request->socialServiceID;
            if ($studentID[0] == 'A' && strlen($socialServiceID) == 11) {
                $student = Student::find($studentID);
                $socialService = SocialService::find($socialServiceID);
                if (!isset($student)) {
                    return redirect('partner/register-student-to-social-service')->withInput()->with('fail', 'Alumno no existe.');
                }
                if (!isset($socialService)) {
                    return redirect('partner/register-student-to-social-service')->withInput()->with('fail', 'Servicio Social no existe.');
                }

                if ($socialService->currentCapability >= $socialService->capability) {
                    return redirect('partner/register-student-to-social-service')->withInput()->with('fail', 'El servicio está lleno.');
                }

                if (StudentService::where('user_id', $studentID)->where('service_id', $socialServiceID)->first()) {
                    return redirect('partner/register-student-to-social-service')->withInput()->with('fail', 'El alumno ya está registrado.');
                }

                $studentService = StudentService::create([
                    'id' => $studentID.$socialServiceID,
                    'user_id' => $studentID,
                    'service_id' => $socialServiceID,
                    'studentName' => $student->user->name,
                    'certifiedHours' => 0,
                    'registeredHours' => $socialService->totalHours,
                    'status' => 'Registrado',
                    'dischargeLetter' => ''
                ]);

                if ($studentService) {
                    $socialService->currentCapability += 1;
                    $socialService->save();
                    if ($socialService->type == 'SSC') {
                        $student->totalRegisteredHoursSSC += $socialService->totalHours;
                    }
                    elseif ($socialService->type == 'SSP') {
                        $student->totalRegisteredHoursSSP += $socialService->totalHours;
                    }
                    $student->save();
                    return redirect('partner/home')->with('success', 'Se ha registrado el nuevo servicio estudiantil con éxito.');
                }
                else {
                    return redirect('partner/home')->with('fail', 'Ha ocurrido un error al registrar el servicio estudiantil. Favor de intentar de nuevo');
                }
            }
            else {
                return redirect('partner/register-student-to-social-service')->withInput()->with('fail', 'Formato de entrada erróneo.');
            }
        }
        else {
            return redirect('partner/register-student-to-social-service')->withInput()->with('fail', 'Los dos campos deben ser llenados.');
        }
    }

    public function updatePartner(Request $request, $id) {

        $partner = Partner::find($id);

        $partnerName = $request->input('partnerName');
        $partnerAddress = $request->input('partnerAddress');
        $partnerEmail = $request->input('partnerEmail');
        $managerName = $request->input('managerName');
        $managerMail = $request->input('managerMail');
        $managerPhone = $request->input('managerPhone');

        $data = [
            'partnerName' => $partnerName,
            'partnerAddress' => $partnerAddress,
            'partnerEmail' => $partnerEmail,
            'managerName' => $managerName,
            'managerMail' => $managerMail,
            'managerPhone' => $managerPhone
        ];

        $updated = $partner->fill($data)->save();

        if ($updated) {
            return redirect()->back()->with(['success' => 'La información del socio '.$partner->partnerName.' ha sido actualizada con éxito.']);
        } else {
            return redirect()->back()->with(['fail' => 'La información del socio '.$partner->partnerName.' no ha sido actualizada con éxito. Favor de intentar más tarde.']);
        }
    }

    public function createHoursCertificationForm()
    {
        $user = auth()->user();

        //$services = SocialService::select('id', 'name')->where('partner_id', $user->id);
        $services = SocialService::select('id', 'name')->where('partner_id',
            $user->id)->get();
        //$services = SocialService::all();
        return view('pages.partner.certifyStudentHours')->with(['user' => $user, 'services' => $services]);
    }

    public function filterStudents(Request $request)
    {
        $studentsServices = StudentService::select('id','user_id','studentName')->where('service_id',
            $request->id)->get();
        return response()->json($studentsServices);
    }

    public function certifyStudentHours(Request $request) {
        $studentServiceID = $request->studentServiceId;
        $hours = $request->certifiedHours;

        $studentService = StudentService::find($studentServiceID);

        $studentService->certifiedHours = $hours;
        $studentService->status = 'Completado';

        $socialService = $studentService->socialService;
        $student = $studentService->student;

        if ($socialService->type == 'SSC') {
            $student->totalRegisteredHoursSSC -= $studentService->registeredHours;
            $student->totalCertifiedHoursSSC += $hours;
        }
        elseif ($socialService->type == 'SSP'){
            $student->totalRegisteredHoursSSP -= $studentService->registeredHours;
            $student->totalCertifiedHoursSSP += $hours;
        }

        if ($studentService->save() && $student->save()) {
            if ($student->totalCertifiedHoursSS() >= 480 && $student->isCertified == 0) {
                $student->isCertified = 1;
                $student->certificationDate = Carbon::now();
                $student->save();
            }
            return redirect('/partner/home')->with('success',
                'Se han acreditado '.$hours." horas para el estudiante con matrícula: ".$student->user_id);
        }
        else {
            return redirect()->back()->with('fail', 'Ha ocurrido un error al registrar las horas. Favor de intentar más tarde.');
        }
    }

    public function dropStudent(Request $request) {
        $user = auth()->user();
        $services = SocialService::select('id', 'name')->where('partner_id',
            $user->id)->get();

        $id = $request->serviceId;

        if ($id) {
            $studentsServices = StudentService::select('id','user_id','studentName')->where(
                'service_id',$id)->get();
            $ssaux = StudentService::where('service_id',$id)->get()->first();
            $studentid = $ssaux->user_id;
            $student = Student::find($studentid);
            //dd($student->deleted_at);
            if ($studentsServices) {
                return view('pages.partner.dropStudent')->with(['user' => $user, 'services' => $services, 'students' => $studentsServices, 'delete' => $student]);
            }
            else {
                dd('error');
            }
        } else {
            return view('pages.partner.dropStudent')->with(['user' => $user, 'services' => $services]);
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
        $partner = Partner::find($id);
        $partner->delete();

       return redirect()->back()->with('success', 'Se ha dado de baja al socio formador');

    }

    /**
     * restore the specified resource to storage.
     *
     * @param  int  $id
     * @return Response
     */

    public function restore( $id )
    {
        $partner = Partner::withTrashed()->where('user_id', '=', $id)->first();

        //Restauramos el registro
        $partner->restore();

        return redirect()->back()->with('success', 'Se ha dado de alta al socio formador');
    }


}
