<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Character;

class CharacterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['admin', 'dm', 'player']);

//        $request->user()->roles()->find(3);
        $characters = Character::all();
        if($request->user()->roles()->find(3))
        {
            $characters = Character::where('user_id', $request->user()->id)->get();
        }
//        $characters = Character::where;



        return view('characters.index', compact('characters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->user()->authorizeRoles(['admin', 'dm', 'player']);
        return view('characters.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->user()->authorizeRoles(['admin', 'dm', 'player']);
        $request->validate([
            'character_name'=>'required|regex:/^[a-zA-Z ]+$/',
        ]);
        $character = new Character([
            'name' => $request->get('character_name'),
        ]);
        $character->save();
        return redirect('/characters')->with('success', 'Character has been added');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $request->user()->authorizeRoles(['admin', 'dm', 'player']);
        $character = Character::find($id);

        return view('characters.edit', compact('character'));
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
        $request->user()->authorizeRoles(['admin', 'dm', 'player']);
        $request->validate([
            'character_name'=>'required',
            'level'=> 'required|integer',
            'stars' => 'required|integer',
        ]);

        $character = Character::find($id);
        $character->name = $request->get('character_name');
        $character->level = $request->get('level');
        $character->stars = $request->get('stars');
        $character->notes = $request->get('notes');
        $character->save();

        return redirect('/characters')->with('success', 'Character has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $request->user()->authorizeRoles(['admin', 'dm', 'player']);
        $character = Character::find($id);
        $character->delete();

        return redirect('/characters')->with('success', 'Character has been deleted Successfully');
    }
}
