@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Producto: {{ $producto->nombre}}</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::model($producto,['method'=>'PATCH','route'=>['admin.producto.update',$producto->idproducto]])!!}
            {{Form::token()}}

            <div class="form-group">
            	<label for="codigo">Codigo</label>
            	<input type="text" name="codigo" class="form-control" value="{{$producto->codigo}}" placeholder="codigo...">
            </div>
            <div class="form-group">
            	<label for="nombre">Nombre</label>
            	<input type="text" name="nombre" class="form-control" value="{{$producto->nombreproducto}}" placeholder="Nombre...">
            </div>
            <div class="form-group">
            	<label for="descripcion">Descripción</label>
            	<input type="text" name="descripcion" class="form-control" value="{{$producto->descripcionproducto}}" placeholder="Descripción...">
            </div>
            <div class="form-group">
               <label> Categoria</label>
               <select name="idcategoria" required  class="form-control">
                  <option value="">Seleccionar Categoria...</option>
                  	@foreach ($categorias as $cat)
                  	   @if ($cat->idcategoria==$producto->idcategoria)
                  	   		<option value="{{$cat->idcategoria}}" selected>{{$cat->categoria}}</option>
                  	   @else
                  	   		<option value="{{$cat->idcategoria}}">{{$cat->categoria}}</option>
                  	   @endif
                  	@endforeach
               </select>     
         	</div>
         	<div class="form-group">
            	<label for="precio">Precio</label>
            	<input type="text" name="precio" class="form-control" value="{{$producto->precio}}" placeholder="Precio Producto...">
            </div>
            <div class="form-group">
            	<button class="btn btn-primary" type="submit">Guardar</button>
            	<button class="btn btn-danger" type="reset">Cancelar</button>
            </div>

			{!!Form::close()!!}		
            
		</div>
	</div>
@endsection