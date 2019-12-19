<?php

namespace App\Http\Controllers;

use App\Materi;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth_is_admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materis = Materi::all();
        return view('pages.materi', compact('materis'));
        // return view('pages.materi');
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

    public function handleUpload(Request $request)
    {
        $request->validate([
            'video' => 'required|max:51200'
        ]);

        $filename = time().'.'.$request->video->extension();

        if ($request->video->move(public_path('materi_uploads'), $filename)) {
            return response()->json(['status' => 'success'], 200);
        } else {
            return "s";
        }

        // return redirect('materi')->with('success', 'File uploaded')->with('filename', $filename);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function show(Materi $materi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function edit(Materi $materi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Materi $materi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Materi $materi)
    {
        //
    }
}
