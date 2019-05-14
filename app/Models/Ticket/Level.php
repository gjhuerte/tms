<?php

namespace App\Models\Ticket;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $table = 'levels';
    protected $primaryKey = 'id';

    /**
     * Fillable entries when using eloquent model
     *
     * @var array
     */
    public $fillable = [
        'name',
        'details',
    ];
}
