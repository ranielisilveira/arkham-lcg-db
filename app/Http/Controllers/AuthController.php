<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try{
        $validator = Validator::make($request->all(), [
            'email' => 'required|exists:users|email',
            'password' => 'required',
        ],[
            'email.required' => 'O email deve ser informado.',
            'email.exists' => 'Não existe nenhuma conta para o email informado.',
            'email.email' => 'O email informado é inválido',
            'password.required'=> 'Você deve informar a senha'        ]);

        if ($validator->fails()){

            throw new Exception($validator->errors()->first());
        }

        $user = User::where('email', $request->email)->first();
        if(!$user->is_verified){

            throw new Exception('Conta não ativa, acesse o link de validação enviado para seu email.');
            //TODO: enviar e-mail de validação

        }

        $req = Request::create('/oauth/token', 'POST', [
            'grant_type' => 'password',
            'client_id' => env('PASSPORT_CLIENT_ID'),
            'client_secret' => env('PASSPORT_CLIENT_SECRET'),
            'username' => $request->email,
            'password' => $request->password,
        ]);
        $res = app()->handle($req);
        $responseBody = $res->getContent();
        $response = json_decode($responseBody, true);

            self::passportExceptions($response);

            return $response;

        }catch (Exception $exception) {

        return response([
            'message' => $exception->getMessage(),
            'status' => 'error'
        ],Response::HTTP_BAD_REQUEST);

        }
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->token()->revoke();

            auth()->user()->tokens->each(function($token) {
                $token->delete();
            });

            return response([
                'message' => 'Você foi deslogado com sucesso!'
            ]);

        } catch (Exception $exception) {

        return response([
            'message' => $exception->getMessage(),
            'status' => 'error'
        ],Response::HTTP_BAD_REQUEST);

        }
    }

    private static function passportExceptions ($response)
    {
        try {
            if (isset($response['error'])) {
            if ($response['error'] === 'invalid_client') {
                    throw new \Exception('Erro no sistema de login.');
                }

            if (
                $response['error'] === 'invalid_credentials' ||
                $response['error'] === 'invalid_request' ||
                $response['error'] === 'invalid_data' ||
                $response['error'] === 'invalid_grant' ||
                $response['error'] === 'unsupported_grant_type'
            ) {
                throw new \Exception('Dados inválidos. Tente novamente');
            }

            throw new \Exception($response['error']);
        }
    } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
