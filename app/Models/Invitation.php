<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;

    protected $fillable = ['inviter_id', 'person_id', 'email', 'status'];

    public function inviter()
    {
        return $this->belongsTo(User::class, 'inviter_id');
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}