<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'section_id',
        'type',
        'value',
        'file',
        'note',
        'user_add_id',
    ];

    /**
     * القسم المرتبط بالمحتوى.
     */
    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }



    /**
     * المستخدم الذي أضاف هذا المحتوى.
     */
    public function addedBy()
    {
        return $this->belongsTo(User::class, 'user_add_id');
    }
}
