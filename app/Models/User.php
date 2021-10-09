<?php

namespace App\Models;

use App\Notifications\ResetPassword as ResetPasswordNotification;
use App\Notifications\SignupActivate;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

/**
 * @method static whereActivationToken(string $token)
 * @method static whereEmail($email)
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'email',
        'email_verified_at',
        'user_activation_key',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];




    public function scopeWhereEmail($query, string $email): Builder
    {
        return $query->where('email', $email);
    }

    public function scopeWherePasswordResetToken($query, $email, $token): Builder|null
    {
        if (DB::table('password_resets')->where('email', $email)->where('token', $token)->where('password_reset_token_expires_at', '>=', now())->exists())
            return $query->where('email', $email);
        return null;

    }

    public function scopeWhereActivationToken($query, string $token): Builder
    {
        return $query->where('user_activation_key', $token);
    }


    public function sendPasswordResetNotification($token): void
    {
        $this->notify(new ResetPasswordNotification($token, $this->email));
    }

    public function sendEmailVerificationNotification(): void
    {
        $this->notify(new SignupActivate());
    }

}
