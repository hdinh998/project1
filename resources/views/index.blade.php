<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
  <style>
        /* Thêm CSS tùy chỉnh vào đây */

        /* Tùy chỉnh màu nền và màu chữ cho tiêu đề */
        h1 {
            background-color: #007bff;
            color: white;
            padding: 10px 0;
            margin-bottom: 20px;
        }

        /* Tùy chỉnh kích thước của bảng */
        .table {
            width: 100%;
        }

        /* Tùy chỉnh màu nền và màu chữ của tiêu đề cột */
        .table th {
            background-color: #007bff;
            color: white;
        }

        /* Tùy chỉnh màu nền của dòng chẵn trong bảng */
        .table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
    <div class="container">
      @if (session('message'))
        <div class="alert alert-success">
          {{ session('message') }}
        </div>
      @endif
      @php
      $stt = 0;
      @endphp
    </div>
      <div class="container">
      <h1 style="color: white; text-align:center;">Danh sách xe</h1>
      
      <h6>Đinh Minh Hà</h6>

      <!-- Form tìm kiếm -->
      <form action="{{ route('postSearch') }}" method="post">
            @csrf
            <input type="text" name="txtSearch" id="" class="form-control" placeholder="Tìm kiếm theo model/description/Mf_name" aria-describedby="helpId">
            <input name="btnSearch" id="" class="btn btn-primary" type="submit" value="Tìm kiếm">
      </form>

      <a name="" id="" class="btn btn-success" href="{{route('cars.create')}}" role="button">Thêm mới 1 xe</a>
      <table class="table">
        <thead>
          <tr>
          <th scope="col">STT</th>
            <th scope="col">ID</th>
            <th scope="col">description</th>
            <th scope="col">model</th>
            <th scope="col">produced_on</th>
            <th scope="col">mf_name</th>
            <th scope="col">image</th>
            <th scope="col">Chức năng</th>

            <!-- Thêm các cột khác nếu cần -->
          </tr>
        </thead>
        <tbody>
        @if(isset($cars))
                  @php
                   $cars=$cars      
                  @endphp
              @else
                  @php
                    $cars=$cars_search
                  @endphp
              @endif
          @foreach($cars as $xe)
          <form action="{{ route('cars.destroy',['car'=>$xe->id]) }}" method="post">
                @csrf
                @method('delete')
          <tr>
          <td>{{ ++$stt }}</td>
            <td>{{ $xe->id }}</td>
            <td>{{ $xe->description}}</td>
            <td>{{ $xe->model }}</td>
            <td>{{ $xe->produced_on }}</td>
            <td>{{ $xe->mf->mf_name }}</td>
            <td>
            <img src="/images/{{$xe->image}}" alt="Car Image" style="max-width: 100px; max-height: 100px;">
            </td>
            <td>
              
              <a name="btnChitiet" id="" class="btn btn-primary" href="{{ route('cars.show',['car'=>$xe->id]) }}" role="button">Chi tiết</a>
              <a name="btnSua" id="" class="btn btn-info" href="{{ route('cars.edit',['car'=>$xe->id]) }}" role="button">Sửa</a>
              <input name="btnXoa" id="" class="btn btn-danger" type="submit" value="Xóa">
            </td>
            <!-- Thêm các cột khác tương ứng nếu cần -->
          </tr>
      </form>
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>