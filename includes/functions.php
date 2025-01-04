<?php
// require "../vendor/autoload.php";
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;
include_once "session.php";

function formatToPeso($amount) {
    return "₱" . number_format($amount, 2);
}

function checkSession() {
    if (!isset($_SESSION["user_id"])) {
        redirect("../index.php");
    }
}

function redirect($destination) {
    header("Location: $destination");
    exit;
}

function encodeParameter($parameter) {
    $encodedParameter = urlencode(base64_encode($parameter));

    return $encodedParameter;
}

function decodeParameter($parameter) {
    $decodedParameter = urldecode(base64_decode($parameter));

    return $decodedParameter;
}

function generateTitle($pageTitle) {
    $siteName = "Green Haven Memorial Park";
    
    return "$pageTitle - $siteName"; 
}

function dangerAlert($message) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="bi bi-exclamation-triangle-fill"></i> ' . $message . '
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}

function successAlert($message) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle-fill"></i> ' . $message . '
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}

function generateOtp() {
    return random_int(100000, 999999);
}

// function sendEmailOtp($emailAddress, $firstName, $otp) {
//     $mail = new PHPMailer(true);
//     try {
//         $mail->isSMTP();
//         $mail->Host = "smtp.gmail.com";
//         $mail->SMTPAuth = true;
//         $mail->Username = "ejjose94@gmail.com";
//         $mail->Password = "dzftvwdftttloqat";
//         $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
//         $mail->Port = 587;

//         $mail->setFrom("ejjose94@gmail.com", "Green Haven Memorial Park");
//         $mail->addAddress($emailAddress);

//         $mail->isHTML(true);
//         $mail->Subject = "Your OTP Verification Code";

//         $otpHtml = file_get_contents("../view/otp-email-template.php");
//         $otpHtml = str_replace("[User Name]", $firstName, $otpHtml);
//         $otpHtml = str_replace("[OTP_CODE]", $otp, $otpHtml);

//         $mail->Body = $otpHtml;
        
//         if ($mail->send()) {
//             return true;
//         } else {
//             return false;
//         }
//     } catch (Exception $e) {
//         echo "PHPMailer Error: " . $mail->ErrorInfo;
//     }
// }

function formatDate($date) {
    $date = date("F j, Y", strtotime($date));

    return $date;
}

function formatDateTime($dateTime) {
    $dateTime = date("F j, Y h:i A", strtotime($dateTime));

    return $dateTime;
}

function jsAlert($message) {
    echo '
        <script>
            alert("' . $message . '");
        </script>
    ';
}

function generateGraveReference($sectionType, $phase = null, $lotType = null, $estate = null) {
    if ($sectionType === "Phase") {
        // If uniqueId is not provided, generate a random 3-digit number
        $uniqueId = $uniqueId ?? rand(100, 999);
        // Phase section format: PHASE-{Phase Number}-{Lot Type}-{Unique ID}
        return "PHASE-{$phase}-{$lotType}-" . str_pad($uniqueId, 3, "0", STR_PAD_LEFT);
    } elseif ($sectionType === "Estate") {
        // If uniqueId is not provided, generate a random 3-digit number
        $uniqueId = $uniqueId ?? rand(100, 999);
        // Estate section format: ESTATE-{Estate Letter}-{Area Size}-{Unique ID}
        return "ESTATE-{$estate}-" . str_pad($uniqueId, 3, "0", STR_PAD_LEFT);
    }
    return null;
}

function sanitizeUsername($username) {
    // Trim whitespace from the beginning and end
    $username = trim($username);

    // Remove any characters that are not alphanumeric, underscore, or hyphen
    $username = preg_replace('/[^a-zA-Z0-9_-]/', '', $username);

    // Optionally, convert to lowercase
    $username = strtolower($username);

    return $username;
}

function validateUsername($username) {
    // Check if the username length is between 3 and 50 characters
    if (strlen($username) < 3 || strlen($username) > 50) {
        return false;
    }

    // Check if the username contains only valid characters
    if (!preg_match('/^[a-zA-Z0-9_-]+$/', $username)) {
        return false;
    }

    // If validation passes, return true
    return true;
}

function escapeOutput($output) {
    return strip_tags(htmlspecialchars($output, ENT_QUOTES, 'UTF-8'));
}

function sanitizePassword($password) {
    // Trim leading/trailing whitespace
    $password = trim($password);

    // Validate password length (e.g., at least 8 characters)
    if (strlen($password) < 8) {
        return "Password must be at least 8 characters long.";
    }

    // Ensure the password contains at least one number, one letter, and one special character
    if (!preg_match('/[A-Za-z]/', $password) || !preg_match('/\d/', $password) || !preg_match('/[\W_]/', $password)) {
        return "Password must contain at least one letter, one number, and one special character.";
    }

    return $password;  // Return the sanitized password
}

function createFullName($firstName, $middleName, $lastName, $suffix) {
    if (empty($middleName) && empty($suffix)) {
        $fullName = "$firstName $lastName";
    } else if (!empty($middleName) && empty($suffix)) {
        $fullName = "$firstName $middleName $lastName";
    } else if (empty($middleName) && !empty($suffix)) {
        $fullName = "$firstName $lastName, $suffix";
    } else {
        $fullName = "$firstName $middleName $lastName $suffix";
    }

    return $fullName;
}
