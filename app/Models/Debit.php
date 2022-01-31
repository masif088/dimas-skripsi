<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $note
 * @property int $amount
 * @property string $created_at
 * @property string $updated_at
 */
class Debit extends Model
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
    protected $fillable = ['name', 'note', 'amount', 'created_at', 'updated_at'];

}
