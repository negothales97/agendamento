<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'transaction_id',
        'transaction_status',
        'value',
        'type',
        'description',
        'value_avivare',
        'value_specialist',
        'customer_id',
        'specialist_id',
        'schedule_id'
    ];

    protected $appends = [
        'status_name'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id');
    }
    public function specialist()
    {
        return $this->belongsTo(Specialist::class, 'specialist_id');
    }

    public function getStatusNameAttribute()
    {
        $status = [
            'paid' => 'Pagamento Realizado',
            'refused' => 'Pagamento Recusado',
            'processing' => 'Processando',
            'refunded' => 'Transação Estornada',
        ];
        return $status[$this->transaction_status] ?? 'Status não localizado';
    }
}
