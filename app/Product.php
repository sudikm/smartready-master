<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product';
    protected $fillable = ['name', 'videoLink', 'description', 'title', 'qrCodeText', 'pin'];
}

