<?php
namespace App\Http\Controllers;

class UserPageController extends Controller
{
    public function onRequest(string $user_uuid) {
        // TODO: database
        return view('user', [
            'uuid' => $user_uuid
        ]);
    }
}