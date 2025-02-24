<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $icon_path
 * @property int $user_creator_id
 * @property string $created_at
 * @property string $updated_at
 */
class Chat extends Model
{

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
