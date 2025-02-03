<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryTax extends Model
{
    use HasFactory;

    protected $fillable = ['country_code', 'tax_rate'];
}
