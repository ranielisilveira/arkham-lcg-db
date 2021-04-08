<?php

namespace App\Http\Controllers;

use App\Events\UserChangePasswordEvent;
use App\Events\UserRegisteredEvent;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Response;

class PasswordRecoveryController extends Controller
{
    public function sendPasswordRecovery(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|exists:users|email',
            ], [
                'email.required' => "O email deve ser fornecido.",
                'email.exists' => "Não existe nenhuma conta para o email informado.",
                'email.email' => "O email informado é inválido.",
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }

            $user = User::where('email', $request->email)->first();

            $token = Uuid::uuid4()->toString();

            $user->mail_token = $token;
            $user->save();

            if (!$user->is_verified) {
                $url = env('APP_URL') . "/confirm-account/" . $token;

                // mandar o email
                event(new UserRegisteredEvent($url, $user));

                return response([
                    'status' => 'success',
                    'message' => "Conta não ativa, acesse o link de validação enviado para seu email."
                ]);
            }

            // enviar confirmaçao de troca de senha
            $url = env('FRONT_URL') . "/password-change/" . $token;

            // mandar o email
            event(new UserChangePasswordEvent($url, $user));

            return response([
                'status' => 'success',
                'message' => "Um link para criação de senha foi enviado para seu email."
            ]);
        } catch (Exception $exception) {
            return response([
                'message' => $exception->getMessage(),
                'status' => 'error'
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function changePassword(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'token' => 'required',
                'password' => 'required|min:6|confirmed',
            ], [
                'token.required' => "O token de identidade deve ser fornecido.",

                'password.required' => "Você deve informar a senha",
                'password.min' => "Você deve informar uma senha com 6 caracteres",
                'password.confirmed' => "As senhas devem coincidir.",
            ]);

            if ($validator->fails()) {
                throw new Exception($validator->errors()->first());
            }

            $user = User::where('mail_token', $request->token)->first();

            if (!$user) {
                throw new Exception("Erro ao tentar redefinir a senha.");
            }

            $user->mail_token = null;
            $user->password = Hash::make($request->password);
            $user->save();

            return response([
                'status' => 'success',
                'message' => "Sua senha foi redefinida com sucesso."
            ]);
        } catch (Exception $exception) {
            return response([
                'message' => $exception->getMessage(),
                'status' => 'error'
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
