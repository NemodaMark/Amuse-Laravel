<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
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

    public function upload(Request $request)
{

    $validator = Validator::make($request->all(), [
        'file' => 'required|file|mimes:zip,rar|max:10240',
        'title' => 'required',
        'price' => 'required|numeric',
        'genre' => 'required',
        'description' => 'required',
    ]);

    if ($validator->fails()) {
        return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
    }

    $file = $request->file('file');
    dd($request->file('file'));

    $fileName = $file->getClientOriginalName();

    $fileExtension = $file->getClientOriginalExtension();

    if (!in_array($fileExtension, ['zip', 'rar'])) {
        return redirect()
            ->back()
            ->withErrors(['file' => 'The file must be a zip or rar.'])
            ->withInput();
    }

    $fileSize = $file->getSize();

    if ($fileSize > 10737418240) { // 10 GB
        return redirect()
            ->back()
            ->withErrors(['file' => 'The file may not be greater than 10 GB.'])
            ->withInput();
    }

    $chunks = collect(array_chunk(file($file), 512000))->map(function ($chunk) {
        return implode('', $chunk);
    });

    $url = '';

    try {
        $chunks->each(function ($chunk, $index) use ($fileName, &$url) {
            $partUrl = '/uploads/games/' . $fileName . '-' . $index . '.part';

            Storage::disk('public')->put($partUrl, $chunk);

            if ($index === 0) {
                $url = $partUrl;
            }
        });

        $game = new Game();
        $game->title = $request->title;
        $game->price = $request->price;
        $game->genreID = $request->genre;
        $game->added = now();
        $game->creator = Auth::id();
        $game->description = $request->description;
        $game->file_path = $url;
        $game->save();

        return redirect()
            ->back()
            ->with('message', 'Game has been successfully uploaded.');
    } catch (\Exception $e) {
        Storage::disk('public')->deleteDirectory('/uploads/games/' . $fileName);

        return redirect()
            ->back()
            ->withErrors(['file' => 'Something went wrong, please try again.'])
            ->withInput();
    }
}

    
}
