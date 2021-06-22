$(document).ready(function(){

    if($.validator) {

    	/**
		*
		* Descripción. el campo con esta validación puede tener caracteres alfabeticos, 
		* números, signos de putuación, guiones, guiones bajos o espacios en blanco.
		* @author Johan Alejandro Aguirre Escobar
		*/
		$.validator.addMethod("texto", function(value, element) {
		    if (/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ0-9\.,;:¡!¿?#_\-\s]*$/.test(value)) {
		            return true; // pass when validation is correct
		    } else {
		            return false; // fail when validation fails
		    };
		}, "El contenido ingresado en este campo es inválido."
		);

	    /**
		*
		* Descripción. el campo con esta validación puede tener caracteres alfabeticos, 
		* números, guiones, guiones bajos o espacios en blanco.
		* @author Johan Alejandro Aguirre Escobar
		*/
		$.validator.addMethod("alphanum", function(value, element) {
		    if (/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ0-9_\-\s]*$/.test(value)) {
		            return true; // pass when validation is correct
		    } else {
		            return false; // fail when validation fails
		    };
		}, "El contenido ingresado en este campo es inválido."
		);

	    /**
		*
		* Descripción. el campo con esta validación puede tener caracteres alfabeticos, 
		* guiones, guiones bajos o espacios en blanco.
		* @author Johan Alejandro Aguirre Escobar
		*/
		$.validator.addMethod("alpha", function(value, element) {
		    if (/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ_\-\s]*$/.test(value)) {
		            return true; // pass when validation is correct
		    } else {
		            return false; // fail when validation fails
		    };
		}, "El contenido ingresado en este campo es inválido."
		);

       	/**
		*
		* Descripción. el campo con esta validación debe ser una fecha en formato dd/mm/yyyy.
		* @author Johan Alejandro Aguirre Escobar
		*/
    	$.validator.addMethod("date_dmy", function( value, element ) {
            // return this.optional(element) || /^\d{1,2}[\/-]\d{1,2}[\/-]\d{4}$/.test(value);

            if (/^\d{1,2}[\/-]\d{1,2}[\/-]\d{4}$/.test(value)) {
		            return true; // pass when validation is correct
		    } else {
		            return false; // fail when validation fails
		    };
        },'La fecha ingresada no corresponde al formato dd/mm/yyyy.');

	}

});