<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRecipe extends Model
{
    protected $fillable = [
        'user_id',
        'recipe_id',
        'done',
        'favourite',
    ];

    protected $casts = [
        'done'      => 'bool',
        'favourite' => 'bool',
    ];

    protected $attributes = [
        'done'      => false,
        'favourite' => false,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
