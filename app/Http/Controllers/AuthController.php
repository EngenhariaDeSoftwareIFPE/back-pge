<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;

// 2|15cnH8cydfIXHYI7wHYWORj1X70vrrGyNlOSgexp3e185071

class AuthController extends Controller
{
    use HttpResponses;
    
    public function loginStudent(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))){
            return $this->success('Authorized', 200, ['token' => $request->user()->createToken('student', ['student'])->plainTextToken]);
        }
        return $this->error('Unauthorized', 403);
    }

    public function loginSignatory(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))){
            return $this->success('Authorized', 200, ['token' => $request->user()->createToken('signatory', ['signatory'])->plainTextToken]);
        }
        return $this->error('Unauthorized', 403);
    }

    public function logout()
    {
        
    }
}
