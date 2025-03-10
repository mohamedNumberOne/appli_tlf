<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Warranty_Product;
use App\Models\Category;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Brand;
use App\Models\Warranty;
use Illuminate\Support\Facades\DB;



class ProductController extends Controller
{

    public function get_info_pro_ajax($id)
    {
        $pro_info = Product::find($id);
        return response()->json($pro_info);
    }
    /**
     * Display a listing of the resource.
     */
    public function ajouter_produit_page()
    {


        $all_pro = DB::table('products')

            ->leftJoin('brands', 'brands.id', '=', "products.brand_id")
            ->leftJoin('categories', 'categories.id', '=', 'products.category_id')

            ->select(
                'brand_name',
                'category_name',
                'nb_jr_garantie',
                'double_puce',
                'products.id as pro_id',
                'products.product_name',
                'prix_g_tlf',
                'prix_g_batterie',
                'prix_g_circuit',
            )
            ->paginate(15);


        $all_categories = Category::all();
        $all_brand = Brand::all();
        // $all_garanties = Warranty::all(); 

        return view('admin.ajouter_produit', compact("all_pro", 'all_categories', 'all_brand'));
    }


    /**
     * Show the form for creating a new resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function add_product(StoreProductRequest $request)
    {
 

 

        $pro =  Product::create([

            "category_id"   => $request->category_id,
            "brand_id"  => $request->brand_id,
            "product_name"  => $request->nom_pro,
            "nb_jr_garantie"  => $request->nb_jr_garantie,
            "double_puce"  => $request->double_puce,
            
            "prix_g_tlf"  => $request->prix_g_tlf,
            "prix_g_batterie"  => $request->prix_g_batterie,
            "prix_g_circuit"  => $request->prix_g_circuit,

        ]);

    
        if ($pro) {

            return  redirect()->route('ajouter_produit')->with("success", 'Produit ajouté');
        } else {

            return  redirect()->route('ajouter_produit')->with("error", 'Erreur');
        }
    }

    /**
     * Display the specified resource.
     */

    public function modifier_produit_page($id)
    {
        $product =  Product::find($id);



        if ($product) {
            $all_categories =  Category::all();
            $all_brand =  Brand::all();


            return view('admin.modifier_pro_page', compact('product', "all_categories", 'all_brand'));
        } else {
            return  redirect()->route('ajouter_produit')->with("error", 'Erreur!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function modifier_produit($id, StoreProductRequest $request)
    {
        $product = Product::find($id);


        $product->update([
            "category_id"   => $request->category_id,
            "brand_id"  => $request->brand_id,
            "product_name"  => $request->nom_pro,
            "nb_jr_garantie"  => $request->nb_jr_garantie,
            "double_puce"  => $request->double_puce,
            "prix_g_tlf"  => $request->prix_g_tlf,
            "prix_g_batterie"  => $request->prix_g_batterie,
            "prix_g_circuit"  => $request->prix_g_circuit,

        ]);

        return  redirect()->back()->with("success", 'Produit modifié');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function supp_produit($id)
    {
        $pro = Product::find($id);
        if ($pro) {
            $pro->delete();
            return  redirect()->back()->with("success", 'Produit supprimé');
        } else {

            return  redirect()->back()->with("error", 'erreur !!');
        }
    }
}
