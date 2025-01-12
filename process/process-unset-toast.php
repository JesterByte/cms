<?php
session_start();

// if (isset($_SESSION["price-updated"])) {
//     unset($_SESSION["price-updated"]);
// }

unsetToast("price_updated");

function unsetToast($sessionKey) {
    if (isset($_SESSION[$sessionKey]) && $_SESSION[$sessionKey] === true) {
        unset($_SESSION[$sessionKey]);
    }
}