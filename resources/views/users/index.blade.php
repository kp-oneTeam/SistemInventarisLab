@extends('layouts.master')
@section('users','active')
@section('content')
<section class="section">
  <div class="section-header">
    <h1>Data Users</h1>
  </div>
   <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="text-warning">Table Users</h4>
                    <div class="card-header-form">
                      <form>
                        <div class="input-group">
                          <a href="{{ url('users/create') }}" class="btn btn-warning mr-2">Tambah Data</a>
                        </div>
                      </form>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive p-sm-1">
                      <table class="table table-striped" id="myTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($data as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->username}}</td>
                                <td>
                                    @if (!empty($item->getRoleNames()))
                                        @foreach ($item->getRoleNames() as $role)
                                        {{ $role }}
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    <form method="POST" action="{{ url('users/'.$item->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ url('users/'.$item->id.'/edit') }}" class="btn btn-sm btn-icon icon-left btn-primary"><i class="far fa-edit"></i> Edit</a>
                                        @if (auth()->user()->id != $item->id)
                                        <button type="submit" class="btn btn-icon btn-sm icon-left btn-danger show_confirm" data-toggle="tooltip" title='Delete'><i class="fas fa-trash"></i>Delete</button>
                                        @endif
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
</section>
<script>
    $(document).ready(function(){
    $('#myTable').DataTable({
        "autoWidth":false,
            "columnDefs": [
                { "width": "5%", "targets": 0 }
            ],
            language: {
                "url": "{{ url('admin/js/datatable-id.json') }}",
            }
    });
    });
</script>
<script type="text/javascript">

     $('.show_confirm').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          Swal.fire({
            title: 'Apakah Anda Yakin Akan Menghapus Data?',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                form.submit();
            }
        })
      });

</script>
@endsection
