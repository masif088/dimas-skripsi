<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $date
 * @property string $start
 * @property string $end
 * @property string $created_at
 * @property string $updated_at
 * @property ShiftDetail[] $shiftDetails
 */
class Shift extends Model
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
    protected $fillable = ['date', 'start', 'end', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shiftDetails()
    {
        return $this->hasMany('App\Models\ShiftDetail');
    }
}
