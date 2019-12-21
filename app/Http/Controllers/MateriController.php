<?php

namespace App\Http\Controllers;

use App\Materi;
use Illuminate\Http\Request;

use File;

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
        $request->validate([
            'judul_materi' => 'required|string|max:191',
            'filename' => 'required|string|max:191'
        ]);
        Materi::create($request->all());

        return redirect('materi')->with('success', 'Materi berhasil diupload.');
    }

    public function handleUpload(Request $request)
    {
        $request->validate([
            'video' => 'required|max:51200'
        ]);

        $filename = time().'_'.str_replace(' ', '_', $request->judul_materi).'.'.$request->video->extension();

        if ($request->video->move(public_path('materi_uploads'), $filename)) {
            return response()->json(['status' => 'success', 'filename' => $filename], 200);
        } else {
            return response()->json(['status' => 'failed'], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function show(Materi $materi)
    {
        return view('pages.materi-detail', compact('materi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function edit(Materi $materi)
    {
        return view('pages.materi-edit', compact('materi'));
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
        $request->validate([
            'judul_materi' => 'required|string|max:191'
        ]);
        if ($request->filled('filename')) {
            File::delete(public_path('materi_uploads/'.$request->old_filename));
            $data = $request->all();
        } else {
            $data = $request->except('filename');
        }
        $materi->update($data);

        return redirect('materi')->with('success', 'Materi berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Materi $materi)
    {
        if ($materi->delete()) {
            File::delete(public_path('materi_uploads/'.$materi->filename));

            return redirect('materi')->with('success', 'Materi berhasil dihapus');
        } else {
            return redirect('materi')->with('failed', 'Materi gagal dihapus');
        }
    }
}
