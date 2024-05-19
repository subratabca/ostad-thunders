<div class="card pd-20 pd-sm-40">
  <h6 class="card-body-title">Update Product</h6>
  <div><a href="{{ route('product.index') }}" class="btn btn-warning mg-b-10 float-right">Product List</a></div>

  <div class="form-layout">
    <form method="post" action="{{ route('product.update', $product->id) }}" enctype="multipart/form-data" >
      @csrf
      @method('PUT')
      <div class="row mg-b-25">

        <div class="col-lg-6">
          <div class="form-group">
            <label class="form-control-label">Name: <span class="tx-danger">*</span></label>
            <input type="text" class="form-control" name="name" value="{{ $product->name }}">
            @error('name') 
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
        </div>

        <div class="col-lg-6">
          <div class="form-group">
            <label class="form-control-label">Price: <span class="tx-danger">*</span></label>
            <input type="text" class="form-control" name="price" value="{{ $product->price }}">
            @error('price') 
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
        </div>

        <div class="col-lg-12">
          <div class="form-group">
            <label class="form-control-label">Description: <span class="tx-danger">*</span></label>
            <textarea class="form-control" id="summernote"  name="description">{{ old('description', $product->description) }} </textarea>
            @error('description') 
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
        </div>

        <div class="col-lg-12">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label class="form-control-label">Old Image:</label>
                <img src="{{ !empty($product->image) ? asset('upload/product/small/'.$product->image) : url('upload/no_image.jpg') }}"  style="width: 200px; height: 80px;"> 
              </div>
            </div>

            <div class="col-lg-6">
              <label class="form-control-label">Upload New Image: <span class="tx-danger">*</span></label><br>
              <label class="custom-file">
                <input type="file" id="file2" class="custom-file-input" name="image" onChange="mainBannerImgUrl(this)" >
                <span class="custom-file-control custom-file-control-primary"></span>
                <input type="hidden" name="old_banner_image" value="{{ $product->image }}">
              </label>
              <img src="" id="mainBannerImg" class="mt-1">
            </div>

          </div> 
        </div>

      </div>
      <div class="form-layout-footer">
        <button class="btn btn-info mg-r-5">Update</button>
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

