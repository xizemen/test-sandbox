<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Task
 * @package App\Models
 */
class Task extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
      'task', 'is_done'
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'deleted_at'
    ];
}
