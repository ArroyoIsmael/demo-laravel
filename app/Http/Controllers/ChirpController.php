<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;

use App\Models\User;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //el with ayuda a precargar la lista de usuarios
        return view('chirps.index', [
            'chirps' => Chirp::with('user')->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $validate = $request->validate([
            'message' => [
                'required',
                'min:3',
                'max:255'
            ]
        ]);

        $request->user()->chirps()->create($validate);

        return to_route('chirps.index')
            ->with('status', 'Chirp creado');
    }

    /**
     * Display the specified resource.
     */
    public function show(Chirp $chirp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirp $chirp)
    {
        $this->authorize('update',$chirp);

        return view('chirps.edit',[
            'chirp' => $chirp
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp)
    {

        $this->authorize('update',$chirp);
        //
        $validate = $request->validate([
            'message' => [
                'required',
                'min:3',
                'max:255'
            ]
        ]);

        $chirp->update($validate);

        return to_route('chirps.index')
            ->with('status', 'Chirp actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp)
    {
        //
        $this->authorize('delete',$chirp);

        $chirp->delete();

        return to_route('chirps.index')
            ->with('status', 'Chirp eliminado');

    }
}
