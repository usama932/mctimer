@extends('admin.layouts.master')
@section('title',$title)
@section('content')
  <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader" kt-hidden-height="54" style="">
      <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
          <!--begin::Page Heading-->
          <div class="d-flex align-items-baseline flex-wrap mr-5">
            <!--begin::Page Title-->
            <h5 class="text-dark font-weight-bold my-1 mr-5">Dashboard</h5>
            <!--end::Page Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
              <li class="breadcrumb-item text-muted">
                <a href="" class="text-muted">Manage Product</a>
              </li>
              <li class="breadcrumb-item text-muted">
                <a href="" class="text-muted">Add Product</a>
              </li>
            </ul>
            <!--end::Breadcrumb-->
          </div>
          <!--end::Page Heading-->
        </div>
        <!--end::Info-->
      </div>
    </div>
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid">
      <!--begin::Container-->
      <div class="container">
        <!--begin::Card-->
        <div class="card card-custom card-sticky" id="kt_page_sticky_card">
          <div class="card-header" style="">
            <div class="card-title">
              <h3 class="card-label">Product Add Form
                <i class="mr-2"></i>
                <small class="">try to scroll the page</small></h3>

            </div>
            <div class="card-toolbar">

              <a href="{{ route('products.index') }}" class="btn btn-light-primary
              font-weight-bolder mr-2">
                <i class="ki ki-long-arrow-back icon-sm"></i>Back</a>

              <div class="btn-group">
               <a href=""  onclick="event.preventDefault(); document.getElementById('product_update_form').submit();" id="kt_btn" class="btn btn-primary font-weight-bolder">
                  <i class="ki ki-check icon-sm"></i>update</a>




              </div>
            </div>
          </div>
          <div class="card-body">
          @include('admin.partials._messages')
          <!--begin::Form-->
            {   {{ Form::model($products, [ 'method' => 'PATCH','route' => ['products.update', $products->id],'class'=>'form' ,"id"=>"product_update_form", 'enctype'=>'multipart/form-data'])}}
              @csrf
              <div class="row">
                <div class="col-xl-2"></div>
                <div class="col-xl-8">
                  <div class="my-5">
                    <h3 class="text-dark font-weight-bold mb-10">Product Info: </h3>
                    <div class="form-group row {{ $errors->has('name') ? 'has-error' : '' }}">
                      <label class="col-3">Name</label>
                      <div class="col-9">
                        {{ Form::text('name', null, ['class' => 'form-control form-control-solid','id'=>'name','placeholder'=>'Enter Name','required'=>'true']) }}
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                      </div>
                    </div>
                    
                    <div class="form-group row {{ $errors->has('name') ? 'has-error' : '' }}">
                      <label class="col-3">Categories</label>
                      <div class="col-9">
                        <select class="form-control form-control-solid" name="category" id="category-select">
                        
                          @foreach($categories as $catgory)
                            <option value="{{$catgory->id}}" class="form-control form-control-solid" @if($catgory->id == $products->category_id )  selected @endif>{{$catgory->name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="form-group row {{ $errors->has('iamge') ? 'has-error' : '' }}">
                      <label class="col-3 col-form-label text-right ">Thumbnail Image:</label>
                      <div class="col-9">


                        <input type="file" class="form-control form-control-solid mb-3" name="image" id="image">
                         <small class=" form-text text-muted  ">Image size is must less than 2MB</small>
                        <img src="{{asset("uploads/$products->image")}}" width="150px" height="100px" alt="">

                       
                      </div>
                    </div>

                     <div class="form-group row">
                      <label class="col-3 col-form-label">Expiry Years</label>
                      <div class="col-3">
                        <select id="year" name="year" class="form-control form-control-solid ">
                          @for ($i = 0; $i <= 12; ++$i) {
                            <option value="{{ $i }}" class="form-control form-control-solid" @if($i == $data->year) selected @endif>{{ $i }}</option>
                          
                          @endfor
                        </select>            
                      </div>
                      <label class="col-3 col-form-label">Expiry Months</label>
                      <div class="col-3">
                        <select id="month" name="month" class="form-control form-control-solid ">
                          @for ($i = 0; $i <= 12; ++$i) {
                            <option value="{{ $i }}" class="form-control form-control-solid" @if($i == $data->month) selected @endif>{{ $i }}</option>
                          
                          @endfor
                        </select>
                        
                      </div>
                    </div>


                    <div class="form-group row">
                      <label class="col-3 col-form-label">Expiry Days</label>
                      <div class="col-3">
                        <select id="days" name="days" class="form-control form-control-solid ">
                          @for ($i = 0; $i <= 31; ++$i) {
                            <option value="{{ $i }}" class="form-control form-control-solid" @if($i == $data->days) selected @endif>{{ $i }}</option>
                          
                          @endfor
                        </select>  
                      </div>
                      <label class="col-3 col-form-label">Expiry hours</label>
                      <div class="col-3">
                        <select id="days" name="hours" class="form-control form-control-solid ">
                          @for ($i = 0; $i <= 24; ++$i) {
                            <option value="{{ $i }}" class="form-control form-control-solid" @if($i == $data->hours) selected @endif>{{ $i }}</option>
                          
                          @endfor
                        </select>  
                         
                      </div>
                    </div>

                  </div>

                </div>
                <div class="col-xl-2"></div>
              </div>
          {{Form::close()}}
            <!--end::Form-->
          </div>
        </div>
        <!--end::Card-->

      </div>
      <!--end::Container-->
    </div>
    <!--end::Entry-->
  </div>
@endsection
