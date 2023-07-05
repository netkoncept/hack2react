<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AlertArea
 *
 * @property int $id
 * @property int $alert_id
 * @property int $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AlertArea newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AlertArea newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AlertArea query()
 * @method static \Illuminate\Database\Eloquent\Builder|AlertArea whereAlertId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlertArea whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlertArea whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlertArea whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlertArea whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AlertArea extends Model
{
    const TYPE_CIRCLE = 1;
    const TYPE_POLYGON = 2;
    const TYPE_ADDRESS = 3;

    protected $fillable = [
        'alert_id', 'type'
    ];

    public function cords(){
        return $this->hasMany(AlertAreaCords::class, 'alert_area_id', 'id');
    }
}
