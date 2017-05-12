<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserRecipe
 *
 * @property int $id
 * @property int $user_id
 * @property int $recipe_id
 * @property bool $todo
 * @property bool $done
 * @property bool $favourite
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Recipe $recipe
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserRecipe whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserRecipe whereDone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserRecipe whereFavourite($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserRecipe whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserRecipe whereRecipeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserRecipe whereTodo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserRecipe whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\UserRecipe whereUserId($value)
 * @mixin \Eloquent
 */
class UserRecipe extends Model
{
    protected $fillable = [
        'user_id',
        'recipe_id',
        'todo',
        'done',
        'favourite',
    ];

    protected $casts = [
        'todo'      => 'bool',
        'done'      => 'bool',
        'favourite' => 'bool',
    ];

    protected $attributes = [
        'todo'      => false,
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
