<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passport extends Model
{
    use HasFactory;

    protected $appends = ['to_string'];

    protected function toString(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => "{$this->series}{$this->number}, выдан «{$this->district_department}», дата выдачи: {$this->issue_date}"
        );
    }
}
