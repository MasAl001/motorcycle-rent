<?php

namespace App\Models;

use App\Models\MotorCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Motor extends Model
{
    use HasFactory;

    protected $fillable = [
        'motor_category_id',
        'merk',
        'color',
        'model',
        'year',
        'plate_number',
        'price_per_day',
        'deposit',
        'description',
        'image',
        'status',
    ];

    protected $casts = [
        'price_per_day' => 'decimal:2',
        'deposit' => 'decimal:2',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(MotorCategory::class, 'motor_category_id');
    }
}
