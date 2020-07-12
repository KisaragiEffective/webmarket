<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class UserPageController extends Controller
{
    public function onRequest(string $user_uuid) {
        // TODO: star select
        $may_user_id = DB::select("SELECT * FROM users WHERE uuid = ?;", [$user_uuid]);
        // DB::selectが返すのはstdClass
        $user_id = count($may_user_id) === 0 ? -1 : $may_user_id[0]->in_game_name;

        return view('user', [
            'uuid' => $user_uuid,
            'user_id' => $user_id
        ]);
    }
}
