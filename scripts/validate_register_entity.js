const entity_username_regex = /^[a-zA-Z0-9_]{1,30}$/;
const entity_cf_regex = /[A-Za-z]{6}[0-9lmnpqrstuvLMNPQRSTUV]{2}[abcdehlmprstABCDEHLMPRST]{1}[0-9lmnpqrstuvLMNPQRSTUV]{2}[A-Za-z]{1}[0-9lmnpqrstuvLMNPQRSTUV]{3}[A-Za-z]{1}/;
const entity_pec_regex = /(?:\w*.?pec(?:.?\w+)*)/;
const entity_piva_regex = /^[0-9]{11}$/;
const entity_website_regex = /^((https?|ftp|smtp):\/\/)(www.)[a-z0-9]+\.[a-z]+(\/[a-zA-Z0-9#]+\/?)*$/;
const entity_name_regex = /^[a-zA-Z0-9.-_ ]{1,50}$/;
const entity_type_regex = /^(pubblico|privato)$/;
const entity_accept_conditions_regex = /^true$/;
const entity_password_regex = /^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/;
const entity_username_maxlength = 30;
const entity_cf_maxlength = 16;
const entity_pec_maxlength = 255;
const entity_piva_maxlength = 11;
const entity_website_maxlength = 255;
const entity_name_maxlength = 50;
const entity_password_minlength = 8;
const entity_password_maxlength = 24; // bcrypt supports max 72 Byte, in MySQL 1 char takes up from 1 Byte to 3 Byte

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
                maxlength: entity_username_maxlength,
                entity_username_regex: true
            },
            entity_pec: {
                required: true,
                maxlength: entity_pec_maxlength,
                entity_pec_regex: true
            },
            entity_cf: {
                required: true,
                maxlength: entity_cf_maxlength,
                entity_cf_regex: true
            },
            entity_piva: {
                required: true,
                maxlength: entity_piva_maxlength,
                entity_piva_regex: true
            },
            entity_website: {
                maxlength: entity_website_maxlength,
                entity_website_regex: true
            },
            entity_password: {
                required: true,
                minlength: entity_password_minlength,
                maxlength: entity_password_maxlength,
                entity_password_regex: true
            },
            type: {
                required: true,
                entity_type_regex: true
            },
            entity_name: {
                required: true,
                maxlength: entity_username_maxlength,
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
                maxlength: "Superata lunghezza massima consentita" + entity_username_maxlength,
                entity_username_regex: "Inserire caratteri alfanumerici"
            },
            entity_pec: {
                required: "Inserire PEC",
                maxlength: "Superata lunghezza massima consentita" + entity_pec_maxlength,
                entity_pec_regex: "Inserire PEC nel formato corretto"
            },
            entity_cf: {
                required: "Inserire Codice Fiscale",
                maxlength: "Superata lunghezza massima consentita" + entity_cf_maxlength,
                entity_cf_regex: "Inserire Codice Fiscale nel formato corretto"
            },
            entity_piva: {
                required: "Inserire Partita IVA",
                maxlength: "Superata lunghezza massima consentita" + entity_piva_maxlength,
                entity_piva_regex: "Inserire Partita IVA nel formato corretto"
            },
            entity_website: {
                maxlength: "Superata lunghezza massima consentita" + entity_website_maxlength,
                entity_website_regex: "Inserire il sito web nel formato corretto"
            },
            entity_password: {
                required: "Inserire password",
                minlength: "Lunghezza minima non raggiunta: " + entity_password_minlength,
                maxlength: "Superata lunghezza massima consentita" + entity_password_maxlength,
                entity_password_regex: "Inserire almeno:<br>-Carattere alfanumerico minuscolo<br>-Carattere alfanumerico maiuscolo<br>-Carattere numerico<br>-Carattere speciale"
            },
            type: {
                required: "Inserire il tipo di ente",
                entity_type_regex: "Inserire un tipo ente valido"
            },
            entity_name: {
                required: "Inserire nome ente",
                maxlength: "Superata lunghezza massima consentita" + entity_name_maxlength,
                entity_name_regex: "Inserire nome ente nel formato corretto"
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

