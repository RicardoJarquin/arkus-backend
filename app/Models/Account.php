<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $guard_name = 'api';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'client_name',
        'person_in_charge',
    ];

    public function users()
    {
        return $this->hasManyThrough(
        User::class,
        UserAccount::class,
        'account_id',
        'id',
        'id',
        'user_id'
        );


    }
}
