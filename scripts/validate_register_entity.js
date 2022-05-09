jQuery.validator.addMethod("username_regex", function(value, element) {
        return /^[a-zA-Z0-9]{1,30}$/.test(value);   
        });

jQuery.validator.addMethod("pec_regex", function(value, element) {   
        return /(?:\w*.?pec(?:.?\w+)*)/.test(value);   
        });
    
jQuery.validator.addMethod("cf_regex", function(value, element) {   
        return /[A-Za-z]{6}[0-9lmnpqrstuvLMNPQRSTUV]{2}[abcdehlmprstABCDEHLMPRST]{1}[0-9lmnpqrstuvLMNPQRSTUV]{2}[A-Za-z]{1}[0-9lmnpqrstuvLMNPQRSTUV]{3}[A-Za-z]{1}/.test(value);   
        });

jQuery.validator.addMethod("password_regex", function(value, element) {   
        return /^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/.test(value);
        });

jQuery.validator.addMethod("piva_regex", function(value, element) {   
        return /^[0-9]{11}$/.test(value);   
        });

jQuery.validator.addMethod("website_regex", function(value, element) {   
        return /^((https?|ftp|smtp):\/\/)?(www.)?[a-z0-9]+\.[a-z]+(\/[a-zA-Z0-9#]+\/?)*$/.test(value);   
        });
        
jQuery.validator.addMethod("password_regex", function(value, element) {   
        return /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/.test(value);   
        }); 

jQuery.validator.addMethod("name_regex", function(value, element) {   
        return /^[a-zA-Z]{1,30}$/.test(value);   
        });



$().ready(function() {
        $("#register_entity_form").validate({
            rules : {
                entity_username : {
                    required: true,  
                    username_regex: true
                },
                entity_pec : {
                    required : true,
                    pec_regex: true
                },
                entity_cf : {
                    required : true,
                    cf_regex: true
                },
                entity_piva : {
                    required : true,
                    piva_regex: true
                },
                entity_website : {
                    website_regex: true
                },
                entity_password : {
                    required: true,
                    password_regex: true
                },
                type: {
                    required: true
                },
                entity_name: {
                    required: true,
                    username_regex: true
                },
                entity_term: {
                    required: true
                }
            },
            messages: {
                entity_username: {
                    required: "Inserire username",  
                    username_regex: "Inserire caratteri alfanumerici"
                },
                entity_pec: {
                    required: "Inserire PEC",  
                    pec_regex: "Inserire PEC nel formato corretto"
                },
                entity_cf: {
                    required: "Inserire Codice Fiscale",  
                    cf_regex: "Inserire Codice Fiscale nel formato corretto"
                },
                entity_piva : {
                    required : "Inserire Partita IVA",
                    piva_regex: "Inserire Partita IVA nel formato corretto"
                },
                entity_website : {
                    website_regex: "Inserire il sito web nel formato corretto"
                },
                entity_password : {
                    required: "Inserire password",
                    password_regex: "La password deve essere lunga almeno 8 caratteri.<br>" +
                        "Inserire:<br>" +
                        "- Almeno un carattere alfanumerico minuscolo<br>" +
                        "- Almeno un carattere alfanumerico maiuscolo<br>" +
                        "- Almeno un carattere numerico<br>" +
                        "- Almeno un carattere speciale"
                },
                type: {
                    required: "Inserire il tipo di ente"
                },
                entity_name: {
                    required: "Inserire nome ente",
                    username_regex: "Inserire caratteri alfanumerici"
                },
                entity_term: "<br>Accettare Termini & Condizioni"
            },
            // Settiamo il submit handler per la form
            submitHandler: function(form) {
                form.submit();
            }
        });
});
    
