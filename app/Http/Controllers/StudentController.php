<?php

namespace App\Http\Controllers;

use App\StudentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Student;

class StudentController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        if ($user->isStudent()) {
            $userInfo = $user->userInfo;
            $totalCertifiedHoursSS = $userInfo->totalCertifiedHoursSS();
            $totalRegisteredHoursSS = $userInfo->totalRegisteredHoursSS();
            return view('pages.user.home')->with(['user' => $user, 'userInfo' => $userInfo,
            'totalCertifiedHoursSS' => $totalCertifiedHoursSS, 'totalRegisteredHoursSS' => $totalRegisteredHoursSS]);
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
    public function update(Request $request, $id)
    {

    }

    public function updateInductionRec(Request $request, $id) {
        $user = auth()->user();
        if ($user->isAdmin()) {
            $student = Student::find($id);

            $induction = $request->input('introductionCourseCertified')  == 'on'? 1 : 0;
            $rec = $request->input('recCourseCertified') == 'on' ? 1 : 0;

            $data = [
                'recCourseCertified' => $rec,
                'introductionCourseCertified' => $induction
            ];

            $updated = $student->fill($data)->save();

            if ($updated) {
                return redirect()->back()->with(['success' => 'La información del alumno '.$student->user->name.' ha sido actualizada con éxito.']);
            } else {
                return redirect()->back()->with(['fail' => 'La información del alumno '.$student->user->name.' no ha sido actualizada con éxito. Favor de intentar más tarde.']);
            }
        }
        else {
            return redirect()->back()->with(['fail' => 'La página que solicitó no puede ser accedida.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = auth()->user();
        if ($user->isPartner()) {
            $student = Student::find($id);
            $student->delete();

            return redirect()->back()->with('success', 'Se ha dado de baja al alumno.');
        }
        else {
            return redirect()->back()->with(['fail' => 'La página que solicitó no puede ser accedida.']);
        }
    }

    /**
     * restore the specified resource to storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function restore( $id )
    {
        $user = auth()->user();
        if ($user->isPartner()) {
            $student = Student::withTrashed()->where('user_id', '=', $id)->first();
            $student->restore();

            return redirect()->back()->with('success', 'Se ha dado de alta al alumno.');
        }
        else {
            return redirect()->back()->with(['fail' => 'La página que solicitó no puede ser accedida.']);
        }
    }
}
