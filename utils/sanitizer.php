<?php

function sanitizeUsername($username) {
    // Remove any unwanted characters, allowing only alphanumeric, underscores, and hyphens
    return preg_replace('/[^a-zA-Z0-9_\-]/', '', trim($username));
}

function sanitizePassword($password) {
    // Trim whitespace from the beginning and end of the password
    return trim($password);
}

function sanitizeInput($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}