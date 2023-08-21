<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }
    public function getStatusNameAttribute()
    {
        switch ($this->status) {
            case 1:
                return 'طلب حجز';
            case 2:
                return 'الدفع';
            case 3:
                return 'تقديم المستندات';
            case 4:
                return 'الاستقدام';
            case 5:
                return 'التسليم';
            default:
                return 'غير معروف';
                break;
        }
    }
}
