<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DeviceAddress
 *
 * @property int $id
 * @property int $device_id
 * @property string|null $street
 * @property string|null $number
 * @property string $city
 * @property float|null $latitude
 * @property float|null $longitude
 * @property int $teryt_province
 * @property int $teryt_district
 * @property int|null $teryt_commune
 * @property int|null $teryt_city
 * @property int|null $teryt_street
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceAddress newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceAddress newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceAddress query()
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceAddress whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceAddress whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceAddress whereDeviceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceAddress whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceAddress whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceAddress whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceAddress whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceAddress whereStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceAddress whereTerytCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceAddress whereTerytCommune($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceAddress whereTerytDistrict($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceAddress whereTerytProvince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceAddress whereTerytStreet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DeviceAddress whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DeviceAddress extends Model
{
    protected $fillable = [
      'device_id', 'street', 'number', 'city', 'latitude', 'longitude', 'teryt_province', 'teryt_district',
        'teryt_commune', 'teryt_city', 'teryt_street'
    ];
}
