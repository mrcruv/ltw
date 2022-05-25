const username_regex = /^[a-zA-Z0-9_]{1,30}$/;
const cf_regex = /[A-Za-z]{6}[0-9lmnpqrstuvLMNPQRSTUV]{2}[abcdehlmprstABCDEHLMPRST]{1}[0-9lmnpqrstuvLMNPQRSTUV]{2}[A-Za-z]{1}[0-9lmnpqrstuvLMNPQRSTUV]{3}[A-Za-z]{1}/;
const pec_regex = /(?:\w*.?pec(?:.?\w+)*)/;
const piva_regex = /^[0-9]{11}$/;
const website_regex = /^((https?|ftp|smtp):\/\/)(www.)[a-z0-9]+\.[a-z]+(\/[a-zA-Z0-9#]+\/?)*$/;
const expert_name_regex = /^[a-zA-Z0-9]{1,30}$/;
const expert_surname_regex = expert_name_regex;
const expert_city_regex = expert_name_regex;
//const expert_date_regex = /^$/;
const accept_conditions_regex = /^true$/;
const password_regex = /^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/;

jQuery.validator.addMethod("username_regex", function(value, element) {   
    return username_regex.test(value);
    });
jQuery.validator.addMethod("pec_regex", function(value, element) {   
    return pec_regex.test(value);
    });
jQuery.validator.addMethod("cf_regex", function(value, element) {   
    return cf_regex.test(value);
    });
jQuery.validator.addMethod("piva_regex", function(value, element) {   
    return piva_regex.test(value);
    });
jQuery.validator.addMethod("website_regex", function(value, element) {   
    return website_regex.test(value);
    });
jQuery.validator.addMethod("password_regex", function(value, element) {   
    return password_regex.test(value);
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

// jQuery.validator.addMethod("expert_date_regex", function (value, element) {
//     return expert_date_regex.test(value);
// });

jQuery.validator.addMethod("accept_conditions_regex", function (value, element) {
    return accept_conditions_regex.test(value);
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
                username_regex: true
            },
            expert_pec: {
                required: true,
                pec_regex: true
            },
            expert_cf: {
                required: true,
                cf_regex: true
            },
            expert_piva: {
                required: true,
                piva_regex: true
            },
            expert_website: {
                website_regex: true
            },
            expert_password: {
                required: true,
                password_regex: true
            },
            name: {
                required: true,
                expert_name_regex: true
            },
            surname: {
                required: true,
                expert_surname_regex: true
            },
            city: {
                required: true,
                expert_city_regex: true
            },
            date: {
                required: true,
                // expert_date_regex: true,
                adult_date: true
            },
            expert_term: {
                required: true,
                accept_conditions_regex: true
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
            expert_piva: {
                required: "Inserire Partita IVA",
                piva_regex: "Inserire Partita IVA nel formato corretto"
            },
            expert_website: {
                website_regex: "Inserire il sito web nel formato corretto"
            },
            expert_password: {
                required: "Inserire password",
                password_regex: "La password deve essere lunga almeno 8 caratteri. <br> Inserire:<br>- Almeno un carattere alfanumerico minuscolo<br>- Almeno un carattere alfanumerico maiuscolo<br>- Almeno un carattere numerico<br>- Almeno un carattere speciale"
            },
            name: {
                required: "Inserire nome",
                expert_name_regex: "Inserire caratteri alfabetici"
            },
            surname: {
                required: "Inserire cognome",
                expert_surname_regex: "Inserire caratteri alfabetici"
            },
            city: {
                required: "Inserisci la città di nascita",
                expert_city_regex: "Inserisci caratteri alfabetici"
            },
            date: {
                required: "Inserisci la data di nascita corretta",
                // expert_date_regex: "Inserire una data",
                adult_date: "L'esperto deve essere maggiorenne"
            },
            expert_term: {
                required: "<br>Accettare Termini & Condizioni",
                accept_conditions_regex: ""
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
});               
