<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use function Ramsey\Uuid\v1;
use Laravel\Socialite\Facades\Socialite;
use Session;
use App\Models\User;
use App\Models\StockDetail;
use Auth;
use Exception;

class StockController extends Controller
{
    public function fbbutton()
    {
        return view('login');
    }

    public function fblogin()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function fbres()
    {
        $user = Socialite::driver('facebook')->stateless()->user();

        $finduser = User::where('social_id', $user->id)->first();

        if ($finduser) {

            Auth::login($finduser);

            return redirect('/stock');
        } else {
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'social_id' => $user->id,
                'social_type' => 'facebook',
                'password' => encrypt('my-facebook'),
            ]);

            \Session::put('userID', $user->id);
            \Session::put('userName', $user->name);

            Auth::login($newUser);

            return redirect('/stock');
        }
    }

    public function stock()
    {
        $userID = \Session::get('userID');

        if(!empty($userID))
        {
            return view('stock');
        } else {
            return redirect('/fb');
        }
    }

    public function getStockPrice(Request $request)
    {
        $data = $request->all();

        $json = file_get_contents('https://www.alphavantage.co/query?function=GLOBAL_QUOTE&symbol=' . $data['stockName'] . '&apikey=0O18XUJW9P8QVGQJ');
        
        $data = json_decode($json, true);
        
        if(empty($data['Global Quote']))
        {
            return 'Invalid';
        } else {
            $symbol = $data['Global Quote']['01. symbol'];
            $high = $data['Global Quote']['03. high'];
            $low = $data['Global Quote']['04. low'];
            $price = $data['Global Quote']['05. price'];

            $insertStock = StockDetail::create([
                'symbol' => $symbol,
                'high' => $high,
                'low' => $low,
                'price' => $price,
            ]);

            $retrunData = [
                'symbol' => $symbol,
                'high' => $high,
                'low' => $low,
                'price' => $price,
            ];

            return response()->json([
                'data' => $retrunData, 'status' => 200,
            ], 200);
        }
    }
    
    public function logout()
    {
        Session::flush();

        return redirect('/fb');
    }
}
