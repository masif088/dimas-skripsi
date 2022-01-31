<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $stock_good_id
 * @property int $amount
 * @property string $note
 * @property string $created_at
 * @property string $updated_at
 */
class StockGoodHistory extends Model
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
    protected $fillable = ['stock_good_id', 'amount', 'note', 'created_at', 'updated_at'];

}
