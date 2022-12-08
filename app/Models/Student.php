<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $appends = ['mother', 'father'];
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function familyMembers()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('type')
            ->withTimestamps();
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

    public function passport()
    {
        return $this->hasOne(Passport::class);
    }

    protected function mother(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) => collect($this->familyMembers)->firstWhere('pivot.type', 'mother'),
        );
    }

    protected function father(): Attribute
    {
        return Attribute::make(
            get: fn($value, $attributes) => collect($this->familyMembers)->firstWhere('pivot.type', 'father'),
        );
    }
}
