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
 */
class Customer extends Model
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

}
