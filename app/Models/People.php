<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;
    // Định nghĩa các trường sẽ đc thao tác vs bảng
    protected $fillable = ['name', 'province_id', 'avatar',    'birthday',    'gender', 'about'];

    // Hàm để lấy ra tên của province tương ứng với province_id: 1 people chỉ có 1 province (bắt buộc phải có)
    public function provinces()
    {
        return $this->hasOne(Province::class, 'id', 'province_id');
    }

    // hàm tìm kiếm (k bắt buộc phải có)
    public function scopeSearch($query)
    {
        if (request()->keyword) {
            $key = request()->keyword;
            $query = $query->where('name', 'LIKE', '%'.$key.'%');
        }
        return $query;
    }
}
