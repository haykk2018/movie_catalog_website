<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Static_;

/**
 * App\Models\Movie
 *
 * @method static findOrFail($id)
 * @method static create()
 * @method static updateOrCreate(array $all)
 * @property int $id
 * @property string $title
 * @property string $short_description
 * @property string|null $img_src
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $categories
 * @property-read int|null $categories_count
 * @method static \Database\Factories\MovieFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Movie newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Movie query()
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereImgSrc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Movie whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Movie extends Model
{
    use HasFactory;

    public function categories(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * @return Category[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getCategories(): \Illuminate\Database\Eloquent\Collection|array
    {
        return $this->categories;
    }

    /**
     * @param Category[]|\Illuminate\Database\Eloquent\Collection $categories
     */
    public function setCategories(\Illuminate\Database\Eloquent\Collection|array $categories): void
    {
        $this->categories = $categories;
    }

    //protected $guarded = [];
    protected $fillable = [ 'id', 'title', 'short_description', 'categories'];

}
