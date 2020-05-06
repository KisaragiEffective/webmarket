<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Auth\UserProviderInterface;
use App\Http\Controllers\Controller;

use MinecraftJP;
use Log;
use Session;
use Illuminate\Support\Facades\DB;

class ExternalAuthController extends Controller {

    // ...だからこそPHP 7が使われなければならない
    private function getJMS(): MinecraftJP {
        return new MinecraftJP([
                               'clientId'     => env('JMS_CLIENT_ID'),
                               'clientSecret' => env('JMS_CLIENT_SECRET'),
                               'redirectUri'  => env('JMS_CALLBACK')
                           ]);
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
    
    public function fromProvider() {
        $minecraftjp = $this->getJMS();
        try {
            Log::debug("lib/mcjp:" . MinecraftJP::VERSION);
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
        $uuid = $session["uuid"];
        // 無名コラムの名前はあてにできないし、stdClassのキーとして不適切
        $count = DB::select("SELECT COUNT(*) as count FROM accounts WHERE uuid = ?", [$uuid])[0]->count;
        Log::debug($count);
        if ($count === 0) {
            // ようこそ！
            DB::insert("INSERT INTO accounts VALUES (?, ?, ?)", [0, $uuid, $session["preferred_username"]]);
            // 絶対あるでしょｗアサーション省略
            $myAccountId = DB::select("SELECT id FROM accounts WHERE uuid = ?", [$uuid])[0]->id;
            DB::insert("INSERT INTO banks VALUES (?, ?)", [0, $myAccountId]);
        }
        return redirect()->to($callback_url);
    }

    public function logout() {
        try {
            $minecraftjp = $this->getJMS();
            Log::debug('ログアウト処理');

            $minecraftjp->logout();
            Session::forget('minecraftjp');
            return redirect()->to('/');

        } catch (\Exception $e) {
            return redirect('/login');
        }
    }
}
