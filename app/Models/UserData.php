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
    protected $table = 'user_data';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'organization',
        'phone_number',
        'address',
        'state',
        'zip_code',
        'country',
        'language',
        'time_zone',
        'currency',
    ];

    /**
     * Get the user that owns the user data.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
