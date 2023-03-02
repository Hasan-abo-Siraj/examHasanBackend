@extends('cms.parent')

@section('title' , ' branch')

@section('main-title' , 'Index branch')

@section('sub-title' , 'index branch')

@section('styles')

@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                {{-- <h3 class="card-title"> Index Data of branch</h3> --}}
                <div class="row mt-3">
                    <div class=" col-md-12 ">

                      <a href="{{ route('branches.create') }}" type="submit" class="btn btn-info">Add New branch</a>
                    </div>
                   </div>

              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>branch Name</th>
                      <th>email</th>
                      <th>status</th>
                      <th>desc</th>
                      <th>Company Name</th>
                      <th>Setting</th>
                      <th>show function</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($branches as $branch )
                    {{-- <td><span class="tag tag-success">Approved</span></td> --}}

                    <tr>
                        <td>{{$branch->id}}</td>
                        <td>{{ $branch->name ?? ""}}</td>
                        <td>{{ $branch->email ?? ""}}</td>
                        <td>{{$branch->status ?? ""}}</td>

                        <td>{{$branch->desc}}</td>
                        <td><span class="badge bg-info">({{$branch->company->name}}) </td>

                            <td >
                                <div class="btn group w-100 ">
                                    <a href="{{ route('branches.edit' , $branch->id) }}" type="button"
                                        @if($branch->deleted_at !== null)
                                        hidden
                                        @endif
                                        class="btn btn-info mb-md-3   ">
                                    <i class="fas fa-edit"></i>
                                    </a>
                                    <a type="button" onclick="performDestroy({{ $branch->id }} , this)" class="btn btn-danger mb-md-3">
                                    <i class="fas fa-trash-alt"></i>
                                    </a>
                                    <a href="{{ route('restore' , $branch->id) }}" type="button"
                                        @if($branch->deleted_at == null)
                                        hidden
                                        @endif
                                        class="btn btn-info mb-md-3 ">
                                        &#x21BA;
                                    </a>
                                </div>

                            </td>
                            <td>
                                <div class="btn group">


                                  <a href="{{route('branches.show' , $branch->id)}}" type="button" class="btn btn-success">
                                    <i class="fas fa-eye"></i>
                                  </a>
                                </div>
                              </td>
    </tr>
                    @endforeach


                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            {{ $branches->links()}}
          </div>
        </div>

        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection


@section('scripts')
  <script>
    function performDestroy(id , referance){
      let url = '/cms/admin/branches/'+id;
      confirmDestroy(url , referance );
    }
</script>
@endsection
