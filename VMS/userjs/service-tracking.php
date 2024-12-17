<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vehicle Service Tracking</title>
  <link rel="stylesheet" href="service_track/service-tracking.css">
</head>
<body>
  <div id="background">
    <img src="save.png" alt="Background" class="background-img">
  </div>

  <div class="container">
  <button class="cancel-btn" onclick="hideLoginPanel()">&#10005;</button>
    <header>
      <h1>🚗 Vehicle Service Number</h1>
      <p>Get real-time updates on your vehicle’s service status.</p>
    </header>

    <form id="tracking-form" class="form">
      <div class="form-group">
        <label for="tracking-id">🔍 Vehicle Number</label>
        <input type="text" id="tracking-id" placeholder="Enter your Vehicle Number" required>
      </div>
      <button type="submit" class="btn">📡 Track Service</button>
    </form>

    <div id="tracking-status" class="status_hidden">
      <h2>🔔 Service Status</h2>
      <p id="status-message">Fetching your service details...</p>
      <ul id="status-updates" class="updates"></ul>
    </div>
  </div>

  <script src="service_track/service-tracking.js"></script>
</body>
</html>
