<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $id
 * @property integer $product_id
 * @property integer $transaction_id
 * @property string $name
 * @property int $discount
 * @property string $created_at
 * @property string $updated_at
 * @property Product $product
 * @property Transaction $transaction
 */
class EmployeePayment extends Model
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
    protected $fillable = ['product_id', 'transaction_id', 'name', 'discount', 'amount', 'created_at', 'updated_at'];

    /**
     * @return BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    /**
     * @return BelongsTo
     */
    public function transaction()
    {
        return $this->belongsTo('App\Models\Transaction');
    }
}
