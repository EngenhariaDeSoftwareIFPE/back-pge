<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use HttpResponses;
    
    public function loginStudent(Request $request)
    {
        if (Auth::guard('students')->attempt($request->only('email', 'password'))){
            return $this->success('Authorized', 200, ['token' => $request->user()->createToken('student', ['student'])->plainTextToken]);
        }
        return $this->error('Unauthorized', 403);
    }

    public function loginSignatory(Request $request)
    {
        if (Auth::guard('signatories')->attempt($request->only('email', 'password'))){
            return $this->success('Authorized', 200, ['token' => auth('signatories')->user()->createToken('signatory', ['signatory'])->plainTextToken]);
        }
        return $this->error('Unauthorized', 403);
    }

    public function logout()
    {
        
    }
}
