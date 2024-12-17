<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Retrieve the username from the session
$username = htmlspecialchars($_SESSION['username']);
?>


<!DOCTYPE php>
<php lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vehicle Servicing Dashboard</title>
  <link rel="stylesheet" href="dash/dash.css">
</head>
<body>
  <div class="dashboard-container">
    <!-- Sidebar -->
    <aside class="sidebar">
      <h2>🚗 Vehicle Service</h2>
      <ul>
        <li><a href="#" class="active">📊 Dashboard</a></li>
        <li><a href="approve-request.php">🔔 Servicing Schedule</a></li>
        <li><a href="service_completed.php"> ✅ Servicing Completed </a></li>
        <li><a href="service-history.php"> 🛠️ Service History</a></li>
        <li><a href="inventory-management.php">📦 Inventory Management</a></li>
        <li><a href="update-tracking.php">📦 Updated Tracking</a></li>

   
      </ul>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
      <header>
        <h1>Dashboard</h1>
        <div class="user-actions">
          <span id="username"> Hello ,<?php echo $username; ?></span>
          <button id="logout-btn">Logout</button>
        </div>
      </header>
      
      <!-- Dashboard Details -->
      <section class="dashboard-overview">
        <div class="dashboard-cards">
          <div class="card">
            <h3>Total Vehicles</h3>
            <p>25</p>
          </div>
          <div class="card">
            <h3>Services Completed</h3>
            <p>18</p>
          </div>
          <div class="card">
            <h3>Upcoming Services</h3>
            <p>7</p>
          </div>
          <div class="card">
            <h3>Pending Services</h3>
            <p>5</p>
          </div>
        </div>
      </section>
    </main>
  </div>
  
  <!-- Logout Confirmation Modal -->
  <div id="logout-modal" class="modal">
    <div class="modal-content">
      <p>Are you sure you want to logout?</p>
      <button id="confirm-logout" class="btn-confirm">Yes</a></button>
      
      <button id="cancel-logout" class="btn-cancel">No</button>
    </div>
  </div>
  
  <script src="dash/dash.js"></script>
</body>
</php>
