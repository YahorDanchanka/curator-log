<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function familyMembers()
    {
        return $this->belongsToMany(User::class)->withPivot('type');
    }

    public function achievements()
    {
        return $this->hasMany(Achievement::class);
    }

    public function violations()
    {
        return $this->hasMany(Violation::class);
    }

    public function recommendations()
    {
        return $this->hasMany(Recommendation::class);
    }

    public function individualWork()
    {
        return $this->hasMany(IndividualWork::class);
    }
}
