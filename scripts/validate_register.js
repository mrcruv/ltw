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
        return /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])([a-zA-Z0-9]{8})$/.test(value);   
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

              
$().ready(function() {

        $("#register_form").validate({
            rules : {
                username : {
                    required: true,  
                    username_regex: true
                },
                pec : {
                    required : true,
                    pec_regex: true
                },
                cf : {
                    required : true,
                    cf_regex: true
                },
                piva : {
                    required : true,
                    piva_regex: true
                },
                website : {
                    website_regex: true
                },
                password : {
                    required: true,
                    password_regex: true
                }
            },

            messages: {
                username: {
                    required: "Inserire username",  
                    username_regex: "Inserire caratteri alfanumerici"
                },
                pec: {
                    required: "Inserire PEC",  
                    pec_regex: "Inserire PEC nel formato corretto"
                },
                cf: {
                    required: "Inserire Codice Fiscale",  
                    pec_regex: "Inserire Codice Fiscale nel formato corretto"
                },
                piva : {
                    required : "Inserire Partita IVA",
                    piva_regex: "Inserire Partita IVA nel formato corretto"
                },
                website : {
                    website_regex: "Inserire il sito web nel formato corretto"
                },
                password : {
                    required: "Inserire password",
                    password_regex: "La password deve essere lunga almeno 8 caratteri. Inserire:\n- Almeno un carattere alfanumerico minuscolo\n- Almeno un carattere alfanumerico maiuscolo\n- Almeno un carattere numerico\n- Almeno un carattere speciale\n"
                }
            },
            // Settiamo il submit handler per la form
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
