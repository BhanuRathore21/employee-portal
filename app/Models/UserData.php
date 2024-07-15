<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'email',
        'email_verified_at',
        'organization',
        'phone_number',
        'address',
        'state',
        'zip_code',
        'country',
        'time_zone',
        'language',
        'currency',
        'active',
    ];

    /**
     * Get the user that owns the user data.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
