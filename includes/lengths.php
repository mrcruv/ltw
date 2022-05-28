<?php
$username_maxlength = 40;
$cf_maxlength = 16;
$pec_maxlength = 255;
$piva_maxlength = 11;
$website_maxlength = 255;

$entity_name_maxlength = 50;

$expert_name_maxlength = 255;
$expert_surname_maxlength = $expert_name_maxlength;
$expert_city_maxlength = $expert_name_maxlength;

$password_maxlength = 24; // bcrypt supports max 72 Byte, in MySQL 1 char takes up from 1 Byte to 3 Byte
$password_minlength = 8;

$title_name_maxlength = 255;
$title_notes_maxlength = 255;
$title_grade_maxlength = 3;

$process_name_maxlength = 255;
$process_type_maxlength = 255;
$process_description_maxlength = 255;

$competence_name_maxlength = 255;
$competence_area_maxlength = 255;
$competence_description_maxlength = 255;
