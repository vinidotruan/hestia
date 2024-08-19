<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Picture extends Model
{
    protected $table = 'picture';
    protected $fillable = ['name', 'url', 'main', 'user_id'];

    public function delete(): ?bool
    {
        Storage::disk('public')->delete($this->name);
        return parent::delete();
    }
}
