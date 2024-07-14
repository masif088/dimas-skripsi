<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property int $year
 * @property int $month
 * @property float $amount
 * @property float $level
 * @property float $trend
 * @property float $seasonal
 * @property float $forecast
 * @property float $error
 * @property string $created_at
 * @property string $updated_at
 */
class Forecast extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['year', 'month', 'amount', 'level', 'trend', 'seasonal', 'forecast', 'error', 'created_at', 'updated_at'];

}
