<?php

namespace App\Http\Controllers;

use App\SocialService;
use App\Student;
use App\StudentService;
use Illuminate\Http\Request;

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
    public function index()
    {
        $userAuth = auth()->user();
        $admin = $userAuth->userInfo;

        return view('pages.user.home')->with(['user' => $userAuth, 'admin' => $admin]);
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
     * Show the form for registering a student to a social service.
     *
     * @return \Illuminate\Http\Response
     */
    public function createStudentToSocialServiceRegistrationForm()
    {
        return view('pages.admin.registerStudentToSocialService');
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
                    return redirect('admin/register-student-to-social-service')->withInput()->with('fail', 'Alumno no existe.');
                }
                if (!isset($socialService)) {
                    return redirect('admin/register-student-to-social-service')->withInput()->with('fail', 'Servicio Social no existe.');
                }

                $studentService = StudentService::create([
                    'id' => $studentID.$socialServiceID,
                    'user_id' => $studentID,
                    'service_id' => $socialServiceID,
                    'studentName' => $student->user->name,
                    'certifiedHours' => 0,
                    'status' => 'Registrado',
                    'dischargeLetter' => ''
                ]);

                if ($studentService) {
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
