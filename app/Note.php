<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'body'
    ];
    
    /**
     * Get the user that created the note.
     */
    public function user() {
        return $this->belongsTo(User::class);
    }
}