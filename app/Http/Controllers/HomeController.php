<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $uplevel = $user->uplevel();
        return view('home',compact('user','uplevel'));
    }

    public function distribution(Request $request){
        $user = Auth::user();


        $uplevel = $user->uplevel();

        $upuplevel = $uplevel->uplevel();
        $bonus = $request->input('credit');

        self::distribution_logic($user,$uplevel,$upuplevel,$bonus);

        self::activeUser($user);
        return redirect('/home');

    }

    public function distribution_logic($tier1,$tier2,$tier3,$bonus){
        $total = $bonus;
        $tier1->credit += $bonus*0.1;
        $tier1->save();
        $total -= $bonus*0.1;
        $tier2->credit += $bonus*0.15;
        $tier2->save();
        $total -= $bonus*0.15;

        $tier3Achievement = $tier3->downlevels;
        $tem = 0;
        foreach ($tier3Achievement as $item){
            if($item->actived == 1){
                $tem++;
            }
        }
        if($tem>4 || ($tier1->equal($tier2->fistdownlevel()) && $tier1->actived == 0)){
            $tier3->credit += $bonus*0.05;
            $tier3->save();
            $total -= $bonus*0.05;

        }
        self::signCompany($total);



    }

    private function activeUser($user){

        if($user->actived == 0){
            $user->actived = 1;
            $user->save();
        }

    }

    private function signCompany($total){
        $user = User::find(1);
        $user->credit += $total;
        $user->save();
    }
}
