<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $id
 * @property integer $supplier_id
 * @property string $title
 * @property int $amount
 * @property int $note
 * @property string $created_at
 * @property string $updated_at
 * @property Supplier $supplier
 */
class StockGood extends Model
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
    protected $fillable = ['supplier_id', 'title', 'minimal_amount', 'maximal_amount', 'amount', 'note', 'created_at', 'updated_at'];

    /**
     * @return BelongsTo
     */
    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier');
    }

    public function search($query)
    {
        return empty($query) ? static::query()
            : static::where('title', 'like', '%' . $query . '%')
                ->orWhere('note', 'like', '%' . $query . '%')
                ->orWhere('amount', 'like', '%' . $query . '%')
                ->orWhere('minimal_amount', 'like', '%' . $query . '%')
                ->orWhere('maximal_amount', 'like', '%' . $query . '%')
                ->whereHas('supplier', function ($q) use ($query) {
                    $q->where('title', 'like', '%' . $query . '%');
                });
    }
}
