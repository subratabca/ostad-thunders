<div class="card pd-20 pd-sm-40">
  <h6 class="card-body-title">Create New Product</h6>
  <div><a href="{{ route('product.index') }}" class="btn btn-warning mg-b-10 float-right">Product List</a></div>

  <div class="form-layout">
    <form method="post" action="{{ route('product.store') }}" enctype="multipart/form-data" >
      @csrf
      <div class="row mg-b-25">

        <div class="col-lg-6">
          <div class="form-group">
            <label class="form-control-label">Name: <span class="tx-danger">*</span></label>
            <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Enter name">
            @error('name') 
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
        </div>

        <div class="col-lg-6">
          <div class="form-group">
            <label class="form-control-label">Price: <span class="tx-danger">*</span></label>
            <input type="text" class="form-control" name="price" value="{{ old('price') }}" placeholder="Enter price">
            @error('price') 
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
        </div>

        <div class="col-lg-12">
          <div class="form-group">
            <label class="form-control-label">Description: <span class="tx-danger">*</span></label>
            <textarea class="form-control" id="summernote"  name="description" value="{{ old('description') }}"> </textarea>
            @error('description') 
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
        </div>

        <div class="col-lg-4">
          <label class="form-control-label">Upload Image: <span class="tx-danger">*</span></label><br>
          <label class="custom-file">
            <input type="file" id="file" class="custom-file-input" name="image" onChange="mainImgUrl(this)" >
            <span class="custom-file-control"></span>
          </label>
          <div>
            @error('image') 
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <img src="" id="mainImg" class="mt-1">
        </div>

      </div>
      <div class="form-layout-footer">
        <button class="btn btn-info mg-r-5">Submit</button>
        <a href="{{ route('product.index') }}" class="btn btn-success">Back</a>
      </div>
    </form>
  </div>
</div>


<script type="text/javascript">
  function mainImgUrl(input){
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e){
        $('#mainImg').attr('src',e.target.result).width(150).height(100);
      };
      reader.readAsDataURL(input.files[0]);
    }
  } 
</script>

