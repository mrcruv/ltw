const expert_username_regex = /^[a-zA-Z0-9_]{1,30}$/;
const expert_cf_regex = /[A-Za-z]{6}[0-9lmnpqrstuvLMNPQRSTUV]{2}[abcdehlmprstABCDEHLMPRST]{1}[0-9lmnpqrstuvLMNPQRSTUV]{2}[A-Za-z]{1}[0-9lmnpqrstuvLMNPQRSTUV]{3}[A-Za-z]{1}/;
const expert_pec_regex = /(?:\w*.?pec(?:.?\w+)*)/;
const expert_piva_regex = /^[0-9]{11}$/;
const expert_website_regex = /^((https?|ftp|smtp):\/\/)(www.)[a-z0-9]+\.[a-z]+(\/[a-zA-Z0-9#]+\/?)*$/;
const expert_name_regex = /^[a-zA-Z ]{1,255}$/;
const expert_surname_regex = expert_name_regex;
const expert_city_regex = expert_name_regex;
const expert_accept_conditions_regex = /^true$/;
const expert_password_regex = /^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/;
const expert_username_maxlength = 30;
const expert_cf_maxlength = 16;
const expert_pec_maxlength = 255;
const expert_piva_maxlength = 11;
const expert_website_maxlength = 255;
const expert_name_maxlength = 255;
const expert_surname_maxlength = 255;
const expert_city_maxlength = 255;
const expert_password_minlength = 8;
const expert_password_maxlength = 24; // bcrypt supports max 72 Byte, in MySQL 1 char takes up to 3 Byte

jQuery.validator.addMethod("expert_username_regex", function(value, element) {
    return expert_username_regex.test(value);
    });
jQuery.validator.addMethod("expert_pec_regex", function(value, element) {
    return expert_pec_regex.test(value);   
    });
jQuery.validator.addMethod("expert_cf_regex", function(value, element) {
    return expert_cf_regex.test(value);   
    });
jQuery.validator.addMethod("expert_piva_regex", function(value, element) {
    return expert_piva_regex.test(value);   
    });
jQuery.validator.addMethod("expert_website_regex", function(value, element) {
    return expert_website_regex.test(value);   
    });
jQuery.validator.addMethod("expert_password_regex", function(value, element) {
    return expert_password_regex.test(value);
    });
jQuery.validator.addMethod("expert_name_regex", function(value, element) {
    return expert_name_regex.test(value);   
    });
jQuery.validator.addMethod("expert_surname_regex", function(value, element) {
    return expert_surname_regex.test(value);
    });
jQuery.validator.addMethod("expert_city_regex", function(value, element) {
    return expert_city_regex.test(value);
    });

jQuery.validator.addMethod("expert_accept_conditions_regex", function (value, element) {
    return expert_accept_conditions_regex.test(value);
});

jQuery.validator.addMethod("adult_date", function (value, element) {
    var currentDate = new Date();
    var currentYear = currentDate.getFullYear();
    var currentMonth = currentDate.getMonth();
    var currentDay = currentDate.getDate();
    var birthDate = new Date(value);
    var birthYear = birthDate.getFullYear();
    var birthMonth = birthDate.getMonth();
    var birthDay = birthDate.getDate();
    var calculatedAge = currentYear - birthYear;
    if (currentMonth < birthMonth) {
        calculatedAge--;
    }
    if (birthMonth == currentMonth && currentDay < birthDay) {
        calculatedAge--;
    }
    if (calculatedAge >= 18) return true;
    else return false;
});


$().ready(function () {
    $("#register_expert_form").validate({
        ignore: [],
        rules: {
            expert_username: {
                required: true,
                maxlength: expert_username_maxlength,
                expert_username_regex: true
            },
            expert_pec: {
                required: true,
                maxlength: expert_pec_maxlength,
                expert_pec_regex: true
            },
            expert_cf: {
                required: true,
                maxlength: expert_cf_maxlength,
                expert_cf_regex: true
            },
            expert_piva: {
                required: true,
                maxlength: expert_piva_maxlength,
                expert_piva_regex: true
            },
            expert_website: {
                maxlength: expert_website_maxlength,
                expert_website_regex: true
            },
            expert_password: {
                required: true,
                minlength: expert_password_minlength,
                maxlength: expert_password_maxlength,
                expert_password_regex: true
            },
            name: {
                required: true,
                maxlength: expert_name_maxlength,
                expert_name_regex: true
            },
            surname: {
                required: true,
                maxlength: expert_surname_maxlength,
                expert_surname_regex: true
            },
            city: {
                required: true,
                maxlength: expert_city_maxlength,
                expert_city_regex: true
            },
            date: {
                required: true,
                adult_date: true
            },
            expert_term: {
                required: true,
                expert_accept_conditions_regex: true
            }
        },
        messages: {
            expert_username: {
                required: "Inserire username",
                maxlength: "Superata lunghezza massima consentita" + expert_username_maxlength,
                expert_username_regex: "Inserire username nel formato corretto"
            },
            expert_pec: {
                required: "Inserire PEC",
                maxlength: "Superata lunghezza massima consentita: " + expert_pec_maxlength,
                expert_pec_regex: "Inserire PEC nel formato corretto"
            },
            expert_cf: {
                required: "Inserire Codice Fiscale",
                maxlength: "Superata lunghezza massima consentita: " + expert_cf_maxlength,
                expert_cf_regex: "Inserire Codice Fiscale nel formato corretto"
            },
            expert_piva: {
                required: "Inserire Partita IVA",
                maxlength: "Superata lunghezza massima consentita: " + expert_piva_maxlength,
                expert_piva_regex: "Inserire Partita IVA nel formato corretto"
            },
            expert_website: {
                maxlength: "Superata lunghezza massima consentita: " + expert_website_maxlength,
                expert_website_regex: "Inserire il sito web nel formato corretto"
            },
            expert_password: {
                required: "Inserire password",
                minlength: "Lunghezza minima non raggiunta: " + expert_password_minlength,
                maxlength: "Superata lunghezza massima consentita: " + expert_password_maxlength,
                expert_password_regex: "La password deve essere lunga almeno 8 caratteri. <br> Inserire:<br>- Almeno un carattere alfanumerico minuscolo<br>- Almeno un carattere alfanumerico maiuscolo<br>- Almeno un carattere numerico<br>- Almeno un carattere speciale"
            },
            name: {
                required: "Inserire nome",
                maxlength: "Superata lunghezza massima consentita: " + expert_name_maxlength,
                expert_name_regex: "Inserire nome nel formato corretto"
            },
            surname: {
                required: "Inserire cognome",
                maxlength: "Superata lunghezza massima consentita: " + expert_surname_maxlength,
                expert_surname_regex: "Inserire cognome nel formato corretto"
            },
            city: {
                required: "Inserire città di nascita",
                maxlength: "Superata lunghezza massima consentita: " + expert_city_maxlength,
                expert_city_regex: "Inserisci citt&agrave; nel formato corretto"
            },
            date: {
                required: "Inserire data di nascita",
                adult_date: "L'esperto deve essere maggiorenne"
            },
            expert_term: {
                required: "<br>Accettare termini & condizioni",
                expert_accept_conditions_regex: "<br>Valore di accettazione non valido"
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
});               
