<?php
$entity_username_regex = '/^[a-zA-Z0-9_]{1,30}$/';
$entity_cf_regex = '/[A-Za-z]{6}[0-9lmnpqrstuvLMNPQRSTUV]{2}[abcdehlmprstABCDEHLMPRST]{1}[0-9lmnpqrstuvLMNPQRSTUV]{2}[A-Za-z]{1}[0-9lmnpqrstuvLMNPQRSTUV]{3}[A-Za-z]{1}/';
$entity_pec_regex = '/(?:\w*.?pec(?:.?\w+)*)/';
$entity_piva_regex = '/^[0-9]{11}$/';
$entity_website_regex = '/^((https?|ftp|smtp):\/\/)(www.)[a-z0-9]+\.[a-z]+(\/[a-zA-Z0-9#]+\/?)*$/';
$entity_name_regex = '/^[a-zA-Z0-9]{1,30}$/';
$entity_type_regex = '/^(pubblico|privato)$/';

$expert_username_regex = $entity_username_regex;
$expert_cf_regex = $entity_cf_regex;
$expert_pec_regex = $entity_pec_regex;
$expert_piva_regex = $entity_piva_regex;
$expert_website_regex = $entity_website_regex;
$expert_name_regex = '/^[a-zA-Z0-9]{1,30}$/';
$expert_surname_regex = $expert_name_regex;
$expert_city_regex = $expert_name_regex;
//$expert_date_regex = '';

$accept_conditions_regex = '/^true$/';

$contains_lowercase = '/[a-z]/';
$contains_uppercase = '/[A-Z]/';
$contains_special = '/[!@#$%^&*-]/';
$contains_digit = '/[0-9]/';

$title_name_regex = '/^[a-zA-Z ]{1,255}$/';
$title_notes_regex = '/^[a-zA-Z0-9 .,;]{1,255}$/';
$title_grade_regex = '/^[0-9]{1,3}$/';
//$title_date_regex = '';

$process_name_regex = '/^[a-zA-Z0-9]{1,255}$/';
$process_type_regex = '/^[a-zA-Z0-9 ]{1,255}$/';
$process_description_regex = '/^[a-zA-Z0-9 .,;]{1,255}$/';

$competence_name_regex = '/^[a-zA-Z0-9]{1,255}$/';
$competence_area_regex = '/^[a-zA-Z0-9 ]{1,255}$/';
$competence_description_regex = '/^[a-zA-Z0-9 .,;]{1,255}$/';
