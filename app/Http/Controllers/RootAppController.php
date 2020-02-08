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
    		// TODO: Market APIがオンラインかどうか確認して、それを表示する
        // viewをセット
        return view(
            'index', [
            		// 外部サービスのステータス
            		'external_service' => [
            				'minecraft.net' => 'OK',
            				'minecraft.jp'  => 'OK',
            				'api.market.minecraftserver.jp' => 'OK'
            		],
            ]
        );
    }
}