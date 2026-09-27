<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Counties extends Model
{
    use HasFactory;

    protected $table = 'counties';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'coat_of_arms_url',
    ];

    /**
     * The cities that belong to this county.
     */
    public function cities()
    {
        return $this->hasMany(Cities::class, 'county_id');
    }
}
