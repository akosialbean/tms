<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        't_title',
        't_description',
        't_status',
        't_assignedto',
        't_assignedby',
    ];

}
