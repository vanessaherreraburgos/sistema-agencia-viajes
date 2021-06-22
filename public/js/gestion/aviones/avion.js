$(document).ready(function(){

    /**
    *
    * Descripción. hace que se solicite proveedor del avión si no es propio.
    * @author Johan Alejandro Aguirre Escobar
    */
    SwitchProveedor($('[name=es_propio]:checked').val(), 'cod_prov_avion');

    /**
    *
    * Descripción. evento que hace que se solicite proveedor del avión si no es propio.
    * @author Johan Alejandro Aguirre Escobar
    */
    $('[name=es_propio]').on('click', function(e){
        SwitchProveedor($(this).val(), 'cod_prov_avion');
    }); 

    /**
    *
    * Descripción. función que muestra u oculta el campo para seleccionar 
    * un proveedor de aviones.
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