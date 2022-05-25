const entity_username_regex = /^[a-zA-Z0-9_]{1,30}$/;
const entity_cf_regex = /[A-Za-z]{6}[0-9lmnpqrstuvLMNPQRSTUV]{2}[abcdehlmprstABCDEHLMPRST]{1}[0-9lmnpqrstuvLMNPQRSTUV]{2}[A-Za-z]{1}[0-9lmnpqrstuvLMNPQRSTUV]{3}[A-Za-z]{1}/;
const entity_pec_regex = /(?:\w*.?pec(?:.?\w+)*)/;
const entity_piva_regex = /^[0-9]{11}$/;
const entity_website_regex = /^((https?|ftp|smtp):\/\/)(www.)[a-z0-9]+\.[a-z]+(\/[a-zA-Z0-9#]+\/?)*$/;
const entity_name_regex = /^[a-zA-Z0-9]{1,30}$/;
const entity_type_regex = /^(pubblico|privato)$/;
const entity_accept_conditions_regex = /^true$/;
const entity_password_regex = /^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/;

jQuery.validator.addMethod("username_regex", function (value, element) {
    return entity_username_regex.test(value);
});

jQuery.validator.addMethod("pec_regex", function (value, element) {
    return entity_pec_regex.test(value);
});

jQuery.validator.addMethod("cf_regex", function (value, element) {
    return entity_cf_regex.test(value);
});

jQuery.validator.addMethod("piva_regex", function (value, element) {
    return entity_piva_regex.test(value);
});

jQuery.validator.addMethod("website_regex", function (value, element) {
    return entity_website_regex.test(value);
});

jQuery.validator.addMethod("password_regex", function (value, element) {
    return entity_password_regex.test(value);
});

jQuery.validator.addMethod("entity_name_regex", function (value, element) {
    return entity_name_regex.test(value);
});

jQuery.validator.addMethod("entity_type_regex", function (value, element) {
    return entity_type_regex.test(value);
});

jQuery.validator.addMethod("accept_conditions_regex", function (value, element) {
    return entity_accept_conditions_regex.test(value);
});

$().ready(function () {
    $("#register_entity_form").validate({
        ignore: [],
        rules: {
            entity_username: {
                required: true,
                username_regex: true
            },
            entity_pec: {
                required: true,
                pec_regex: true
            },
            entity_cf: {
                required: true,
                cf_regex: true
            },
            entity_piva: {
                required: true,
                piva_regex: true
            },
            entity_website: {
                website_regex: true
            },
            entity_password: {
                required: true,
                password_regex: true
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
                accept_conditions_regex: true
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
            entity_piva: {
                required: "Inserire Partita IVA",
                piva_regex: "Inserire Partita IVA nel formato corretto"
            },
            entity_website: {
                website_regex: "Inserire il sito web nel formato corretto"
            },
            entity_password: {
                required: "Inserire password",
                password_regex: "La password deve essere lunga almeno 8 caratteri.<br>" +
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
                accept_conditions_regex: ""
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
});

