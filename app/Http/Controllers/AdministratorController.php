<?php

namespace App\Http\Controllers;

use App\SocialService;
use App\Student;
use App\StudentService;
use App\Partner;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdministratorController extends Controller
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
    public function index() {
        $userAuth = auth()->user();
        if ($userAuth->isAdmin()) {
            $admin = $userAuth->userInfo;
            return view('pages.user.home')->with(['user' => $userAuth, 'admin' => $admin]);
        }
        else {
            return redirect()->back()->with(['fail' => 'La página que solicitó no puede ser accedida.']);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Show the form for registering a student to a social service.
     *
     * @return \Illuminate\Http\Response
     */
    public function createStudentToSocialServiceRegistrationForm() {
        $userAuth = auth()->user();
        if ($userAuth->isAdmin()) {
            return view('pages.admin.registerStudentToSocialService');
        }
        else {
            return redirect()->back()->with(['fail' => 'La página que solicitó no puede ser accedida.']);
        }
    }

    /**
     * Create a new StudentService object and store it.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeStudentServiceObject(Request $request) {
        $userAuth = auth()->user();
        if ($userAuth->isAdmin()) {
            if ($request->filled('studentID') && $request->filled('socialServiceID')) {
                $studentID = $request->studentID;
                $socialServiceID = $request->socialServiceID;
                $socialService = SocialService::find($socialServiceID);
                if ($studentID[0] == 'A' && strlen($socialServiceID) == 11) {
                    $student = Student::find($studentID);
                    $socialService = SocialService::find($socialServiceID);
                    if (!isset($student)) {
                        return redirect('admin/register-student-to-social-service')->withInput()->with('fail', 'Alumno no existe.');
                    }
                    if (!isset($socialService)) {
                        return redirect('admin/register-student-to-social-service')->withInput()->with('fail', 'Servicio Social no existe.');
                    }

                    if ($socialService->currentCapability >= $socialService->capability) {
                        return redirect('admin/register-student-to-social-service')->withInput()->with('fail', 'El servicio está lleno.');
                    }

                    if (StudentService::where('user_id', $studentID)->where('service_id', $socialServiceID)->first()) {
                        return redirect('admin/register-student-to-social-service')->withInput()->with('fail', 'El alumno ya está registrado.');
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
                        return redirect('admin/home')->with('success', 'Se registró el alumno al servicio social con éxito.');
                    }
                    else {
                        return redirect('admin/home')->with('fail', 'Ha ocurrido un error al registrar al alumno al servicio estudiantil. Favor de intentar de nuevo');
                    }
                }
                else {
                    return redirect('admin/register-student-to-social-service')->withInput()->with('fail', 'Formato de entrada erróneo.');
                }
            }
            else {
                return redirect('admin/register-student-to-social-service')->withInput()->with('fail', 'Los dos campos deben ser llenados.');
            }
        }
        else {
            return redirect()->back()->with(['fail' => 'La página que solicitó no puede ser accedida.']);
        }
    }

    public function certifyStudentInductionCourse(Request $request) {
        $userAuth = auth()->user();
        if ($userAuth->isAdmin()) {
            $id = $request->user_id;

            if ($id) {
                $student = Student::find($id);

                if ($student) {
                    return view('pages.admin.certifyInductionRec')->with(['student' => $student]);
                } else {
                    return redirect()->back()->with(['fail' => 'No se ha encontrado registro de ningún alumno con la matrícula: '.$id.'. Favor de verificar la información e intentar de nuevo.']);
                }
            } else {
                return view('pages.admin.certifyInductionRec');
            }
        }
        else {
            return redirect()->back()->with(['fail' => 'La página que solicitó no puede ser accedida.']);
        }
    }

    public function updatePartnerForm(Request $request){
        $userAuth = auth()->user();
        if ($userAuth->isAdmin()) {
            $id = $request->user_id;

            if ($id) {
                $partner = Partner::find($id);

                if ($partner) {
                    return view('pages.admin.updatePartner')->with(['partner' => $partner]);
                } else {
                    return redirect()->back()->with(['fail' => 'No se ha encontrado registro de ningún socio con la clave: '.$id.'. Favor de verificar la información e intentar de nuevo.']);
                }
            } else {
                return view('pages.admin.updatePartner');
            }
        }
        else {
            return redirect()->back()->with(['fail' => 'La página que solicitó no puede ser accedida.']);
        }
    }

    public function unsubscribePartner(Request $request) {
        $userAuth = auth()->user();
        if ($userAuth->isAdmin()) {
            $id = $request->user_id;

            if ($id) {
                $partner = Partner::withTrashed()->where('user_id', '=', $id)->first();

                if ($partner) {
                    return view('pages.admin.unsubscribePartner')->with(['partner' => $partner]);
                } else {
                    return redirect()->back()->with(['fail' => 'No se ha encontrado registro de ningún socio con la clave: '.$id.'. Favor de verificar la información e intentar de nuevo.']);
                }
            } else {
                return view('pages.admin.unsubscribePartner');
            }
        }
        else {
            return redirect()->back()->with(['fail' => 'La página que solicitó no puede ser accedida.']);
        }
    }

    public function showStudentInfoForm(Request $request) {
        $userAuth = auth()->user();
        if ($userAuth->isAdmin()) {
            $id = $request->user_id;

            if ($id) {
                $student = Student::find($id);

                if ($student) {
                    $user = $student->user;
                    $totalCertifiedHoursSS = $student->totalCertifiedHoursSS();
                    $totalRegisteredHoursSS = $student->totalRegisteredHoursSS();
                    return view('pages.admin.showStudentInfo')->with(['user' => $user, 'student' => $student,
                    'totalCertifiedHoursSS' => $totalCertifiedHoursSS, 'totalRegisteredHoursSS' => $totalRegisteredHoursSS]);
                } else {
                    return redirect()->back()->with(['fail' => 'No se ha encontrado registro de ningún alumno con la matrícula: '.$id.'. Favor de verificar la información e intentar de nuevo.']);
                }
            } else {
                return view('pages.admin.showStudentInfo');
            }
        }
        else {
            return redirect()->back()->with(['fail' => 'La página que solicitó no puede ser accedida.']);
        }
    }

    public function createHoursCertificationForm()
    {
        $userAuth = auth()->user();
        if ($userAuth->isAdmin()) {
            $user = auth()->user();
            $partners = Partner::all();
            return view('pages.admin.certifyStudentHours')->with(['user' => $user, 'partners' => $partners]);
        }
        else {
            return redirect()->back()->with(['fail' => 'La página que solicitó no puede ser accedida.']);
        }
    }

    public function filterSocialServices(Request $request)
    {
        $services = SocialService::select('id', 'name')->where('partner_id', $request->id)->get();
        return response()->json($services);
    }

    public function filterStudents(Request $request)
    {
        $students = StudentService::select('id', 'user_id', 'studentName')->where('service_id', $request->id)->get();
        return response()->json($students);
    }

    public function certifyStudentHours(Request $request) {
        $userAuth = auth()->user();
        if ($userAuth->isAdmin()) {
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
                return redirect('/admin/home')->with('success',
                    'Se han acreditado '.$hours." horas para el estudiante con matrícula: ".$student->user_id);
            }
            else {
                return redirect()->back()->with('fail', 'Ha ocurrido un error al registrar las horas. Favor de intentar más tarde.');
            }
        }
        else {
            return redirect()->back()->with(['fail' => 'La página que solicitó no puede ser accedida.']);
        }
    }

    public function uploadDischargeLetter(Request $request) {
        $userAuth = auth()->user();
        if ($userAuth->isAdmin()) {
            $id = $request->student_id;

            if ($id) {
                $student = Student::find($id);
                $student_services = $student->studentServices;

                if ($student) {
                    return view('pages.admin.uploadDischargeLetter')->with(['student' => $student, 'student_services' => $student_services]);
                } else {
                    return redirect()->back()->with(['fail' => 'No se ha encontrado registro de ningún alumno con la matrícula: '.$id.'. Favor de verificar la información e intentar de nuevo.']);
                }
            } else {
                return view('pages.admin.uploadDischargeLetter');
            }
        }
        else {
            return redirect()->back()->with(['fail' => 'La página que solicitó no puede ser accedida.']);
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
