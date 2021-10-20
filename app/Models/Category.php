<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    
    /* Get the user that owns the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /*
    * Get all of the posts for the Category
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
