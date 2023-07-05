<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * App\Models\Alert
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $category_id
 * @property string $valid_from
 * @property string $valid_to
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category|null $category
 * @method static \Illuminate\Database\Eloquent\Builder|Alert newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Alert newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Alert query()
 * @method static \Illuminate\Database\Eloquent\Builder|Alert whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alert whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alert whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alert whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alert whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alert whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alert whereValidFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Alert whereValidTo($value)
 * @property-read \App\Models\AlertArea|null $area
 * @mixin \Eloquent
 */
class Alert extends Model
{

    protected $fillable = [
        'title',
        'description',
        'category_id',
        'valid_from',
        'valid_to',
    ];

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function area()
    {
        return $this->hasOne(AlertArea::class, 'alert_id', 'id');
    }

    public function coords()
    {
        return collect(DB::select("SELECT alert_area_cords.* FROM
          `alert_area_cords`
          INNER JOIN `alert_areas` ON `alert_areas`.`id` = `alert_area_cords`.`alert_area_id`
        WHERE
          `alert_areas`.`alert_id` = " . $this->id));
    }
}
