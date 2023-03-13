<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Category';
	    return view('admin.category.index',compact('title'));
    }
  
	public function getCategories(Request $request){
		$columns = array(
			0 => 'id',
			1 => 'name',
			2 => 'status',
			3 => 'created_at',
			4 => 'action'
		);
		
		$totalData = Category::count();
		$limit = $request->input('length');
		$start = $request->input('start');
		$order = $columns[$request->input('order.0.column')];
		$dir = $request->input('order.0.dir');
		
		if(empty($request->input('search.value'))){
			$categories = Category::offset($start)
				->limit($limit)
				->orderBy($order,$dir)
				->get();
			$totalFiltered = Category::count();
		}else{
			$search = $request->input('search.value');
			$categories = Category::where([
				['name', 'like', "%{$search}%"],
			])
				->orWhere('created_at','like',"%{$search}%")
				->offset($start)
				->limit($limit)
				->orderBy($order, $dir)
				->get();
			$totalFiltered = Category::where([
				
				['name', 'like', "%{$search}%"],
			])
				->orWhere('name', 'like', "%{$search}%")
				->orWhere('created_at','like',"%{$search}%")
				->count();
		}
		
		
		$data = array();
		
		if($categories){
			foreach($categories as $r){
				$edit_url = route('categories.edit',$r->id);
				$nestedData['id'] = '<td><label class="checkbox checkbox-outline checkbox-success"><input type="checkbox" name="categories[]" value="'.$r->id.'"><span></span></label></td>';
				$nestedData['name'] = $r->name;
				$nestedData['status'] = $r->status;
				$nestedData['created_at'] = date('d-m-Y',strtotime($r->created_at));
				$nestedData['action'] = '
                                <div>
                                <td>
                                    <a class="btn btn-sm btn-clean btn-icon" onclick="event.preventDefault();viewInfo('.$r->id.');" title="View Category" href="javascript:void(0)">
                                        <i class="icon-1x text-dark-50 flaticon-eye"></i>
                                    </a>
                                    <a title="Edit Category" class="btn btn-sm btn-clean btn-icon"
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
	public function categoryDetail(Request $request)
	{
		
		$categories = Category::findOrFail($request->id);
		
		
		return view('admin.category.detail', ['title' => 'Category Detail', 'categories' => $categories]);
	}
    public function create()
    {
	    $title = 'Add New Category';
	    return view('admin.category.create',compact('title'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
		    'name' => 'required|max:255',
		
	    ]);
       
        $category = Category::create([
            'name'   => $request->name,
           
        ]);
        
	    Session::flash('success_message', 'Great! Category has been saved successfully!');
        return redirect()->route('categories.index');
    }


    public function edit($id)
    {
        $category = Category::findorfail($id);
        $title = 'Add New Category';
	    return view('admin.category.edit',compact('title','category'));
    }

   
    public function update(Request $request, $id)
    {
        $this->validate($request, [
		    'name' => 'required|max:255',
		
	    ]);
        $input = $request->all();
        $res = array_key_exists('status', $input);
	    if ($res == false) {
		    $status = 0;
	    } else {
		    $status = 1;
		
	    }
        $category = Category::where('id',$id)->update([
            'name'   => $request->name,
            'status' => $status
        ]);
        
	    Session::flash('success_message', 'Great! Category has been updated successfully!');
        return redirect()->route('categories.index');
    }

   
	public function destroy($id)
    {
	    $category = Category::find($id);
	    if(!empty($category)){
		    $category->product->each->delete();
			$category->delete();
		    Session::flash('success_message', 'category successfully deleted!');
	    }
	    return redirect()->route('categories.index');
	   
    }
	public function deleteSelectedCategory(Request $request)
	{
		$input = $request->all();
		$this->validate($request, [
			'categories' => 'required',
		
		]);
		foreach ($input['categories'] as $index => $id) {
			
			$category = Category::find($id);
			if(!empty($category)){
				$category->product->each->delete();
				$category->delete();
			}
			
		}
		Session::flash('success_message', 'category successfully deleted!');
		return redirect()->back();
		
	}
}
