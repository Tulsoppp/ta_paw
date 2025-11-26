<?php

// function untuk check tiap inputan agar tidak kosong
function val_required(&$errors, $field_name, $value, $message) {
    if (empty(trim($value))) {
        $errors[$field_name] = $message;
    }
}
//validasi pengecekan inputan user berupa angka
function val_numeric(&$errors, $field_name, $value, $message) {
    if (!empty(trim($value)) && !is_numeric($value)) {
        $errors[$field_name] = $message;
    }
}
//validasi pengecekan inputan user berupa huruf
function val_alpha(&$errors, $field_name, $value, $message) {
    if (!empty(trim($value)) && !preg_match("/^[a-zA-Z ]*$/", $value)) {
        $errors[$field_name] = $message;
    }
}
//validasi pengecekan inputan user berupa huruf dan angka
function val_alphanumeric(&$errors, $field_name, $value, $message) {
    if (!empty(trim($value)) && !preg_match("/^[a-zA-Z0-9 \.\,]+$/",$value)) {
        $errors[$field_name] = $message;
    }
}
//validasi pengecekan format password
function val_password_format(&$errors, $field_name, $value, $min_length, $message) {
    if (!empty(trim($value)) && strlen($value) < $min_length) {
        $errors[$field_name] = $message;
    }
}
//validasi pengecekan panjang inputan user
function val_exact_length(&$errors, $field_name, $value, $length, $message) {
    if (!empty(trim($value)) && strlen($value) != $length) {
        $errors[$field_name] = $message;
    }
}
//validasi pengecekan tanggal innputan user
function val_date_format(&$errors, $field_name, $value, $format, $message) {
    if (!empty(trim($value))) {
        $date = DateTime::createFromFormat($format, $value);
        if (!$date || $date->format($format) !== $value) {
            $errors[$field_name] = $message;
        }
    }
}
//validasi email

function val_email(&$errors, $field_name, $value, $message) {
    $pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
    if (!empty(trim($value)) && !preg_match($pattern, $value)) {
        $errors[$field_name] = $message;
    }
}
//validasi email
function val_file(&$errors, $field_name, $file, $allowed_ext, $max_mb, $message)
{
    if (!isset($file) || $file['error'] !== 0) {
        $errors[$field_name] = "File wajib diupload.";
        return;
    }

    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, $allowed_ext)) {
        $errors[$field_name] = $message;
        return;
    }
    // Batas ukuran dalam byte
    $max_bytes = $max_mb * 1024 * 1024;

    if ($file['size'] > $max_bytes) {
        $errors[$field_name] = "Ukuran file maksimal {$max_mb}MB.";
    }
}




?>