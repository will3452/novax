<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'Employees';
    protected $guarded = [];
    protected $primaryKey = '_id';
    const UPDATED_AT = 'updatedAt';
}
