<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'note',
        'image',
        'section_id',
        'user_add_id',
    ];
    

    /**
     * القسم الأب (لو القسم تابع لقسم رئيسي).
     */
    public function parent()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
    public function contents()
    {
        return $this->hasMany(Content::class); // أو Articles أو أي اسم جدول عندك
    }


    /**
     * الأقسام الفرعية (اللي تابعين للقسم ده).
     */
    public function children()
    {
        return $this->hasMany(Section::class, 'section_id');
    }

    /**
     * المستخدم اللي أضاف القسم.
     */
    public function addedBy()
    {
        return $this->belongsTo(User::class, 'user_add_id');
    }
}
