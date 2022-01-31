<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property integer $id
 * @property integer $product_type_id
 * @property integer $product_company_id
 * @property integer $product_status_id
 * @property string $title
 * @property int $price
 * @property string $thumbnail
 * @property string $description
 * @property string $created_at
 * @property string $updated_at
 * @property ProductCompany $productCompany
 * @property ProductStatus $productStatus
 * @property ProductType $productType
 * @property TransactionDetail[] $transactionDetails
 */
class Product extends Model
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
    protected $fillable = ['product_code', 'discount_state', 'discount_price', 'product_type_id', 'product_company_id', 'product_status_id', 'title', 'price', 'thumbnail', 'description', 'created_at', 'updated_at'];

    /**
     * @return BelongsTo
     */
    public function productCompany()
    {
        return $this->belongsTo('App\Models\ProductCompany');
    }

    /**
     * @return BelongsTo
     */
    public function productStatus()
    {
        return $this->belongsTo('App\Models\ProductStatus');
    }

    /**
     * @return BelongsTo
     */
    public function productType()
    {
        return $this->belongsTo('App\Models\ProductType');
    }

    /**
     * @return HasMany
     */
    public function transactionDetails()
    {
        return $this->hasMany('App\Models\TransactionDetail');
    }

    public function search($query)
    {
        return empty($query) ? static::query()
            : static::where('title', 'like', '%' . $query . '%')
                ->orWhere('description', 'like', '%' . $query . '%')
                ->whereHas('productType', function ($q) use ($query) {
                    $q->where('title', 'like', '%' . $query . '%');
                })->whereHas('productStatus', function ($q) use ($query) {
                    $q->where('title', 'like', '%' . $query . '%');
                })->whereHas('productCompany', function ($q) use ($query) {
                    $q->where('title', 'like', '%' . $query . '%');
                });
    }
}
