<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserPasswordForgotRequest;
use App\Http\Requests\UserPasswordResetRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use App\Notifications\ResetPassword;
use App\Services\Users\UserService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

/**
 * @method successResponse(array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Translation\Translator|string|null $__)
 * @method errorResponse(array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Translation\Translator|string|null $__, int $HTTP_UNPROCESSABLE_ENTITY)
 */
class AuthController extends Controller
{
    private UserService $userService;

    /**
     * AuthController constructor.
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param UserLoginRequest $request
     * @return JsonResponse
     */
    public function login(UserLoginRequest $request): JsonResponse
    {
        $data = $request->validated();
        if (!Auth::attempt($data))
            return $this->errorResponse(__('auth.failed'), ResponseAlias::HTTP_UNAUTHORIZED);
        if (!Auth::user()->email_verified_at)
            return $this->errorResponse(__('auth.needs_email_confirmation'), ResponseAlias::HTTP_UNAUTHORIZED);

        return $this->successResponse([
            'user' => Auth::user(),
            'access_token' => Auth::user()->createToken('auth')->plainTextToken,
        ]);


    }

    /**
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();

        return $this->successResponse(
            __('messages.Tokens Revoked')
        );
    }

    /**
     * @param UserRegisterRequest $request
     * @return JsonResponse
     */
    public function register(UserRegisterRequest $request): JsonResponse
    {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            $user = $this->userService->setUser($data);
            event(new Registered($user));
            DB::commit();
            return $this->successResponse(__('messages.register.success'));
        } catch (\Exception $e) {
            $this->reportError($e);
            DB::rollBack();
            return $this->errorResponse(__('messages.Something went wrong.'), ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @param string $token
     * @return JsonResponse
     */
    public function verifyEmail(string $token): JsonResponse
    {
        $user = User::whereActivationToken($token)->first();
        if (!$user)
            return $this->errorResponse(__('messages.register_activate.error'), ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);

        $user->email_verified_at = Carbon::now();
        $user->user_activation_key = null;
        $user->save();
        return $this->successResponse(__('messages.register_activate.success'));
    }

    public function passwordForgot(UserPasswordForgotRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = User
            ::whereEmail($data['email'])
            ->first();

        if (!$user) {
            return $this->errorResponse(
                __('messages.Provided email not found.'),
                422
            );
        }
        $user->password_reset_token = Str::uuid();
        $user->password_reset_token_expires_at = now()->addHour();
        $user->save();

        $user->notify(new ResetPassword($user->password_reset_token, $data['email']));

        return $this->successResponse(
            __('messages.Link for reset password has been send.')
        );
    }

    public function passwordReset(UserPasswordResetRequest $request): JsonResponse
    {
        $data = $request->validated();

        $user = User::wherePasswordResetToken($data['email'], $data['token']);
        if (!$user)
            return $this->errorResponse(
                __('messages.Provided token is not valid or is expired.'),
                422
            );

        $user = $user->first();
        $user->password_reset_token_expires_at = null;
        $user->password_reset_token = null;
        $user->password = bcrypt($data['password']);
        $user->save();

        return $this->successResponse(
            __('messages.Password has been reset.')
        );
    }

}
