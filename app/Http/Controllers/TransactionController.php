<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TransactionController extends Controller
{
    public function index(Transaction $transacao = null)
    {
        $receitas = Transaction::where('valor', '>', 0)->sum('valor');
        $despesas = Transaction::where('valor', '<', 0)->sum('valor');
        $saldo = Transaction::sum('valor');

        $receitas = number_format($receitas / 100, 2, ',', '.');
        $despesas = number_format($despesas / 100, 2, ',', '.');
        $saldo = number_format($saldo / 100, 2, ',', '.');

        $transacoes = Transaction::latest()->get();

        return Inertia::render('Transactions/Index', [
            'transacoes' => $transacoes,
            'receitas' => $receitas,
            'despesas' => $despesas,
            'transacao' => $transacao,
            'saldo' => $saldo,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'descricao' => 'required|max:255',
            'valor' => 'required|string',
        ], [
            'descricao.required' => 'O campo descrição é obrigatório.',
            'descricao.max' => 'O campo descrição deve ter no máximo 255 caracteres.',
            'valor.required' => 'Informe o valor.',
            'valor.string' => 'O valor informado é inválido.',
        ]);

        Transaction::create([
            'descricao' => $request->descricao,
            'valor' => $request->valor,
        ]);

        return to_route('transactions.index');
    }

    public function update(Transaction $transacao, Request $request)
    {
        $request->validate([
            'descricao' => 'required|max:255',
            'valor' => 'required|string',
        ], [
            'descricao.required' => 'O campo descrição é obrigatório.',
            'descricao.max' => 'O campo descrição deve ter no máximo 255 caracteres.',
            'valor.required' => 'Informe o valor.',
            'valor.string' => 'O valor informado é inválido.',
        ]);

        $transacao->update([
            'descricao' => $request->descricao,
            'valor' => $request->valor,
        ]);
        return to_route('transactions.index');
    }

    public function destroy(Transaction $transacao)
    {
        $transacao->delete();
        return to_route('transactions.index');
    }
}
