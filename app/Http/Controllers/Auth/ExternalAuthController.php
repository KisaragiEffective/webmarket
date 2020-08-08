<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Auth\UserProviderInterface;
use App\Http\Controllers\Controller;
use App\Http\Database\DatabaseGateway;
use MinecraftJP;
use Log;
use Session;
use Illuminate\Support\Facades\DB;

class ExternalAuthController extends Controller {

    // ...だからこそPHP 7が使われなければならない
    private function getJMS(): MinecraftJP {
    	$it = [
	       'clientId'     => env('JMS_CLIENT_ID'),
	       'clientSecret' => env('JMS_CLIENT_SECRET'),
	       'redirectUri'  => env('JMS_CALLBACK')
   	];
    	Log::debug($it);
    	
        return new MinecraftJP($it);
    }
    /**
     * Externally authorization
     * @return Response
     */
    public function toProvider() {
        // jms
        $minecraftjp = $this->getJMS();

        // Get login url for redirect
        $loginUrl = $minecraftjp->getLoginUrl();

        return redirect($loginUrl);
    }
    
    /**
    * callback
    */
    public function fromProvider() {
        $minecraftjp = $this->getJMS();
        try {
            Log::debug("lib/mcjp version:" . MinecraftJP::VERSION);
            $user = $minecraftjp->getUser();
            // Log::debug(print_r($user, 1));
            Session::put('minecraftjp', $user);
        } catch (\Exception $e) {
            throw $e;
        }

        // 戻り先URLを取得
        $callback_url = Session::get('callback_url');
        if (empty($callback_url)) {
            $callback_url = '/';
        } else {
            Session::forget('callback_url');
        }

        $session = session('minecraftjp');
        Log::debug("Minecraftjp object");
        Log::debug($session);
        $uuid = $session["uuid"];
        // 無名コラムの名前はあてにできないし、stdClassのキーとして不適切
        $count = DB::select("SELECT COUNT(*) as count FROM users WHERE uuid = ?", [$uuid])[0]->count;
        Log::debug("existence: (uuid = " . $uuid . " ) = " . $count);
        // 存在するか？
        if ($count === 0) {
            // ようこそ！
            $mcid = $session["preferred_username"];
            DatabaseGateway::registerUser($uuid, $mcid);
        } else {
            // uuidはDBでunique制約を掛けているので絶対1つしか存在しない！！！！
            Log::debug("User { uuid = \"" . $uuid . "\"} Logged in.");
            DatabaseGateway::
        }
        return redirect()->to($callback_url);
    }

    public function logout() {
        try {
            $minecraftjp = $this->getJMS();
            Log::debug('ログアウト処理');
            $minecraftjp->logout();
        } catch (\Exception $e) {
            // トップページへ遷移
            Log::debug("Exception occured: logout processing");
            Log::debug($e);
        }
        Session::forget('minecraftjp');
        return redirect()->to('/');
    }
}
