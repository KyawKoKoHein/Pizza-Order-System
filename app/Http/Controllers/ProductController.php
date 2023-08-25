<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    // product lists
    public function list()
    {
        $pizzas = Product::when(request('key'), function ($query) {
            $query->where('name', 'like', '%' . request('key') . '%');
        })
            ->orderBy('created_at', 'desc')
            ->paginate(4);
        $pizzas->appends(request()->all());

        return view('admin.products.pizzaList', compact('pizzas'));
    }

    // direct pizza create page
    public function createPage()
    {
        $categories = Category::select('id', 'name')->get();
        return view('admin.products.create', compact('categories'));
    }

    // delete pizza
    public function delete($id)
    {
        Product::where('id', $id)->delete();
        return redirect()->route('products#lists')->with('productDelete', 'Delete Success!');
    }

    // Edit Pizza
    public function edit($id)
    {
        $pizza = Product::where('id', $id)->first();
        return view('admin.products.edit', compact('pizza'));
    }

    // Pizza Update page
    public function updatePage($id)
    {
        $pizza = Product::where('id', $id)->first();
        $category = Category::get();
        return view('admin.products.update', compact('pizza', 'category'));
    }


    // product create
    public function create(Request $request)
    {
        $this->productValidationCheck($request, "create");
        $data = $this->requestProductData($request);

        $fileName = uniqid() . $request->file('pizzaImage')->getClientOriginalName();
        $request->file('pizzaImage')->storeAs('public', $fileName);
        $data['image'] = $fileName;

        Product::create($data);
        return redirect()->route('products#lists')->with('productCreate', 'Create Success!');
    }

    // Pizza Update
    public function update(Request $request)
    {
        $this->productValidationCheck($request, "update");
        $data = $this->requestProductData($request);

        if ($request->hasFile('pizzaImage')) {
            $oldImageName = Product::where('id', $request->pizzaId)->first();
            $oldImageName = $oldImageName->image;

            if ($oldImageName != null) {
                Storage::delete('public/' . $oldImageName);
            }

            $fileName = uniqid() . $request->file('pizzaImage')->getClientOriginalName();
            $request->file('pizzaImage')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        }

        Product::where('id', $request->pizzaId)->update();
        return redirect()->route('products#lists')->with('productsUpdate', 'Your Pizza is updated');
    }

    // Request Product Data
    private function requestProductData($request)
    {
        return [
            'category_id' => $request->pizzaCategory,
            'name' => $request->pizzaName,
            'description' => $request->pizzaDescription,
            'price' => $request->pizzaPrice,
            'waiting_time' => $request->pizzaWaitingTime,
        ];
    }

    // product validation check
    private function productValidationCheck($request, $action)
    {
        $validationRules = [
            'pizzaName' => 'required|min:5|unique:products,name,' . $request->pizzaId,
            'pizzaCategory' => 'required',
            'pizzaDescription' => 'required',
            'pizzaPrice' => 'required',
            'pizzaWaitingTime' => 'required',
        ];

        $validationRules['pizzaImage'] = $action == "create" ? 'required|mimes:jpg,jpeg,png|file' : 'mimes:jpg,jpeg,png|file';

        Validator::make($request->all(), $validationRules)->validate();
    }
}
