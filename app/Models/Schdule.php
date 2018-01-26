<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schdule extends Model
{
    protected $table = 'tbl_schdule';

    protected $primaryKey = '_id';

    protected $fillable = ['openid','plan','schdule_time'];

    protected $dateFormat = 'U';

    const CREATED_AT = 'create_time';

    const UPDATED_AT = 'update_time';

}