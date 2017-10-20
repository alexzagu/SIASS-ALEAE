<?php

namespace App\Http\Controllers;

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
