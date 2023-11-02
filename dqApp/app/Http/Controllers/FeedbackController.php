<?php

namespace App\Http\Controllers;

use App\Mail\FeedbackMail;
use App\Mail\TestEmail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class FeedbackController extends Controller
{
    public function submitForm(Request $request)
    {

        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ];

        $messages = [
            'name.required' => 'Поле имя обязательно к заполнению.',
            'name.max' => 'Поле имя не должно превышать 255 символов.',
            'email.required' => 'Поле email обязательно к заполнению.',
            'email.email' => 'Поле email должно быть в формате email.',
            'message.required' => 'Поле message должно быть в формате email',
        ];

        try {

            $request->validate($rules, $messages);

            Mail::to('admin@deutsche-quelle.de')->send(new FeedbackMail($request->all()));
           /* Mail::to('u85537@deutsche-quelle.de')->send(new FeedbackMail($request->all()));*/

            return response()->json(['message' => 'Сообщение успешно отправлено'], 200);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (Exception $e) {
            return response()->json(['error' => 'Произошла ошибка'], 500);
        }


    }
}
