@extends('admin.layouts.adminMaster')

@section('content')

<div class="container-fluid">

   <div class="card">

      <div class="card-header d-flex justify-content-between">
        <h5>Project Locations</h5>

        <a href="{{ route('admin.location.create') }}"
        class="btn btn-primary btn-sm">
        + Add Location
     </a>
  </div>

  <div class="card-body">

   <table class="table table-bordered table-striped">

      <thead>
         <tr>
            <th>#</th>
            <th>Title</th>
            <th>Description</th>
            <th>Projects</th>
            <th>Action</th>
         </tr>
      </thead>

      <tbody>

         @forelse($locations as $item)

         <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->title }}</td>
            <td>{{ Str::limit($item->description,50) }}</td>
            <td>{{ $item->posts->count() }}</td>

            <td>

               <a class="btn btn-info btn-xs"
               href="{{ route('admin.location.edit',$item->id) }}">
               Edit
            </a>

            <a class="btn btn-danger btn-xs"
            onclick="return confirm('Delete This Location?')"
            href="{{ route('admin.location.delete',$item->id) }}">
            Delete
         </a>

      </td>
   </tr>

   @empty
   <tr>
      <td colspan="4" class="text-center">No Data Found</td>
   </tr>
   @endforelse

</tbody>

</table>

{{ $locations->links() }}

</div>
</div>

</div>

@endsection