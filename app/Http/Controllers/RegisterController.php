<?php

namespace App\Http\Controllers;

use App\Events\UserRegisteredEvent;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|unique:users|email',
                'password' => 'required|min:6',
                'name' => 'required|min:3',
            ],[
                'email.required' => 'O email deve ser informado.',
                'email.unique' => 'Já existe uma conta para o email informado.',
                'email.email' => 'O email informado é inválido',
                'password.required'=> 'Você deve informar a senha',
                'password.min'=> 'Você deve informar uma senha com 6 caracteres',
                'name.required'=> 'Você deve informar um nome',
                'name.min'=> 'Você deve informar um nome maior',
            ]);

            if ($validator->fails()){

                throw new \Exception($validator->errors()->first());
            }

            $token = Uuid::uuid4()->toString();

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'is_admin' => false,
                'is_verified' => false,
                'mail_token' => $token
            ]);

            $url = env('APP_URL') . "/confirm-account/" . $token;

            // mandar o email
            event(new UserRegisteredEvent($url, $user));

            return response([
                'message' => 'Sua conta foi criada com sucesso. Para confirmá-la verifique seu email.',
                'status' => 'success'
            ], Response::HTTP_OK);
        } catch (\Exception $exception) {
            return response([
                'message' => $exception->getMessage(),
                'status' => 'error'
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function confirmAccount($token)
    {
        try {

            $user = User::where([
                'is_verified' => false,
                'mail_token' => $token
            ])->first();

            if (!$user) {
                throw new Exception("Sua conta já foi ativada anteriormente.");
            }

            $user->is_verified = true;
            $user->save();

            return response([
                'message' => 'Sua conta foi ativada com sucesso.',
                'status' => 'sucess'
            ], Response::HTTP_OK);

        } catch (\Exception $exception) {

            return response([
                'message' => $exception->getMessage(),
                'status' => 'error'
            ], Response::HTTP_BAD_REQUEST);

        }
    }
}
