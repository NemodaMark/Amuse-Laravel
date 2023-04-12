<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;


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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function balance()
    {
        $userId = auth()->user()->id;

        // Retrieve the user's balance from the database using the ID
        $wallet = DB::select("SELECT balance FROM users WHERE id = ?", [$userId]);
    
        // Pass the balance to the 'balance' view
        return view('balance', ['userBalance' => $wallet[0]->balance]);
    }

    public function pay(Request $request)
    {
        $userId = auth()->user()->id;
    $amount = $request->input('amount');

    $wallet = DB::select("SELECT balance FROM users WHERE id = ?", [$userId]);
    $balance = $wallet[0]->balance;

    $newBalance = $balance + $amount;

    // Update the user's balance in the database
    DB::update("UPDATE users SET balance = ? WHERE id = ?", [$newBalance, $userId]);

    // Set the success message for the toaster
    $message = $amount . '€ has been added to your account';

    // Store the message in the session
    Session::flash('success_message', $message);

    // Redirect back to the wallet page with the user's new balance
    return Redirect::route('wallet')->with(['userBalance' => $newBalance]);
    }


    public function game()
    {
        $genres = DB::select("SELECT * FROM `genres`");
        return view('gameUpload',['genres'=>$genres]);
    }
}
