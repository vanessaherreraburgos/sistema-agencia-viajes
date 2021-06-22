$(document).ready(function(){

    /**
	*
	* Descripción. hace que se solicite proveedor del vehículo si no es propio  al
	* momento de cargar la pagina.
	* @author Johan Alejandro Aguirre Escobar
	*/
	SwitchProveedor($('[name=es_propio]:checked').val(), 'cod_proveedor_vehiculo');

	/**
	*
	* Descripción. evento que hace que se solicite proveedor del véhiculo si no es propio.
	* @author Johan Alejandro Aguirre Escobar
	*/
	$('[name=es_propio]').on('click', function(e){
        SwitchProveedor($(this).val(), 'cod_proveedor_vehiculo');
    }); 

	/**
	*
	* Descripción. función que muestra u oculta el campo para seleccionar 
	* un proveedor de vehículos.
	* @author Johan Alejandro Aguirre Escobar
	*
	* @param {int}       check               valor que indica si se debe mostrar o no el input del proveedor.
	* @param {String}    idInputProveedor    id del input donde se selecciona el proveedor.
	*
	* @return {void}.
	*/
    function SwitchProveedor(check, idInputProveedor){
    	if(check == 0)
            $('#'+idInputProveedor).parents(':eq(1)').removeClass('hidden');
        else
            $('#'+idInputProveedor).parents(':eq(1)').addClass('hidden');
    }

});
