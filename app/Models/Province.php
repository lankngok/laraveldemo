<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    // Định nghĩa các trường sẽ đc thao tác vs bảng
    protected $fillable = ['name'];
    // Hàm để thực hiện lấy ra danh sách của bảng khóa ngoại: 1 province có nhiều people
    // bắt buộc phải có
    public function people()
    {
        return $this->hasMany(People::class, 'province_id', 'id');
    }

    // hàm thực hiện tìm kiếm (có thể có hoặc không)
    public function scopeSearch($query)
    {
        if (request()->keyword) {
            $key = request()->keyword;
            $query = $query->where('name', 'LIKE', '%'.$key.'%');
        }
        return $query;
    }
}
