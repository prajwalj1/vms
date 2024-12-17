<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Service Request</title>
  <link rel="stylesheet" href="service_req/service-request.css">
</head>
<body>
  <div id="background" class="background">
    <div class="overlay">
      <div class="container">
        <header>
          <h1>📋 Service Request</h1>
          <p>Request a service for your vehicle effortlessly.</p>
        </header>

        <form id="service-request-form" class="form" action="databaseconnect/rq_insert.php" method="POST">

          <div class="form-group">
            <label for="name">🚗 Full Name</label>
            <input type="text" id="name" name="name"  placeholder="Enter your full name" required>
          </div>

          <div class="form-group">
            <label for="email">📧 Email Address</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
          </div>

          <div class="form-group">
            <label for="vehicle-number">🔢 Vehicle Number</label>
            <input type="text" id="vehicle-number" name="vehicle-number" placeholder="Enter your vehicle number" required>
          </div>

          <div class="form-group">
            <label for="service-type">🔧 Type of Service</label>
            <select id="service-type" name="service-type" required>
              <option value="" disabled selected>Select a service</option>
              <option value="general">General Service</option>
              <option value="engine">Engine Repair</option>
              <option value="tire">Tire Replacement</option>
              <option value="cleaning">Cleaning and Detailing</option>
            </select>
          </div>

          <div class="form-group">
            <label for="date">📅 Preferred Service Date</label>
            <input type="date" id="date" name="date" required>
          </div>

          <div class="form-group">
            <label for="message">💬 Additional Notes</label>
            <textarea id="message" rows="4" name="message" placeholder="Add any additional information..."></textarea>
          </div>

          <button type="submit" class="btn">🚀 Submit Request</button>
        </form>
      </div>
    </div>
  </div>

<script>
  // Disable today's date in the date picker
  const today = new Date().toISOString().split('T')[0];
  document.getElementById("date").setAttribute("min", today);
</script>

  <script src="service_req/service-request.js"></script>
</body>
</html>
