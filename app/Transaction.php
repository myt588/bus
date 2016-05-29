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
    protected $fillable = ['company_id', 'booking_no', 'quantity', 'description', 'invoice_id', 'user_id'];


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
     * DB Relation Function
     *
     * @return void
     **/
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Create Transactions for Tickets
     *
     * @return $tickets
     * @author Me
     **/
    public static function forTicket($user_id, $company_id, $price, $invoice_id)
    {
        $transaction = new static;
        $transaction->user_id = $user_id;
        $transaction->company_id = $company_id;
        $transaction->quantity = $price;
        $transaction->invoice_id = $invoice_id;
        $transaction->booking_no = substr($invoice_id, 3, 8);
        $transaction->save();
        return $transaction;
    }

    /**
     * Scope by invoice id
     *
     * @return $query 
     * @author ME
     **/
    public function scopeByInvoice($query, $invoice_id)
    {
        return $query->where('invoice_id', '=', $invoice_id)->get();
    }

    /**
     * Scope by booking number id
     *
     * @return $query 
     * @author ME
     **/
    public function scopeByBookingNo($query, $booking_no)
    {
        return $query->where('booking_no', '=', $booking_no)->get();
    }

}
