<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AlertDeviceNotification
 *
 * @property int $id
 * @property int $alert_id
 * @property int $device_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Alert $alert
 * @method static \Illuminate\Database\Eloquent\Builder|AlertDeviceNotification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AlertDeviceNotification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AlertDeviceNotification query()
 * @method static \Illuminate\Database\Eloquent\Builder|AlertDeviceNotification whereAlertId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlertDeviceNotification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlertDeviceNotification whereDeviceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlertDeviceNotification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlertDeviceNotification whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AlertDeviceNotification extends Model
{
    protected $fillable = [
        'alert_id', 'device_id'
    ];

    public function alert()
    {
        return $this->belongsTo(Alert::class, 'alert_id', 'id');
    }
}
