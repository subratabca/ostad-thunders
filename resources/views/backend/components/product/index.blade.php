<div class="card pd-20 pd-sm-40">
  <h6 class="card-body-title">Product List</h6>
  <div><a href="{{ route('product.create') }}" class="btn btn-warning mg-b-10 float-right"><i class="fa fa-plus"></i> Add New</a></div>
  <div class="table-wrapper">
    <table id="datatable1" class="table display responsive nowrap">
      <thead>
        <tr>
          <th class="wd-5p">Sl</th>
          <th class="wd-10p">Image</th>
          <th class="wd-10p">Name</th>
          <th class="wd-10p">Price</th>
          <th class="wd-10p">Description</th>
          <th class="wd-20p">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($products as $key=>$row)
        <tr>
          <td> {{ $key+1}} </td>
          <td><img src="{{ !empty($row->image) ? asset('upload/product/medium/'.$row->image) : url('upload/no_image.jpg') }}" height="50px;" width="50px;"></td>
          <td> {{ $row->name}} </td>
          <td> {{ $row->price}} </td>
          <td>{!! \Illuminate\Support\Str::limit(new \Illuminate\Support\HtmlString($row->description), 30, '...') !!}</td>
          <td>
            <a href="{{ route('product.edit', ['product' => $row->id]) }}" class="btn btn-sm btn-info" title="Edit"><i class="fa fa-edit"></i></a>

            <form action="{{ route('product.destroy', ['product' => $row->id]) }}" method="POST" class="d-inline delete-form">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger delete-btn" title="Delete"><i class="fa fa-trash"></i></button>
            </form>
          </td>   
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

<script>  
  $(document).on("click", ".delete-btn", function(e){
    e.preventDefault();
    var form = $(this).closest('form');
    swal({
      title: "Are you sure you want to delete?",
      text: "Once deleted, this will be permanently removed!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        form.submit();
      } else {
        swal("Your data is safe!");
      }
    });
  });
</script>

