<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $status_order_id
 * @property integer $payment_method_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $transaction_code
 * @property string $name
 * @property int $visitors
 * @property string $reservation
 * @property PaymentMethod $paymentMethod
 * @property StatusOrder $statusOrder
 * @property User $user
 * @property TransactionDetail[] $transactionDetails
 */
class Transaction extends Model
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
    protected $fillable = ['fee', 'donate', 'user_id', 'status_order_id', 'payment_method_id', 'created_at', 'updated_at', 'transaction_code', 'name', 'visitors', 'reservation'];

    public static function getCode()
    {
        $day = ['MG', 'SN', 'SL', 'RB', 'KM', 'JM', 'SB'];
        $date = Carbon::now();
        $transaction = Transaction::whereDate('created_at', Carbon::today())->get()->count() + 1;
        return $day[$date->dayOfWeek] . $date->format('dmy') . str_pad($transaction, 3, '0', STR_PAD_LEFT);
    }

    /**
     * @return BelongsTo
     */
    public function paymentMethod()
    {
        return $this->belongsTo('App\Models\PaymentMethod');
    }

    /**
     * @return BelongsTo
     */
    public function statusOrder()
    {
        return $this->belongsTo('App\Models\StatusOrder');
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * @return HasMany
     */
    public function transactionDetails()
    {
        return $this->hasMany('App\Models\TransactionDetail');
    }
}
