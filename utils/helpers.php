<?php

function serverRedirect($destination) {
    header("Location: $destination");
    exit;
}

function formatToPeso($amount) {
    return '₱' . number_format($amount, 2);
}

function startRow() {
  echo "<tr>";
}

function rowData($rowData) {
  echo "<td>" . escapeOutput($rowData) . "</td>";
}

function rowButton($color = "", $textContent) {
  echo "<td>" . '<button type="button" class="btn ' . $color . '">' . $textContent . '</button>' . "</td>";
}

function rowLink($color = "", $textContent, $link) {
  echo "<td>" . '<a href="' . $link . '" class="btn ' . $color . '">' . $textContent . '</a>' . "</td>";
}

function endRow() {
  echo "</tr>";
}

function jsAlert($message) {
  echo '<script>alert("' . $message . '");</script>';
}

function echoSessionToast($sessionKey) {
  echo json_encode(isset($_SESSION[$sessionKey]) ? true : false);
}

function fillIcon($pageTitle, $currentPage) {
  echo $pageTitle == $currentPage ? "-fill" : "";
}

function isPageTitleInList($pageTitle, $titles) {
  return in_array($pageTitle, $titles);
}

function isActivePage($pageTitle, $currentPage) {
  echo $pageTitle == $currentPage ? "active" : "";
}

function isAriaCurrentPage($pageTitle, $currentPage) {
  return $pageTitle == $currentPage ? 'aria-current="page"' : "";
}

function isActiveLink($type) {
  return isset($_GET["type"]) && $_GET["type"] == $type ? "active" : "";
}

function isAriaCurrentPageLink($type) {
  return isset($_GET["type"]) && $_GET["type"] == $type ? 'aria-current="page"' : "";
}

function escapeOutput($output) {
  return htmlspecialchars($output, ENT_QUOTES, 'UTF-8');
}

function getFullname($firstname, $middlename, $lastname, $suffix) {
  $firstname = trim(ucwords($firstname));
  $middlename = empty($middlename) ? " " : " " . trim(ucwords($middlename)) . " ";
  $lastname = trim(ucwords($lastname));
  $suffix = empty($suffix) ? "" : ", " . $suffix;

  $fullname = $firstname . $middlename . $lastname . $suffix;
  
  return $fullname;
}

function displayDateTime($datetime) {
  return date("m/d/Y h:i A", strtotime($datetime));
}

function displayDate($date) {
  return date("m/d/Y", strtotime($date));
}

function showReservationRequestsBadge($pendingRequests) {
  if ($pendingRequests <= 0) {
    echo "";
  } else {
    echo '<span class="badge text-bg-danger">' . $pendingRequests . '</span>';
  }
}

function displayPhaseLocation($location) {
  // Use a regular expression to parse the input
  if (preg_match('/^P(\d+)-C(\d+)L(\d+)$/', $location, $matches)) {
    $phase = $matches[1];
    $column = $matches[2];
    $grave = $matches[3];
    return "Phase $phase, Column $column, Lot $grave";
  } else {
    return "Invalid location format";
  }
}

function encodeUrlParameter($parameterValue) {
  return urlencode(base64_encode($parameterValue));
}

function decodeUrlParameter($parameterValue) {
  return urldecode(base64_decode($parameterValue));
}

function extractPhaseNumber($graveId) {
  // Use a regular expression to find the number after 'P'
  if (preg_match('/P(\d+)-/', $graveId, $matches)) {
      return $matches[1]; // Return the first captured group (the number after 'P')
  }
  return null; // Return null if the pattern doesn't match
}