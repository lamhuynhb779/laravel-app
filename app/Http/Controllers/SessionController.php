<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SessionController extends Controller
{
    //
    public function index()
    {
        return view('session/index');
    }

    public function store(Request $request)
    {
        // _token se lay o browser khi user request len he thong
        $browserToken = csrf_token();

        // session se lay trong DB
        $session = $request->session();
        $dbToken = $session->token(); // dùng hàm có sẵn để lấy nhanh _token của session

        // CÁCH LẤY _token thủ công
        $record = DB::table('sessions')
            ->where('id', $session->getId())
            ->first();

        $payload = $record->payload;
        $decryptedPayload = unserialize(base64_decode($payload));
        $manualToken = $decryptedPayload['_token'] ?? '';

        if ($browserToken === $dbToken && $browserToken === $manualToken) {
            dd('PASSED');
        } else {
            dd('FAILED');
        }
    }
}
