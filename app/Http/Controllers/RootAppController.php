<?php
namespace App\Http\Controllers;

class RootAppController extends Controller
{
    /**
     * ROOTページ
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // TODO: Market APIがオンラインかどうか確認
        return view(
            'index', [
                // 外部サービスのステータス
                'external_service' => [
                    'minecraft.net' => 'ok',
                    'minecraft.jp'  => 'ok',
                    'api.market.minecraftserver.jp' => 'ok',
                    'notexists.minecraftserver.jp' => 'ng',
                ],
            ]
        );
    }
}
