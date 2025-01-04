<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
    <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="sidebarMenuLabel">Green Haven Memorial Park</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" data-bs-toggle="collapse" href="#account-collapse" role="button" aria-expanded="<?php if ($pageTitle == "Account Settings" || $pageTitle == "Notifications") { echo "true"; } else { echo "false"; } ?>" aria-controls="account-collapse">
                        <i class="bi bi-person-circle"></i> Admin User <i class="bi bi-caret-down-fill"></i>
                    </a>
                    <div class="collapse <?php if ($pageTitle == "Account Settings" || $pageTitle == "Notifications") { echo "show"; } ?>" id="account-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li><a href="user-management.php" class="nav-link d-flex align-items-center gap-2 <?php if ($pageTitle == "User Management") echo "active text-bg-primary"; ?>"><i class="bi bi-bell<?php if ($pageTitle == "Notifications") echo "-fill"; ?>"></i> Notifications</a></li>
                            <li><a href="#" data-bs-toggle="modal" data-bs-target="#account-settings-modal" class="nav-link d-flex align-items-center gap-2 <?php if ($pageTitle == "Backup & Recovery") echo "active text-bg-primary"; ?>"><i class="bi bi-sliders"></i> Account Settings</a></li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-2" href="#" data-bs-toggle="modal" data-bs-target="#sign-out-modal">
                                    <i class="bi bi-door-closed"></i> Sign out
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
            <hr class="my-3">
            <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2 <?php if ($pageTitle == "Dashboard") echo "active text-bg-primary"; ?>" aria-current="page" href="dashboard.php">
                    <i class="bi bi-house<?php if ($pageTitle == "Dashboard") echo "-fill"; ?>"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2 <?php if ($pageTitle == "Map") echo "active text-bg-primary"; ?>" href="map.php">
                    <i class="bi bi-map<?php if ($pageTitle == "Map") echo "-fill"; ?>"></i> Map
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2 <?php if ($pageTitle == "Interments") echo "active text-bg-primary"; ?>" href="interments.php">
                    <i class="bi bi-people<?php if ($pageTitle == "Interments") echo "-fill"; ?>"></i> Interments
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2" data-bs-toggle="collapse" href="#transactions-collapse" role="button" aria-expanded="<?php if ($pageTitle == "Payments" || $pageTitle == "Reservations") { echo "true"; } else { echo "false"; } ?>" aria-controls="transactions-collapse">
                    <i class="bi bi-arrow-left-right"></i> Transactions <i class="bi bi-caret-down-fill"></i>
                </a>
                <div class="collapse <?php if ($pageTitle == "Payments" || $pageTitle == "Reservations") { echo "show"; } ?>" id="transactions-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a href="payments.php" class="nav-link d-flex align-items-center gap-2 <?php if ($pageTitle == "Payments") echo "active text-bg-primary"; ?>"><i class="bi bi-credit-card<?php if ($pageTitle == "Payments") echo "-fill"; ?>"></i> Payments</a></li>
                        <li><a href="reservations.php" class="nav-link d-flex align-items-center gap-2 <?php if ($pageTitle == "Reservations") echo "active text-bg-primary"; ?>"><i class="bi bi-calendar-check<?php if ($pageTitle == "Reservations") echo "-fill"; ?>"></i> Reservations</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2 <?php if ($pageTitle == "Reports") echo "active text-bg-primary"; ?>" href="reports.php">
                    <i class="bi bi-bar-chart-line<?php if ($pageTitle == "Reports") echo "-fill"; ?>"></i> Reports
                </a>
            </li>
            </ul>
            <hr class="my-3">
            <ul class="nav flex-column mb-auto">
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2" data-bs-toggle="collapse" href="#settings-collapse" role="button" aria-expanded="<?php if ($pageTitle == "User Management" || $pageTitle == "Backup & Recovery" || $pageTitle == "Activity Logs" || $pageTitle == "Help & Support") { echo "true"; } else { echo "false"; } ?>" aria-controls="settings-collapse">
                    <i class="bi bi-gear<?php if ($pageTitle == "User Management" || $pageTitle == "Backup & Recovery" || $pageTitle == "Activity Logs" || $pageTitle == "Help & Support") { echo "-fill"; } ?>"></i> Settings <i class="bi bi-caret-down-fill"></i>
                </a>
                <div class="collapse <?php if ($pageTitle == "User Management" || $pageTitle == "Backup & Recovery" || $pageTitle == "Activity Logs" || $pageTitle == "Help & Support") { echo "show"; } ?>" id="settings-collapse">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a href="user-management.php" class="nav-link d-flex align-items-center gap-2 <?php if ($pageTitle == "User Management") echo "active text-bg-primary"; ?>"><i class="bi bi-person<?php if ($pageTitle == "User Management") echo "-fill"; ?>-gear"></i> User Management</a></li>
                        <li><a href="backup-and-recovery.php" class="nav-link d-flex align-items-center gap-2 <?php if ($pageTitle == "Backup & Recovery") echo "active text-bg-primary"; ?>"><i class="bi bi-arrow-counterclockwise"></i> Backup & Recovery</a></li>
                        <li><a href="activity-logs.php" class="nav-link d-flex align-items-center gap-2 <?php if ($pageTitle == "Activity Logs") echo "active text-bg-primary"; ?>"><i class="bi bi-list"></i> Activity Logs</a></li>
                        <li><a href="help-and-support.php" class="nav-link d-flex align-items-center gap-2 <?php if ($pageTitle == "Help & Support") echo "active text-bg-primary"; ?>"><i class="bi bi-question-circle<?php if ($pageTitle == "Help & Support") echo "-fill"; ?>"></i> Help & Support</a></li>

                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2 <?php if ($pageTitle == "About") echo "active text-bg-primary"; ?>" href="about.php">
                    <i class="bi bi-info-circle<?php if ($pageTitle == "About") echo "-fill"; ?>"></i> About
                </a>
            </li>
            </ul>
        </div>
    </div>
