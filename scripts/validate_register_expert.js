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
        $("#register_expert_form").validate({
                rules : {
                    expert_username : {
                        required: true,  
                        username_regex: true
                    },
                    expert_pec : {
                        required : true,
                        pec_regex: true
                    },
                    expert_cf : {
                        required : true,
                        cf_regex: true
                    },
                    expert_piva : {
                        required : true,
                        piva_regex: true
                    },
                    expert_website : {
                        website_regex: true
                    },
                    expert_password : {
                        required: true,
                        password_regex: true
                    },
                    name: {
                        required: true,
                        name_regex: true
                    },
                    surname: {
                        required: true,
                        name_regex: true
                    },
                    city: {
                        required: true,
                        name_regex: true
                    },
                    date:{
                        required: true
                    },
                    expert_term: {
                        required: true
                    }
    
                },
                messages: {
                    expert_username: {
                        required: "Inserire username",  
                        username_regex: "Inserire caratteri alfanumerici"
                    },
                    expert_pec: {
                        required: "Inserire PEC",  
                        cf_regex: "Inserire PEC nel formato corretto"
                    },
                    expert_cf: {
                        required: "Inserire Codice Fiscale",  
                        pec_regex: "Inserire Codice Fiscale nel formato corretto"
                    },
                    expert_piva : {
                        required : "Inserire Partita IVA",
                        piva_regex: "Inserire Partita IVA nel formato corretto"
                    },
                    expert_website : {
                        website_regex: "Inserire il sito web nel formato corretto"
                    },
                    expert_password : {
                        required: "Inserire password",
                        password_regex: "La password deve essere lunga almeno 8 caratteri. <br> Inserire:<br>- Almeno un carattere alfanumerico minuscolo<br>- Almeno un carattere alfanumerico maiuscolo<br>- Almeno un carattere numerico<br>- Almeno un carattere speciale"
                    },
                    name: {
                        required: "Inserire nome",
                        name_regex: "Inserire caratteri alfabetici"
                    },
                    surname: {
                        required: "Inserire cognome",
                        name_regex: "Inserire caratteri alfabetici"
                    },
                    city: {
                        required: "Inserisci la città di nascita",
                        name_regex: "Inserisci caratteri alfabetici"
                    },
                    date:{
                        required: "Inserisci la data di nascita"
                    },
                    expert_term: "<br>Accettare Termini & Condizioni"
                },
                // Settiamo il submit handler per la form
                submitHandler: function(form) {
                    form.submit();
                }
            });
});               
