<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\PartyUser;

class Party extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'date', 'user_id'];

    // RELATIONS
    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function partyUsers()
    {
        return $this->belongsToMany(PartyUser::class, 'rel_party_user', 'party_id', 'user_id');
    }
}
