<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Partner;
use App\StudentService;
use App\SocialService;
use App\Student;

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

    }

    public function createHoursCertificationForm()
    {
        $user = auth()->user();
        $partners = Partner::all();
        return view('pages.admin.certifyStudentHours')->with(['user' => $user, 'partners' => $partners]);
    }

    public function filterSocialServices(Request $request)
    {
        $services = SocialService::select('id', 'name')->where('partner_id',
            $request->id)->get();
        return response()->json($services);
    }

    public function filterStudents(Request $request)
    {
        $students = StudentService::select('id', 'studentName')->where('service_id',
            $request->id)->get();
        return response()->json($students);
    }

    public function certifyStudentHours(Request $request) {
        $studentid = $request->studentId;
        $hours = $request->certifiedHours;

        $update = \DB::table('student_services')
            ->where('id', $studentid)
            ->update(['certifiedHours' => $hours]);

        if ($update) {
            return redirect('/admin/home')->with('register-success',
                'Se han acreditado '.$hours." horas para el estudiante con matricula: ".$studentid);
        } else {
            return redirect('/admin/home')->with('register-fail', 'Ha habido un error al registrar las horas. Favor de intentar más tarde.');
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
