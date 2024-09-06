<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PersonalAccessToken;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{

    public function register(Request $request)
{
    try {
        // // Validate dữ liệu từ request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Tạo người dùng mới trong cơ sở dữ liệu
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Tạo token truy cập cho người dùng sau khi đăng ký
        $tokenResult = $user->createToken('authToken')->plainTextToken;

        // Trả về response thành công với token truy cập
        return response()->json([
            'status_code' => 200,
            'access_token' => $tokenResult,
            'token_type' => 'Bearer',
            'user' => $user
        ]);
    } catch (\Exception $error) {
        // Bắt lỗi và trả về response lỗi
        return response()->json([
            'status_code' => 500,
            'message' => 'Error in Registration',
            'error' => $error->getMessage(),
        ]);
    }
}

}
