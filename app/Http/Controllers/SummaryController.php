<?php

namespace App\Http\Controllers;

use App\Models\Summary;
use Illuminate\Http\Request;

class SummaryController extends Controller
{
    public function store($data)
    {
        Summary::create($data);
        return response('Created', 200);
    }

    public function summary(Request $request)
    {
        $sales_summary = Summary::get()
            ->limit(5)
            ->with('products')
            ->groupBy('product_id')
            ->whereMonth('updated_at', $request->month) # @var --> int
            ->where('user_id', $request->id);

        $top_selling_products = Summary::paginate(15)
            ->with('products')
            ->groupBy('product_id')
            ->whereMonth('updated_at', $request->month) # @var --> int
            ->where('user_id', $request->id);

        return [
            'sales_summary' => $sales_summary,
            'top_selling_products' =>   $top_selling_products
        ];
    }
}
