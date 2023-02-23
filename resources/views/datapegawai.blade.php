<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD LARAVEL 8</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  </head>
  <body>
    <h1 class="text-center mb-4">Data Pegawai</h1>
        <div class="container">
            <a href="/tambahpegawai" type="button" class="btn btn-success mb-2">Tambah +</a>
            <div class="row g-3 align-items-center">
              <div class="col-auto">
                <form action="/pegawai" method="GET">
                <input type="text" aria-label="Search" id="inputPassword6" name="search" class="form-control" aria-describedby="passwordHelpInline">
                </form>
              </div>
              <div class="col-auto">
                <a href="/exportpdf" type="button" class="btn btn-info">Export PDF</a>
              </div>
              <div class="col-auto">
                <a href="/exportexcel" type="button" class="btn btn-success">Export Excel</a>
              </div>
            </div>
            <div class="row">
              {{-- @if ($message = Session::get('success'))
              <div class="alert alert-success" role="alert">
                {{ $message }}
              </div>
              @endif --}}
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">No Telpon</th>
                        <th scope="col">Dibuat</th>
                        <th scope="col">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                            $no= 1;
                        @endphp
                        @foreach ($data as $index => $row)
                        <tr>
                        <th scope="row">{{ $index + $data->firstItem() }}</th>
                        <td>{{ $row->nama }}</td>
                        <td>
                          <img src="{{asset('fotopegawai/'.$row->foto)}}" alt="" style="width: 40px;">
                        </td>
                        <td>{{ $row->jeniskelamin }}</td>
                        <td>0{{ $row->notelpon }}</td>
                        <td>{{ $row->created_at->diffForHumans() }}</td>
                        <td>
                            <a href="/tampilkandata/{{ $row->id }}" class="btn btn-info mx-2">Edit</button>
                            <a href="#" class="btn btn-danger delete" data-id="{{ $row->id }}" data-nama="{{ $row->nama }}">Delete</button>
                        </td>
                      </tr>
                        @endforeach
                      
                    </tbody>
                  </table>
                  {{ $data->links() }}
            </div>
        </div>
        <script
          src="https://code.jquery.com/jquery-3.6.3.min.js"
          integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
          crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  </body>
  <script>
    $('.delete').click( function(){
      var Pegawaiid = $(this).attr('data-id');
      var nama = $(this).attr('data-nama');
      const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success mx-2',
        cancelButton: 'btn btn-danger'
      },
      buttonsStyling: false
    })

      swalWithBootstrapButtons.fire({
        title: 'Yakin?',
        text: "Kamu Akan Menghapus Data Pegawai Dengan Nama "+nama+" ",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
          window.location = "/delete/"+Pegawaiid+""
          swalWithBootstrapButtons.fire(
            'Deleted!',
            'Data Berhasil Di Hapus',
            'success'
          )
        } else if (
          /* Read more about handling dismissals below */
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalWithBootstrapButtons.fire(
            'Cancelled',
            'Data Tidak Jadi Di Hapus :)',
            'error'
          )
        }
      })
    })
  </script>
 
</html>