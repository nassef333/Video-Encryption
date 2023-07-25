<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\UserWeeks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $searchTerm = $request->query('searchTerm');
        
        if ($searchTerm) return $this->search($request);
        
        $transactions = Transaction::paginate(20);
    
        return view('transactions.index', compact('searchTerm', 'transactions'));
    }

    public function search(Request $request)
    {
        $searchTerm = $request->query('searchTerm');
        $transactions = Transaction::where(function ($query) use ($searchTerm) {
                $query->where('invoice_id', 'like', "%$searchTerm%")
                ->orWhere('reference_id', 'like', "%$searchTerm%")
                ->orWhere('payment_method', 'like', "%$searchTerm%")
                ->orWhere('id', 'like', "%$searchTerm%");
            })
            ->paginate(20)
            ->appends(['searchTerm' => $searchTerm]);
    
        return view('transactions.index', compact('searchTerm', 'transactions'));
    }

    public function store(Request $request, $course_id)
    {
        $transaction = Transaction::create([

            'course_id' => $course_id,
        ]);

        UserWeeks::create([
            'user_id' => Auth::id(),
            'week_id' => $course_id,
            'tranaction_id' => $transaction->id,

        ]);
        return redirect()->route('transactions.index')->with('success', 'Transaction created successfully.');
    }

    public function edit(Transaction $transaction)
    {
        return view('transactions.edit', compact('transaction'));
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect('transactions');
    }
}
