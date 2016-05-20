<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'transactions';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['company_id', 'confirmation_number', 'quantity', 'description', 'invoice_id'];


     /**
     * DB Relation Function
     *
     * @return void
     **/
    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }

    /**
     * DB Relation Function
     *
     * @return void
     **/
    public function rents()
    {
        return $this->hasMany('App\Rent');
    }

    /**
     * DB Relation Function
     *
     * @return void
     **/
    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    /**
     * Create Transactions for Tickets
     *
     * @return $tickets
     * @author Me
     **/
    public static function forTicket($company_id, $price, $invoice_id)
    {
        $transaction = new static;
        $transaction->company_id = $company_id;
        $transaction->quantity = $price;
        $transaction->invoice_id = $invoice_id;
        return $transaction;
    }

}
