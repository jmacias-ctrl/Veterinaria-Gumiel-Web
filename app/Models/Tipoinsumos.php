<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Tipoinsumos extends Model
{
  use HasFactory;
  protected $table = "tipoinsumos";
  protected $fillable = ['nombre'];
}
