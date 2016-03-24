<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Auth;

class TransactionsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $transactions = Transaction::paginate(15);

        return view('backend.transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.transactions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        Auth::user()->charge(100, [
            'source' => $request->input('stripeToken')
            ]);

        // Transaction::create($request->all());

        // Session::flash('flash_message', 'Transaction added!');

        return redirect('admin/transactions');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function show($id)
    {
        $transaction = Transaction::findOrFail($id);

        return view('backend.transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $transaction = Transaction::findOrFail($id);

        return view('backend.transactions.edit', compact('transaction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $this->validate($request, ['user_id' => 'required', 'source_id' => 'required', ]);

        $transaction = Transaction::findOrFail($id);
        $transaction->update($request->all());

        Session::flash('flash_message', 'Transaction updated!');

        return redirect('admin/transactions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        Transaction::destroy($id);

        Session::flash('flash_message', 'Transaction deleted!');

        return redirect('admin/transactions');
    }

}
