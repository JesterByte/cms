<?php require_once "../content/reservation-requests-badge.php"; ?>

<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
  <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="sidebarMenuLabel">Green Haven Memorial Park</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center gap-2 <?= isActivePage($pageTitle, "Dashboard") ?>" href="../dashboard/" <?= isAriaCurrentPage($pageTitle, "Dashboard") ?>>
            <i class="bi bi-house<?= fillIcon($pageTitle, "Dashboard") ?>"></i> Dashboard
          </a>
        </li>
        <?php $lotPricingList = ["Phase Pricing", "Estate Pricing"]; ?>
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center gap-2" data-bs-toggle="collapse" href="#lotPricingSubmenu" role="button" aria-expanded="<?= isPageTitleInList($pageTitle, $lotPricingList) ? "true" : "false"; ?>" aria-controls="lotPricingSubmenu">
            <i class="bi bi-tag<?= isPageTitleInList($pageTitle, $lotPricingList) ? "-fill" : ""; ?>"></i> Set Pricing <i class="bi bi-caret-down<?= isPageTitleInList($pageTitle, $lotPricingList) ? "-fill" : ""; ?>"></i>
          </a>
          <div class="collapse <?= isPageTitleInList($pageTitle, $lotPricingList) ? "show" : ""; ?>" id="lotPricingSubmenu">
            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
              <li><a href="../phase" class="nav-link d-flex align-items-center gap-2 <?= isActivePage($pageTitle, "Phase Pricing") ?>" <?= isAriaCurrentPage($pageTitle, "Phase Pricing") ?>><i class="bi bi-caret-right<?= fillIcon($pageTitle, "Phase Pricing") ?>"></i> Phase Pricing</a></li>
              <li><a href="../estate" class="nav-link d-flex align-items-center gap-2 <?= isActivePage($pageTitle, "Estate Pricing") ?>" <?= isAriaCurrentPage($pageTitle, "Estate Pricing") ?>><i class="bi bi-caret-right<?= fillIcon($pageTitle, "Estate Pricing") ?>"></i> Estate Pricing</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center gap-2 <?= isActivePage($pageTitle, "Customers") ?>" href="../customers/" <?= isAriaCurrentPage($pageTitle, "Customers") ?>>
            <i class="bi bi-people<?= fillIcon($pageTitle, "Customers") ?>"></i> Customers
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center gap-2 <?= isActivePage($pageTitle, "Burial Records") ?>" href="../burial-records/" <?= isAriaCurrentPage($pageTitle, "Burial Records") ?>>
            <i class="bi bi-collection<?= fillIcon($pageTitle, "Burial Records") ?>"></i> Burial Records
          </a>
        </li>
        <?php $reservationsList = ["Reservation Requests", "Lot Reservations", "Burial Reservations", "Reservation Verification"]; ?>
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center gap-2" data-bs-toggle="collapse" href="#reservationsSubmenu" role="button" aria-expanded="<?= isPageTitleInList($pageTitle, $reservationsList) ? "true" : "false"; ?>" aria-controls="reservationsSubmenu">
            <i class="bi bi-calendar-check<?= isPageTitleInList($pageTitle, $reservationsList) ? "-fill" : ""; ?>"></i> Reservations <i class="bi bi-caret-down<?= isPageTitleInList($pageTitle, $reservationsList) ? "-fill" : ""; ?>"></i>
          </a>
          <div class="collapse <?= isPageTitleInList($pageTitle, $reservationsList) ? "show" : ""; ?>" id="reservationsSubmenu">
            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
              <?php $reservationRequestsGroup = ["Reservation Requests", "Reservation Verification"]; ?>
              <li><a href="../reservation-requests/?type=lot" class="nav-link d-flex align-items-center gap-2 <?= isPageTitleInList($pageTitle, $reservationRequestsGroup) ?>" <?= isAriaCurrentPage($pageTitle, "Lot Reservation") ?>><i class="bi bi-caret-right<?= isPageTitleInList($pageTitle, $reservationRequestsGroup) ? "-fill" : ""; ?>"></i> Reservation Requests <?= showReservationRequestsBadge($pendingRequests); ?></a></li>
              <li><a href="../reservations-lot" class="nav-link d-flex align-items-center gap-2 <?= isActivePage($pageTitle, "Lot Reservation") ?>"><i class="bi bi-caret-right<?= fillIcon($pageTitle, "Lot Reservations") ?>"></i> Lot Reservations</a></li>
              <li><a href="../reservations-burial" class="nav-link d-flex align-items-center gap-2 <?= isActivePage($pageTitle, "Burial Reservation") ?>" <?= isAriaCurrentPage($pageTitle, "Burial Reservation") ?>><i class="bi bi-caret-right<?= fillIcon($pageTitle, "Burial Reservations") ?>"></i> Burial Reservations</a></li>
            </ul>
          </div>
        </li>

      </ul>
      <!-- <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-body-secondary text-uppercase">
        <span>Saved reports</span>
        <a class="link-secondary" href="#" aria-label="Add a new report">
          <svg class="bi"><use xlink:href="#plus-circle"/></svg>
        </a>
      </h6>
      <ul class="nav flex-column mb-auto">
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center gap-2" href="#">
            <svg class="bi"><use xlink:href="#file-earmark-text"/></svg>
            Current month
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center gap-2" href="#">
            <svg class="bi"><use xlink:href="#file-earmark-text"/></svg>
            Last quarter
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center gap-2" href="#">
            <svg class="bi"><use xlink:href="#file-earmark-text"/></svg>
            Social engagement
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center gap-2" href="#">
            <svg class="bi"><use xlink:href="#file-earmark-text"/></svg>
            Year-end sale
          </a>
        </li>
      </ul> -->
      <hr class="my-3">
      <ul class="nav flex-column mb-auto">
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center gap-2" href="#">
            <svg class="bi"><use xlink:href="#gear-wide-connected"/></svg>
            Settings
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center gap-2" href="#" data-bs-toggle="modal" data-bs-target="#signOutModal">
            <svg class="bi"><use xlink:href="#door-closed"/></svg>
            Sign out
          </a>
        </li>
      </ul>
    </div>
  </div>
</div>