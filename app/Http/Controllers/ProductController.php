<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\Models\Product;
use App\Jobs\ProductUser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use App\Models\ProductUser as ProductUserModel;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    public function like($id, Request $request)
    {
        $response = Http::get('http://docker.for.mac.localhost:8001/api/user');
        $result = $response->json();
        try {
            $productUser = ProductUserModel::create([
                'user_id'    => $result['id'],
                'product_id'    => $id
            ]);
            ProductUser::dispatch($productUser->toArray());
            return response([
                'messages'  => 'success'
            ], Response::HTTP_ACCEPTED);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
