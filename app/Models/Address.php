<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $appends = ['to_string'];

    protected function toString(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => "{$this->region} область, {$this->district} район, {$this->residenceType} {$this->residence}, ул. {$this->street}"
        );
    }
}
