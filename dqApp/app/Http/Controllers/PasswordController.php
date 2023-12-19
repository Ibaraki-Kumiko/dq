<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ResetRequest;
use App\Models\User;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Exception;

class PasswordController extends Controller
{
    public function forgot(Request $request)
    {
        $email = $request->input('email');
        $token = Str::random(12);

        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token
        ]);
        try {

            Mail::mailer('second_smtp')->send('reset', ['token' => $token], function (Message $message) use ($email) {
                $message->subject('Reset your password!');
                $message->from("notifications@deutsche-quelle.de");
                $message->to($email);
            });


            //   return response()->json(['message' => 'Сообщение успешно отправлено'], 200);
            return response([
                'message' => 'Check your email!'
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Произошла ошибка'], 500);
        }


    }

    public function reset(ResetRequest $request)
    {
        $passwordReset = DB::table('password_resets')
            ->where('token', $request->input('token'))->first();

        if (!$user = User::where('email', $passwordReset->email)->first()) {
            throw new NotFoundHttpException('User not found!');
        }

        $user->password = Hash::make($request->input('password'));
        $user->save();

        return response([
            'message' => 'success'
        ]);
    }
}
