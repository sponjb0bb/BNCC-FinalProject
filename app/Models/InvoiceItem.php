<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvoiceItem extends Model
{   
    use hasFactory;

    protected $fillable = [
        'invoice_id',
        'item_id',
        'quantity',
        'subtotal',
    ];

    public function invoice(): BelongsTo
    {
        $this->belongsTo(Invoice::class, invoice_id);
    }

    public function item(): BelongsTo
    {
        $this->belongsTo(item::class, item_id);
    }
}
