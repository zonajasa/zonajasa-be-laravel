<?php

use App\Infrastructure\Database\Eloquent\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Token;

#import auth routes

Route::prefix('v1/user')->group(function () {
    require base_path('app/Internal/Api/Auth/Routes/AuthRoutes.php');

    //kalo true api debug nya jalan selain itu default nya hanya base api fitur
    if (config('app.debug') == true) {
        //debug API
        Route::get('/user-session', function (Request $request) {
            return $request->user(); //get user session
        })->middleware('auth:api');


        Route::post('/encrypt-decrypt', function (Request $request) {
            $data = $request->post();
            if (empty($data)) {
                return ErrorRes('Data is required for encryption or decryption');
            }

            if ($data['type'] !== 'encrypt' && $data['type'] !== 'decrypt') {
                return ErrorRes('Invalid type. Type must be either "encrypt" or "decrypt".');
            }

            if ($data['type'] === 'encrypt') {
                $data['data']['email'] = Crypt::encryptString($data['data']['email']);
                $data['data']['no_whatsapp'] = Crypt::encryptString($data['data']['no_whatsapp']);
            } else {
                $data['data']['email'] = Crypt::decryptString($data['data']['email']);
                $data['data']['no_whatsapp'] = Crypt::decryptString($data['data']['no_whatsapp']);
            }

            return OkRes('Data encrypted successfully', $data);
        });

        Route::get('/test-user-token', function (Request $request) {

            //validation request
            $req = $request->post('user_id');
            if (empty($req)) {
                return response()->json([
                    'message' => 'User id is required'
                ], 422);
            }

            //get reterive user data by id valid or not
            $user = User::find($req);
            if (!empty($user)) {

                //create token personal akses
                $token = $user->createToken('zonajasa')->accessToken;

                //retriving token valid as user
                $tokenValid = $user->tokens()
                    ->with('client')
                    ->where('revoked', false)
                    ->where('expires_at', '>', now())
                    ->get()
                    ->filter(fn(Token $token) => $token->client->hasGrantType('personal_access'));
                return response()->json([
                    'message' => 'User found',
                    'user' => $user,
                    'token' => $token,
                    'token_valid' => $tokenValid,
                ], 200);
            } else {
                //default invalid user id
                return response()->json([
                    'message' => 'User not found'
                ], 422);
            }
        });
    }
});
