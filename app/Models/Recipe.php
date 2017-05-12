<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Recipe
 *
 * @property int                                                                    $id
 * @property string                                                                 $recipe_id
 * @property string                                                                 $publisher
 * @property string                                                                 $f2f_url
 * @property string                                                                 $title
 * @property string                                                                 $source_url
 * @property string                                                                 $image_url
 * @property float                                                                  $social_rank
 * @property string                                                                 $publisher_url
 * @property array                                                                  $ingredients
 * @property \Carbon\Carbon                                                         $created_at
 * @property \Carbon\Carbon                                                         $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserRecipe[] $userRecipes
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Recipe whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Recipe whereF2fUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Recipe whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Recipe whereImageUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Recipe whereIngredients($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Recipe wherePublisher($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Recipe wherePublisherUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Recipe whereRecipeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Recipe whereSocialRank($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Recipe whereSourceUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Recipe whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Recipe whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Recipe extends Model
{
    protected $fillable = [
        'recipe_id',
        'publisher',
        'f2f_url',
        'title',
        'source_url',
        'image_url',
        'social_rank',
        'publisher_url',
        'ingredients',
    ];

    protected $casts = [
        'ingredients' => 'array',
    ];

    protected $attributes = [
        'ingredients' => '[]',
    ];

    public function userRecipes()
    {
        return $this->hasMany(UserRecipe::class);
    }

    public function isComplete()
    {
        return !empty($this->ingredients);
    }
}
