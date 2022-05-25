const entity_username_regex = /^[a-zA-Z0-9_]{1,30}$/;
const entity_cf_regex = /[A-Za-z]{6}[0-9lmnpqrstuvLMNPQRSTUV]{2}[abcdehlmprstABCDEHLMPRST]{1}[0-9lmnpqrstuvLMNPQRSTUV]{2}[A-Za-z]{1}[0-9lmnpqrstuvLMNPQRSTUV]{3}[A-Za-z]{1}/;
const entity_pec_regex = /(?:\w*.?pec(?:.?\w+)*)/;
const entity_piva_regex = /^[0-9]{11}$/;
const entity_website_regex = /^((https?|ftp|smtp):\/\/)(www.)[a-z0-9]+\.[a-z]+(\/[a-zA-Z0-9#]+\/?)*$/;
const entity_name_regex = /^[a-zA-Z0-9]{1,30}$/;
const entity_type_regex = /^(pubblico|privato)$/;
const entity_accept_conditions_regex = /^true$/;
const entity_password_regex = /^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/;

jQuery.validator.addMethod("entity_username_regex", function (value, element) {
    return entity_username_regex.test(value);
});

jQuery.validator.addMethod("entity_pec_regex", function (value, element) {
    return entity_pec_regex.test(value);
});

jQuery.validator.addMethod("entity_cf_regex", function (value, element) {
    return entity_cf_regex.test(value);
});

jQuery.validator.addMethod("entity_piva_regex", function (value, element) {
    return entity_piva_regex.test(value);
});

jQuery.validator.addMethod("entity_website_regex", function (value, element) {
    return entity_website_regex.test(value);
});

jQuery.validator.addMethod("entity_password_regex", function (value, element) {
    return entity_password_regex.test(value);
});

jQuery.validator.addMethod("entity_name_regex", function (value, element) {
    return entity_name_regex.test(value);
});

jQuery.validator.addMethod("entity_type_regex", function (value, element) {
    return entity_type_regex.test(value);
});

jQuery.validator.addMethod("entity_accept_conditions_regex", function (value, element) {
    return entity_accept_conditions_regex.test(value);
});

$().ready(function () {
    $("#register_entity_form").validate({
        ignore: [],
        rules: {
            entity_username: {
                required: true,
                entity_username_regex: true
            },
            entity_pec: {
                required: true,
                entity_pec_regex: true
            },
            entity_cf: {
                required: true,
                entity_cf_regex: true
            },
            entity_piva: {
                required: true,
                entity_piva_regex: true
            },
            entity_website: {
                entity_website_regex: true
            },
            entity_password: {
                required: true,
                entity_password_regex: true
            },
            type: {
                required: true,
                entity_type_regex: true
            },
            entity_name: {
                required: true,
                entity_name_regex: true
            },
            entity_term: {
                required: true,
                entity_accept_conditions_regex: true
            }
        },
        messages: {
            entity_username: {
                required: "Inserire username",
                entity_username_regex: "Inserire caratteri alfanumerici"
            },
            entity_pec: {
                required: "Inserire PEC",
                entity_pec_regex: "Inserire PEC nel formato corretto"
            },
            entity_cf: {
                required: "Inserire Codice Fiscale",
                entity_cf_regex: "Inserire Codice Fiscale nel formato corretto"
            },
            entity_piva: {
                required: "Inserire Partita IVA",
                entity_piva_regex: "Inserire Partita IVA nel formato corretto"
            },
            entity_website: {
                entity_website_regex: "Inserire il sito web nel formato corretto"
            },
            entity_password: {
                required: "Inserire password",
                entity_password_regex: "La password deve essere lunga almeno 8 caratteri.<br>" +
                    "Inserire:<br>" +
                    "- Almeno un carattere alfanumerico minuscolo<br>" +
                    "- Almeno un carattere alfanumerico maiuscolo<br>" +
                    "- Almeno un carattere numerico<br>" +
                    "- Almeno un carattere speciale"
            },
            type: {
                required: "Inserire il tipo di ente",
                entity_type_regex: "Inserire un tipo ente valido"
            },
            entity_name: {
                required: "Inserire nome ente",
                entity_name_regex: "Inserire caratteri alfanumerici"
            },
            entity_term: {
                required: "<br>Accettare Termini & Condizioni",
                entity_accept_conditions_regex: ""
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
});

