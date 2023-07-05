<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AlertAreaCords
 *
 * @property int $id
 * @property int $alert_area_id
 * @property float|null $lat
 * @property float|null $lng
 * @property int $teryt_street
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AlertAreaCords newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AlertAreaCords newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AlertAreaCords query()
 * @method static \Illuminate\Database\Eloquent\Builder|AlertAreaCords whereAlertAreaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlertAreaCords whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlertAreaCords whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlertAreaCords whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlertAreaCords whereLng($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlertAreaCords whereTerytStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlertAreaCords whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AlertAreaCords extends Model
{
    protected $fillable = [
        'alert_area_id', 'lat', 'lng', 'teryt_district', 'teryt_commune', 'teryt_city', 'teryt_street',
    ];
}
