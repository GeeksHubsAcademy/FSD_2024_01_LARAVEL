<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    // opativo dependiendo del nombre de la clase
    protected $table = "tasks";

    public function user()
    {
        // return $this->belongsTo(User::class, 'user_id', 'id', 'tasks');
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
