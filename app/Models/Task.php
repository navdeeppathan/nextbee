<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';

    protected $primaryKey = 'task_id';

    protected $fillable = [
        'title',
        'description',
        'customer_name',
        'task_type',
        'priority',
        'status',
        'due_date'
    ];
}