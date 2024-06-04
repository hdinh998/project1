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
  <div class="container">
        <h1 style="color:red">THÊM MỚI 1 XE</h1>
        @if ($errors->any())
        <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        </div>
        @endif
        <form action="{{ route('cars.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="">Description</label>
          <input type="text" name="description" id="" class="form-control" placeholder="" aria-describedby="helpId">
        </div>
        <div class="form-group">
          <label for=""> Model</label>
          <input type="text" name="model" id="" class="form-control" placeholder="" aria-describedby="helpId">
        </div>
        <div class="form-group">
          <label for=""> Produced_on</label>
          <input type="date" name="produced_on" id="" class="form-control" placeholder="" aria-describedby="helpId">
        </div>
        <div class="form-group">
          <label for="">Hình ảnh</label>
          <div class="form-group">
            <label for=""></label>
            <input type="file" class="form-control-file" name="image_file" id="" placeholder="" aria-describedby="fileHelpId">
          </div>
          <div class="form-group">
            <label for="">Nhà sản xuất</label>
            <select class="form-control" name="mf_id" id="">
            @foreach($mfs as $mf)
              <option value="{{ $mf->id }}">{{ $mf->mf_name }}</option>
            @endforeach
            </select>
            <input name="btnThem" id="" class="btn btn-primary" type="submit" value="Thêm">
          </div>
          </form>
        </div>
      </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>