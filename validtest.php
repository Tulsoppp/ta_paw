<?php

function val_required(&$errors, $field_name, $value, $message) {
    if (empty(trim($value))) {
        $errors[$field_name] = $message;
    }
}

function val_numeric(&$errors, $field_name, $value, $message) {
    if (!empty(trim($value)) && !is_numeric($value)) {
        $errors[$field_name] = $message;
    }
}

function val_alpha(&$errors, $field_name, $value, $message) {
    if (!empty(trim($value)) && !preg_match("/^[a-zA-Z ]*$/", $value)) {
        $errors[$field_name] = $message;
    }
}

function val_alphanumeric(&$errors, $field_name, $value, $message) {
    if (!empty(trim($value)) && !preg_match("/^[a-zA-Z0-9]+$/",$value)) {
        $errors[$field_name] = $message;
    }
}

function val_password_format(&$errors, $field_name, $value, $min_length, $message) {
    if (!empty(trim($value)) && strlen($value) < $min_length) {
        $errors[$field_name] = $message;
    }
}

function val_exact_length(&$errors, $field_name, $value, $length, $message) {
    if (!empty(trim($value)) && strlen($value) != $length) {
        $errors[$field_name] = $message;
    }
}

function val_date_format(&$errors, $field_name, $value, $format, $message) {
    if (!empty(trim($value))) {
        $date = DateTime::createFromFormat($format, $value);
        if (!$date || $date->format($format) !== $value) {
            $errors[$field_name] = $message;
        }
    }
}


function val_matches(&$errors, $field_name, $value1, $value2, $message) {
    if ($value1 !== $value2) {
        $errors[$field_name] = $message;
    }
}

?>