@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
			<h3>Registrarse</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::open(array('url'=>'admin/cliente','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}

            <div class="row">
               <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                     <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" required value="{{old('nombre')}}" class="form-control" placeholder="Nombre...">
                     </div>

                     <div class="form-group">
                        <label for="apellido">Apellido</label>
                        <input type="text" name="apellido" required value="{{old('apellidoa')}}" class="form-control" placeholder="Apellido...">
                     </div>
            
               </div>

               <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                     <div class="form-group">
                        <label for="telefono">Telefono</label>
                        <input type="text" name="telefono" required value="{{old('telefono')}}" class="form-control" placeholder="Telefono...">
                     </div>

                   
                     <div class="form-group">
                        <label for="direccion">Direccion</label>
                        <input type="text" name="direccion" required value="{{old('direccion')}}" class="form-control" placeholder="Direccion...">
                     </div>

                     <div class="form-group">
                        <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-floppy-disk"></i> Guardar</button>
                        <a href="{{url('admin/cliente')}}" class="btn btn-danger" role="button"><i class="glyphicon glyphicon-remove-circle"></i> Cancelar</a>
                     </div>
               </div>

            </div> 
            
			{!!Form::close()!!}		
            
		</div>
	</div>
@endsection