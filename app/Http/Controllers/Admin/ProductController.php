<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $products = Product::latest()->paginate(20);
        return view('admin.products.index' , compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::all();
        $categories = Category::where('parent_id', '!=', 0)->get();

        return view('admin.products.create', compact('tags', 'categories'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'is_active'=>'required',
            'tag_id'=>'required',
            'primary_image'=>'required|mimes:jpg,jpeg,png,svg',
            'images'=>'required',
            'description'=>'required',
            'price'=>'required',
            'quantity'=>'required',
            'images.*'=>'mimes:jpg,jpeg,png,svg',
            'category_id'=>'required',
            'delivery_amount'=>'required|integer',
            'delivery_amount_per_product'=>'nullable|integer',
        ]);

        try
        {
        DB::beginTransaction();
        $productImageController = new ProductImageController();
        $fileNameImages = $productImageController->upload($request->primary_image , $request->images);

        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'sku' => $request->sku,
            'sale_price' => $request->sale_price,
            'date_on_sale_from' => $request->date_on_sale_from,
            'date_on_sale_to' => $request->date_on_sale_to,
            'category_id' => $request->category_id,
            'primary_image' => $fileNameImages['fileNamePrimaryImage'],
            'description' => $request->description,
            'is_active' => $request->is_active,
            'delivery_amount' => $request->delivery_amount,
            'delivery_amount_per_product' => $request->delivery_amount_per_product,
        ]);

        foreach($fileNameImages['fileNameImages'] as $fileNameImage)
        {
            ProductImage::create([
                'product_id' => $product->id,
                'image' => $fileNameImage
            ]);
        }

        $product->tags()->attach($request->tag_id);

        DB::commit();
        }catch(\Exception $ex)
        {
            DB::rollBack();
            alert()->error('  مشکل در ایجاد  محصول ', $ex->getMessage())->persistent('حله');
            return redirect()->back();
        }

        alert()->success('با موفقیت انجام شد','محصول با موفقیت ایجاد شد');
        return redirect()->route('admin.products.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $images = $product->images;
        return view('admin.products.show' , compact('product' , 'images'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::where('parent_id', '!=', 0)->get();
        return view('admin.products.edit' , compact('product' , 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'=>'required',
            'is_active'=>'required',
            'description'=>'required',
            'price'=>'required',
            'category_id'=>'required',
            'quantity'=>'required',
        ]);

        try
        {
        DB::beginTransaction();

        $product ->update([
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'sku' => $request->sku,
            'category_id' => $request->category_id,
            'sale_price' => $request->sale_price,
            'date_on_sale_from' => $request->date_on_sale_from,
            'date_on_sale_to' => $request->date_on_sale_to,
            'description' => $request->description,
            'is_active' => $request->is_active,
            'delivery_amount' => $request->delivery_amount,
            'delivery_amount_per_product' => $request->delivery_amount_per_product,
        ]);


        DB::commit();
        }catch(\Exception $ex)
        {
            DB::rollBack();
            alert()->error('  مشکل در ویرایش  محصول ', $ex->getMessage())->persistent('حله');
            return redirect()->back();
        }

        alert()->success('با موفقیت انجام شد','محصول با موفقیت ویرایش شد');
        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function editCategory(Request $request, Product $product)
    {
        $categories = Category::where('parent_id', '!=', 0)->get();
        return view('admin.products.edit-category' , compact('product' , 'categories'));
    }

    public function updateCategory(Request $request, Product $product)
    {
        $request->validate([
            'category_id'=>'required',
            'attribute_ids'=>'required',
            'attribute_ids.*'=>'required',
            'variation_values'=>'required',
            'variation_values.*.*'=>'required',
            'variation_values.price.*'=>'integer',
            'variation_values.quantity.*'=>'integer',
        ]);

        try
        {
        DB::beginTransaction();

        $product->update([
            'category_id' => $request->category_id,
        ]);

        $ProductAttributeController = new ProductAttributeController();
        $ProductAttributeController->change($request->attribute_ids , $product);

        $category = Category::find($request->category_id);
        $ProductVariationController = new ProductVariationController();
        $ProductVariationController->change($request->variation_values , $category->attributes()->wherePivot('is_variation' , 1)->first()->id , $product);

        DB::commit();
        }catch(\Exception $ex)
        {
            DB::rollBack();
            alert()->error('  مشکل در ایجاد  محصول ', $ex->getMessage())->persistent('حله');
            return redirect()->back();
        }

        alert()->success('با موفقیت انجام شد','محصول با موفقیت ایجاد شد');
        return redirect()->route('Admin.products.index');
    }
}
