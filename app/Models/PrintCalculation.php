<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrintCalculation extends Model
{
    use HasFactory;

    protected $fillable = [
        'paper_width',
        'paper_height',
        'orientation',
        'custom_width',
        'custom_height',
        'total_copies',
    ];
}
