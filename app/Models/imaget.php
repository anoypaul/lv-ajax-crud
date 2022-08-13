<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class imaget extends Model
{
    use HasFactory;
    protected $table="imaget";
    protected $primaryKey="imaget_id";
    protected $fillable =["imaget_picture"];
}
