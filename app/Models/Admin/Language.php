<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = [
        'lang_key',
        'lang_value'
    ];

}
