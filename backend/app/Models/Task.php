<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        't_title',
        't_description',
        't_status',
        't_assignedto',
        't_assignedtoname',
        't_assignedby',
        't_assignedbyname',
        't_remarks',
    ];

}
