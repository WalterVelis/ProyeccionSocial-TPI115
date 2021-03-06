@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Categorías <a href="{{url('/admin/categoria/create')}}"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('admin.categoria.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Nombre</th>
					<th>Descripción</th>
					<th>Estado</th>
					<th>Opciones</th>
				</thead>
               @foreach ($categorias as $cat)
				<tr>
					<td>{{ $cat->idcategoria}}</td>
					<td>{{ $cat->nombrecategoria}}</td>
					<td>{{ $cat->descripcioncategoria}}</td>
					@if($cat->condicion=='1')
                       <td><p style="color:#239B56";>Activo</p></td>
                      @else
                         @if($cat->condicion=='0')
                           <td><p style="color:red;">Inactivo</p></td>
                         @endif   
                    @endif
					<td>
						<a href="{{URL::action('CategoriaController@edit',$cat->idcategoria)}}"><button class="btn-xs btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$cat->idcategoria}}" data-toggle="modal"><button class="btn-xs btn-danger">Eliminar</button></a>
                         <a href="{{URL::action('CategoriaController@estado',$cat->idcategoria)}}"><button class="btn-xs btn-success">Estado</button></a>
					</td>
				</tr>
				@include('admin.categoria.modal')
				@endforeach
			</table>
		</div>
		{{$categorias->render()}}
	</div>
</div>

@endsection