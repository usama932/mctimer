<div class="card-datatable table-responsive">
	<table id="clients" class="datatables-demo table table-striped table-bordered">
		<tbody>
		<tr>
			<td>Name</td>
			<td>{{$products->name ?? " "}}</td>
		</tr>
		<tr>
			<td>Category</td>
			<td>{{$products->category->name ?? ' '}}</td>
		</tr>
		<tr>
			<td>Expiry Date</td>
			<td>{{$products->expiry_date_time ?? ''}}</td>
		</tr>
		<tr>
			<td>Created at</td>
			<td>{{$products->created_at}}</td>
		</tr>
		
		</tbody>
	</table>
</div>
