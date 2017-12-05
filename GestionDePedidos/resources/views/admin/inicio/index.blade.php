@extends('layouts.principal')

@section('content')

<div class="container">

  <div class="row">

    <div class="col-lg-3 my-4 ">
      
      {!! Form::open(array('url'=>'inicio','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
      <div class="form-group">
        <div class="input-group">
          <input type="text" class="form-control" name="searchText" placeholder="Buscar..." value="{{$searchText}}">
          <span class="input-group-btn">
            <button type="submit" class="btn btn-primary">Buscar</button>
          </span>
        </div>
      </div>
      {{Form::close()}}

      <h3 class="my-4 text-center">Categorias</h3>
      <div class="list-group">
        @foreach ($categorias as $cat)
        <a href="{{url('/inicio/'.$cat->idcategoria)}}" class="list-group-item"> {{$cat->categoria}}</a>
        @endforeach
      </div>

    </div>
    <!-- /.col-lg-3 -->

    <div class="col-lg-9">

      <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
          <div class="carousel-item active">
            <img class="d-block img-fluid" src="{{asset('img/productos/portada01.png')}}" alt="First slide">
          </div>
          <div class="carousel-item">
            <img class="d-block img-fluid" src="{{asset('img/productos/portada02.jpg')}}" alt="Second slide">
          </div>
          <div class="carousel-item">
            <img class="d-block img-fluid" src="{{asset('img/productos/portada03.png')}}" alt="Third slide">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>

      <div class="row">

       @foreach ($productos as $pro)
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
              <a href="#">  <img class="card-img-top"  src="{{asset('img/productos/'.$pro->foto)}}" alt="{{$pro->nombre}}" height="160px" width="150px"> </a>
              <div class="card-body">
                <h4 class="card-title">
                  <a href="#">{{$pro->nombre}}</a>
                </h4>
                <h5>${{$pro->precio}}</h5>
                <p class="card-text">{{$pro->descripcion}}</p>
              </div>
              <div class="card-footer">
                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
              </div>
            </div>
          </div>
        @endforeach

      </div>
      <!-- /.row -->

    </div>
    <!-- /.col-lg-9 -->

  </div>
  <!-- /.row -->

</div>

@endsection
