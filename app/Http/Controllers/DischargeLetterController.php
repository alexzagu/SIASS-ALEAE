<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DischargeLetter;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Monolog\Formatter\LogstashFormatter;
use App\StudentService;

class DischargeLetterController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.uploadDischargeLetter');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        if ($user->isAdmin()) {
            $student_service_id = $request->student_service_id;

            if ($request->hasFile('file')) {

                $file_name = $request->file('file')->getClientOriginalName();
                $file = $request->file('file');

                $url = $file->store('discharge_letters');

                if ($url) {

                    $uploaded_file = DischargeLetter::create([
                        'student_service_id' => $student_service_id,
                        'file_name' => $file_name,
                        'link' => $url,
                        'MIME' => $file->getMimeType(),
                        'uploaded_at' => now()
                    ]);

                    $service = StudentService::find($student_service_id)->first();

                    $service->dischargeLetter = $file_name;
                    $service->save();

                    if ($uploaded_file) {
                        return redirect()->back()->with('success', 'La carta finiquito ha sido guardad con éxito');
                    } else {
                        return redirect()->back()->with('fail', 'Ha habido un problema al guardar la carta finiquito.');
                    }
                }

            } else {
                return redirect()->back()->with('fail', 'No se ha proporcionado ningún archivo para guardar.');
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
    public function destroy($file_name)
    {
        $user = auth()->user();
        if ($user->isAdmin()) {
            $file = $discharge_letter = DischargeLetter::where('file_name', $file_name)->first();

            $file_deleted = Storage::delete($file->link);
            $student_service = StudentService::find($discharge_letter->student_service_id)->first();
            $student_service->dischargeLetter = "";
            $student_service->save();
            $record_deleted = $file->delete();

            if ($file_deleted && $record_deleted) {
                return redirect()->back()->with('success', 'La carta finiquito ha sido borrada con éxito');
            } else {
                return redirect()->back()->with('fail', 'Ha habido un error al querer eliminar la carta finiquito del sistema.');
            }
        }
        else {
            return redirect()->back()->with(['fail' => 'La página que solicitó no puede ser accedida.']);
        }
    }

    public function download($file_name) {
        $user = auth()->user();
        if ($user->isAdmin()) {
            $letter = DischargeLetter::where('file_name', $file_name)->first();

            $file = Storage::disk('local')->getDriver()->getAdapter()->applyPathPrefix($letter->link);

            $response = response()->download($file, $letter->file_name, ['Content-Type:' . $letter->MIME]);

            return $response;
        }
        else {
            return redirect()->back()->with(['fail' => 'La página que solicitó no puede ser accedida.']);
        }
    }
}
