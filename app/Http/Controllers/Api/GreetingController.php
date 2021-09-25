<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGreetingRequest;
use App\Http\Resources\GreetingResource;
use App\Models\Greeting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GreetingController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $greetings = Greeting::with(['sender','receiver'])->orderBy('created_at','desc')->paginate();
        return GreetingResource::collection($greetings);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function received()
    {
        $user = Auth::user();
        $greetings = $user->received()->orderBy('created_at', 'desc')->paginate();
        return GreetingResource::collection($greetings);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sent()
    {
        $user = Auth::user();
        $greetings = $user->sent()->orderBy('created_at', 'desc')->paginate();
        return GreetingResource::collection($greetings);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreGreetingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGreetingRequest $request)
    {
        $input = $request->validated();
        $receiver = User::where('email', $input['receiver'])->first();
        $greeting = new Greeting();
        $greeting->title = $input['title'];
        $greeting->text = $input['text'];
        $greeting->sender_id = Auth::user()->id;
        $greeting->receiver_id = $receiver->id;
        $greeting->save();
        return new GreetingResource($greeting);
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
