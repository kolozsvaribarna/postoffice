<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    use HasFactory;

    protected $table = 'cities';
    public $timestamps = false;

    protected $fillable = [
        'zip_code',
        'name',
        'county_id',
        'population',
    ];

    /**
     * The county this city belongs to.
     */
    public function county()
    {
        return $this->belongsTo(Counties::class);
    }
}
