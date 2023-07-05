<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Device
 *
 * @property int $id
 * @property string $uuid
 * @property string|null $os
 * @property string|null $os_version
 * @property string|null $model
 * @property int $can_force_localization
 * @property int $citizen
 * @property int $tourist
 * @property string $push_id
 * @property string $last_used
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DeviceAddress> $addreses
 * @property-read int|null $addreses_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\AlertDeviceNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|Device newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Device newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Device query()
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereCanForceLocalization($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereCitizen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereLastUsed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereOs($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereOsVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device wherePushId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereTourist($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereUuid($value)
 * @mixin \Eloquent
 */
class Device extends Model
{
    protected $fillable = [
        'uuid', 'os', 'os_version', 'model', 'can_force_Localization', 'citizen', 'tourist', 'push_id', 'last_used'
    ];

    public function notifications()
    {
        return $this->hasMany(AlertDeviceNotification::class, 'device_id', 'id');
    }

    public function addreses()
    {
        return $this->hasMany(DeviceAddress::class, 'device_id', 'id');
    }

}
