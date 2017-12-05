@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Productos <a href="{{url('/admin/producto/create')}}"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('admin.producto.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Foto</th>
					<th>Codigo</th>
					<th>Nombre</th>
					<th>Descripción</th>
					<th>Categoria</th>
					<th>Precio($)</th>
					<th>Estado</th>
					<th>Opciones</th>
				</thead>
               @foreach ($productos as $pro)
				<tr>
					<td>{{ $pro->idproducto}}</td>
					<td>
					    <img src="{{asset('img/productos/'.$pro->foto)}}" alt="{{$pro->nombre}}" height="80px" width="80px" class="img-thumbnail">
					</td>
					<td>{{ $pro->codigo}}</td>
					<td>{{ $pro->nombre}}</td>
					<td>{{ $pro->descripcion}}</td>
					<td>{{ $pro->categoria}}</td>
					<td>{{ $pro->precio}}</td>
					@if($pro->estado=='1')
                       <td><p style="color:#239B56";>Activo</p></td>
                      @else
                         @if($pro->estado=='0')
                           <td><p style="color:red;">Inactivo</p></td>
                         @endif   
                    @endif
					<td>
						<a href="{{URL::action('ProductoController@edit',$pro->idproducto)}}"><button class="btn-xs btn-info">Editar</button></a>
                        <a href="" data-target="#modal-delete-{{$pro->idproducto}}" data-toggle="modal"><button class="btn-xs btn-danger">Eliminar</button></a>
                        <a href="{{URL::action('ProductoController@estado',$pro->idproducto)}}"><button class="btn-xs btn-success">Estado</button></a>
					</td>
				</tr>
				@include('admin.producto.modal')
				@endforeach
			</table>
		</div>
		{{$productos->render()}}
	</div>
</div>

@endsection