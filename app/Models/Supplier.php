<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $title
 * @property string $no_phone
 * @property string $email
 * @property string $address
 * @property string $created_at
 * @property string $updated_at
 * @property StockGood[] $stockGoods
 */
class Supplier extends Model
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
    protected $fillable = ['title', 'no_phone', 'email', 'address', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stockGoods()
    {
        return $this->hasMany('App\Models\StockGood');
    }
    public function search($query){
        return empty($query) ? static::query()
            : static::where('title', 'like', '%' . $query . '%');
    }
}
