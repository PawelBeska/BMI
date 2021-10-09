<?php

namespace App\Services\Users;

use App\Models\User;
use Illuminate\Support\Str;

class UserService

{

    private User $user;

    public function __construct(User $user = null)
    {
        $this->user = $user ? $user : new User();
    }

    public function setUser($data): User
    {
        $this->user->email = $data['email'];
        $this->user->password = bcrypt($data['password']);
        $this->user->email_verified_at = array_key_exists('email_verified_at', $data) ? $data['email_verified_at'] : null;
        $this->user->user_activation_key = array_key_exists('email_verified_at', $data) ? null : Str::uuid();
        $this->user->save();
        return $this->user;
    }


}
