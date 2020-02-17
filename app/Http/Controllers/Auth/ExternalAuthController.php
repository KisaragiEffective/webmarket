<?php
namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Auth\UserProviderInterface;
use App\Http\Controllers\Controller;

use MinecraftJP;
use Log;
use Session;

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
        try {
            $minecraftjp = $this->getJMS();

            // Get User
            $user = $minecraftjp->getUser();
            Log::debug(print_r($user, 1));
            Session::put('minecraftjp', $user);
        } catch (\Exception $e) {
            return redirect('/login/failed');
        }

        // 戻り先URLを取得
        $callback_url = Session::get('callback_url');
        if (empty($callback_url)) {
            $callback_url = '/';
        }
        else {
            Session::forget('callback_url');
        }

        return redirect()->to($callback_url);
    }

    public function logout() {
        try {
            $minecraftjp = $this->getJMS();
            Log::debug('ログアウト処理');

            $minecraftjp->logout();

            return redirect()->to('/');

        } catch (\Exception $e) {
            return redirect('/login');
        }
    }
}
