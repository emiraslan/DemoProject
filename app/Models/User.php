<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class User extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fullname',
        'email',
        'name',
    ];

    public function phoneBook() {
        return $this->hasOne(PhoneBook::class);
    }

    public function userCountry() {
        return $this->hasOne(UserCountry::class);
    }
}
