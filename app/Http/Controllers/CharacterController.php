<?php

namespace App\Http\Controllers;

use App\CharacterStat;
use Illuminate\Http\Request;
use App\Character;
use Illuminate\Support\Facades\Redirect;

class CharacterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
//        $this->middleware('checkExp')->only('levelUp');
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
        $sort = request()->get('sort');
        if(!$sort){
            $sort = "favorite";
        }
        $characters = Character::all()->sortBy($sort);

        if($request->user()->roles()->find(3))
        {
            $characters = Character::where('user_id', $request->user()->id)->orderBy($sort)->get();
        }


        return view('characters.index', compact('characters'), compact('sort'));
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
        $character->user_id = $request->user()->id;
        $character->save();
        return redirect('/characters')->with('success', 'Character has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  Character $character
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Character $character)
    {
        $request->user()->authorizeRoles(['admin', 'dm', 'player']);

        if($request->user()->roles()->find(3))
        {
            if($character->user_id != $request->user()->id){
                return redirect('/characters')->with('success', 'You have no power here.');
            }
        }

        return view('characters.show', compact('character'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Character $character
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Character $character, Request $request)
    {
        $request->user()->authorizeRoles(['admin', 'dm', 'player']);

        return view('characters.edit', compact('character'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Character $character
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Character $character)
    {
        $request->user()->authorizeRoles(['admin', 'dm', 'player']);
        $request->validate([
            'character_name'=>'required',
            'level'=> 'required|integer',
            'stars' => 'required|integer',
        ]);

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


    public function search()
    {
        $query = request()->get('query');
        if(empty($query)){
            return redirect('/characters');
        }

        $characters = request()->user()->characters()->where('name', 'like', '%'.$query.'%')->orWhere('notes', 'like', '%'.$query.'%')->get();

        return view('characters.index', compact('characters'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function switchFav(Request $request, $id){
        $decodedCharacter = json_decode($request->character);
        $character = Character::find($id);
        $character->favorite = !$decodedCharacter->favorite;
        $character->save();

        return redirect()->route('characters.index');
    }

    public function getExp(Request $request, $id){

        $character = Character::find($id);
        $character->experience = $character->experience + 10;
        $character->save();

        return redirect()->route('characters.show', compact('character'));
    }


    public function levelUp(Request $request, $id){

        $character = Character::find($id);
        if ($character->experience >= 100){

            $character->experience = $character->experience - 100;
            $character->level = $character->level + 1;
        }

        $character->save();

        return redirect()->route('characters.show', compact('character'));
    }
}
