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

    public function mother()
    {
        return $this->belongsTo(User::class);
    }

    public function father()
    {
        return $this->belongsTo(User::class);
    }

    public function otherFamilyMembers()
    {
        return $this->belongsToMany(User::class);
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
}