</div>

<!-- Signout Modal -->
<div class="modal fade" id="sign-out-modal" tabindex="-1" aria-labelledby="sign-out-modal-label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-bg-primary">
        <h1 class="modal-title fs-5" id="sign-out-modal-label">Signout Confirmation</h1>
      </div>
      <div class="modal-body">
        Are you sure you want to sign out?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <a href="../controller/sign-out-controller.php"><button type="button" class="btn btn-primary">Yes</button></a>
      </div>
    </div>
  </div>
</div>

<!-- Account Settings Modal -->
<div class="modal fade" id="account-settings-modal" tabindex="-1" aria-labelledby="account-settings-modal-label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header text-bg-primary">
        <h1 class="modal-title fs-5" id="account-settings-modal-label">Signout Confirmation</h1>
      </div>
      <div class="modal-body">
        <!-- Account Information Section -->
        <div class="form-section">
          <h4>Personal Information</h4>
          <form action="update-account.php" method="post">
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="username" value="JohnDoe123">
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email Address</label>
              <input type="email" class="form-control" id="email" name="email" value="johndoe@example.com">
            </div>
            <div class="mb-3">
              <label for="phone" class="form-label">Phone Number</label>
              <input type="tel" class="form-control" id="phone" name="phone" value="123-456-7890">
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
          </form>
        </div>

        <hr class="my-3">

        <!-- Password Update Section -->
        <div class="form-section">
          <h4>Change Password</h4>
          <form action="update-password.php" method="post">
            <div class="mb-3">
              <label for="currentPassword" class="form-label">Current Password</label>
              <input type="password" class="form-control" id="currentPassword" name="currentPassword">
            </div>
            <div class="mb-3">
              <label for="newPassword" class="form-label">New Password</label>
              <input type="password" class="form-control" id="newPassword" name="newPassword">
            </div>
            <div class="mb-3">
              <label for="confirmPassword" class="form-label">Confirm New Password</label>
              <input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
            </div>
            <button type="submit" class="btn btn-danger">Change Password</button>
          </form>
        </div>

        <hr class="my-3">

        <!-- Preferences Section -->
        <div class="form-section">
          <h4>Preferences</h4>
          <form action="update-preferences.php" method="post">
            <div class="form-check mb-3">
              <input class="form-check-input" type="checkbox" id="emailNotifications" name="emailNotifications" checked>
              <label class="form-check-label" for="emailNotifications">Enable Email Notifications</label>
            </div>
            <div class="form-check mb-3">
              <input class="form-check-input" type="checkbox" id="smsNotifications" name="smsNotifications">
              <label class="form-check-label" for="smsNotifications">Enable SMS Notifications</label>
            </div>
            <button type="submit" class="btn btn-secondary">Update Preferences</button>
          </form>
        </div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
        <a href="../controller/sign-out-controller.php"><button type="button" class="btn btn-primary">Yes</button></a>
      </div> -->
    </div>
  </div>
</div>