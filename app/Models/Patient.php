<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    #menambahkan properti fillabe
    protected $fillable = ['nama', 'phone', 'addres', 'status', 'in_data_at', 'out_data_at'];
}
