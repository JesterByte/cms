<?php
session_start();

// if (isset($_SESSION["price-updated"])) {
//     unset($_SESSION["price-updated"]);
// }

unsetToast("phase_price_updated");
unsetToast("estate_price_updated");
unsetToast("lot_reservation_updated");

function unsetToast($sessionKey) {
    if (isset($_SESSION[$sessionKey]) && $_SESSION[$sessionKey] === true) {
        unset($_SESSION[$sessionKey]);
    }
}