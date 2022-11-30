<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndividualWork extends Model
{
    use HasFactory;

    const TYPE_PARENT = 'parents';
    const TYPE_STUDENT = 'students';
}
