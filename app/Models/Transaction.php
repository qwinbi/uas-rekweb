<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'invoice_number',
        'total',
        'payment_method',
        'payment_proof',
        'status',
    ];

    protected $appends = ['payment_proof_url', 'formatted_total', 'formatted_date'];

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(TransactionItem::class);
    }

    // Accessors
    public function getPaymentProofUrlAttribute()
    {
        if ($this->payment_proof) {
            return asset('storage/payments/' . $this->payment_proof);
        }
        return null;
    }

    public function getFormattedTotalAttribute()
    {
        return 'Rp ' . number_format($this->total, 0, ',', '.');
    }

    public function getFormattedDateAttribute()
    {
        return $this->created_at->format('d M Y, H:i');
    }

    // Methods
    public static function generateInvoiceNumber()
    {
        $date = now()->format('Ymd');
        $latest = self::where('invoice_number', 'like', "INV-$date-%")->latest()->first();
        
        if ($latest) {
            $number = (int) substr($latest->invoice_number, -4) + 1;
        } else {
            $number = 1;
        }
        
        return 'INV-' . $date . '-' . str_pad($number, 4, '0', STR_PAD_LEFT);
    }

    public function updateStatus($status)
    {
        $this->status = $status;
        $this->save();
    }
}