<?php

function isSubmitAndPost($inputSubmitName) {
    return isset($_POST[$inputSubmitName]) && $_SERVER['REQUEST_METHOD'] === 'POST';
}

function validatePhase($phase) {
    return in_array($phase, ["Phase 1", "Phase 2", "Phase 3", "Phase 4"]);
}

function validateLotType($lotType) {
    return in_array($lotType, ['Supreme', 'Special', 'Standard']);
}

function validatePrice($price) {
    return is_numeric($price) && $price > 0;
}

function validateEstate($estate) {
    return in_array($estate, ["Estate A", "Estate B", "Estate C"]);
}

function validateLotId($lotId) {
    return preg_match('/^P\d+-C\d+L\d+$/', $lotId);
}

function isGet($parameter, $value) {
  return isset($_GET[$parameter]) && $_GET[$parameter] == $value;
}
  