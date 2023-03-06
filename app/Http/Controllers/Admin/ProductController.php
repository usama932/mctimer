<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
   
    public function index()
    {
        $title = 'Product';
	    return view('admin.product.index',compact('title'));
    }

    public function getProducts(Request $request){
     
		$columns = array(
			0 => 'id',
			1 => 'name',
			2 => 'category_id',
			3 => 'created_at',
			4 => 'action'
		);
		
		$totalData = Product::count();
		$limit = $request->input('length');
		$start = $request->input('start');
		$order = $columns[$request->input('order.0.column')];
		$dir = $request->input('order.0.dir');
		
		if(empty($request->input('search.value'))){
			$products = Product::offset($start)
				->limit($limit)
				->orderBy($order,$dir)
				->get();
			$totalFiltered = Product::count();
		}else{
			$search = $request->input('search.value');
			$products = Product::where([
				['name', 'like', "%{$search}%"],
			])
				->orWhere('created_at','like',"%{$search}%")
				->offset($start)
				->limit($limit)
				->orderBy($order, $dir)
				->get();
			$totalFiltered = Product::where([
				
				['name', 'like', "%{$search}%"],
			])
				->orWhere('name', 'like', "%{$search}%")
				->orWhere('created_at','like',"%{$search}%")
				->count();
		}
		
		
		$data = array();
		
		if($products){
			foreach($products as $r){
				$edit_url = route('products.edit',$r->id);
				$nestedData['id'] = '<td><label class="checkbox checkbox-outline checkbox-success"><input type="checkbox" name="products[]" value="'.$r->id.'"><span></span></label></td>';
				$nestedData['name'] = $r->name;
				$nestedData['category_id'] = $r->category_id;
				$nestedData['created_at'] = date('d-m-Y',strtotime($r->created_at));
				$nestedData['action'] = '
                                <div>
                                <td>
                                    <a class="btn btn-sm btn-clean btn-icon" onclick="event.preventDefault();viewInfo('.$r->id.');" title="View Client" href="javascript:void(0)">
                                        <i class="icon-1x text-dark-50 flaticon-eye"></i>
                                    </a>
                                    <a title="Edit Client" class="btn btn-sm btn-clean btn-icon"
                                       href="'.$edit_url.'">
                                       <i class="icon-1x text-dark-50 flaticon-edit"></i>
                                    </a>
                                    <a class="btn btn-sm btn-clean btn-icon" onclick="event.preventDefault();del('.$r->id.');" title="Delete Client" href="javascript:void(0)">
                                        <i class="icon-1x text-dark-50 flaticon-delete"></i>
                                    </a>
                                </td>
                                </div>
                            ';
				$data[] = $nestedData;
			}
		}
		
		$json_data = array(
			"draw"			=> intval($request->input('draw')),
			"recordsTotal"	=> intval($totalData),
			"recordsFiltered" => intval($totalFiltered),
			"data"			=> $data
		);
		
		echo json_encode($json_data);
		
	}
	public function productDetail(Request $request)
	{
		
		$products = Product::where('id',$request->id)->with('category')->first();
		
		
		return view('admin.product.detail', ['title' => 'products Detail', 'products' => $products]);
	}
    
    public function create()
    {
	    $title = 'Add New Products';
        $categories = Category::where('status','1')->latest()->get();
	    return view('admin.product.create',compact('title','categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
		    'name'      => 'required|max:255',
            'category'  => 'required',
            'expiry_date' => 'required',
		
	    ]);
        $product = Product::create([
            'name'          => $request->name,
            'category_id'      => $request->category,
            'expiry_date_time'   => $request->expiry_date,

        ]);
        Session::flash('success_message', 'Great! Product has been Created successfully!');
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = 'Edit Products';
        $products = Product::findOrFail($id);
        $categories = Category::where('status','1')->latest()->get();
	    return view('admin.product.edit',compact('title','products','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
		    'name'      => 'required|max:255',
            'category'  => 'required',
            'expiry_date' => 'required',
		
	    ]);
        $product = Product::where('id',$id)->update([
            'name'          => $request->name,
            'category_id'      => $request->category,
            'expiry_date_time'   => $request->expiry_date,

        ]);
        Session::flash('success_message', 'Great! Product has been updated successfully!');
        return redirect()->route('products.index');
    }

   
    public function destroy($id)
    {
	    $product = Product::find($id);
	    if(!empty($product)){
		    $category->delete();
		    Session::flash('success_message', 'category successfully deleted!');
	    }
	    return redirect()->route('categories.index');
	   
    }
	public function deleteSelectedCategory(Request $request)
	{
		$input = $request->all();
		$this->validate($request, [
			'products' => 'required',
		
		]);
		foreach ($input['product'] as $index => $id) {
			
			$product = Product::find($id);
			if(!empty($product)){
				$product->delete();
			}
			
		}
		Session::flash('success_message', 'products successfully deleted!');
		return redirect()->back();
		
	}
}
