<?php
$username_regex = '/^[a-zA-Z0-9_]{1,30}$/';
$cf_regex = '/[A-Za-z]{6}[0-9lmnpqrstuvLMNPQRSTUV]{2}[abcdehlmprstABCDEHLMPRST][0-9lmnpqrstuvLMNPQRSTUV]{2}[A-Za-z][0-9lmnpqrstuvLMNPQRSTUV]{3}[A-Za-z]/';
$pec_regex = '/[a-zA-Z0-9.+_-]+@[pec]+\.[a-z]{2,3}/';
$piva_regex = '/^[0-9]{11}$/';
$website_regex = '/^((https?|ftp|smtp):\/\/)(www.)[a-z0-9]+\.[a-z]+(\/[a-zA-Z0-9#]+\/?)*$/';
$password_regex = '/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,24}$/';

$entity_name_regex = '/^[a-zA-Z0-9.\-_ ]{1,50}$/';
$entity_type_regex = '/^(pubblico|privato)$/';

$expert_name_regex = '/^[a-zA-Z ]{1,255}$/';
$expert_surname_regex = $expert_name_regex;
$expert_city_regex = $expert_name_regex;

$accept_conditions_regex = '/^true$/';

$contains_lowercase = '/[a-z]/';
$contains_uppercase = '/[A-Z]/';
$contains_special = '/[!@#$%^&*-]/';
$contains_digit = '/[0-9]/';

$title_name_regex = '/^[a-zA-Z ]{1,255}$/';
$title_notes_regex = '/^[a-zA-Z0-9 .,;]{1,255}$/';
$title_grade_regex = '/^[0-9]{1,3}$/';

$process_name_regex = '/^[a-zA-Z0-9 ]{1,255}$/';
$process_type_regex = '/^[a-zA-Z ]{1,255}$/';
$process_description_regex = '/^[a-zA-Z0-9 .,;]{1,255}$/';

$competence_name_regex = '/^[a-zA-Z0-9]{1,255}$/';
$competence_area_regex = '/^[a-zA-Z0-9 ]{1,255}$/';
$competence_description_regex = '/^[a-zA-Z0-9 .,;]{1,255}$/';
