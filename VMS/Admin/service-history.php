<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Service History</title>
  <link rel="stylesheet" href="service_history/service-history.css">
</head>
<body>
  <div class="background">
    <div class="container">
      <header>
        <h1>📜 Service History</h1>
        <p>Access a detailed history of all services performed on your vehicle.</p>
      </header>

      <!-- Form to Search Service History -->
      <form id="history-form" class="form" action="fetch_service_history.php">
        <div class="form-group">
          <label for="vehicle-number">🚗 Vehicle Number</label>
          <input type="text" id="vehicle-number" placeholder="Enter your vehicle number" required>
        </div>
        <button type="submit" class="btn">🔍 View Service History</button>
      </form>

      <!-- Service History Display -->
      <div id="history-display" class="history hidden">
        <h2>🔧 Service History</h2>
        <ul id="history-list" class="history-list">
          <!-- Dynamic service history records will appear here -->
        </ul>
        <button id="back-button" class="btn secondary">🔙 Back to Search</button>
      </div>
    </div>
  </div>

  <script src="service_history/service-history.js"></script>
</body>
</html>
