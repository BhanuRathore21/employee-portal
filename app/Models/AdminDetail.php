<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Hash;

class AdminDetail extends Model implements Authenticatable
{
    use AuthenticatableTrait;

    protected $table = 'admin_details';

    protected $fillable = [
        'username', 'email', 'password', 'active'
    ];

    protected $hidden = [
        'password'
    ];

    /**
     * Find an admin by username or email.
     *
     * @param string $login
     * @return mixed
     */
    public static function findByEmailOrUsername($login)
    {
        return self::where('email', $login)
            ->orWhere('username', $login)
            ->first();
    }

    /**
     * Verify the provided password against the hashed password stored in the database.
     *
     * @param string $password
     * @return bool
     */
    public function validatePassword($password)
    {
        return Hash::check($password, $this->password);
    }
}
