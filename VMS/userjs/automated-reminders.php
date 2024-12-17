
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Automated Reminders</title>
  <link rel="stylesheet" href="reminder/automated-reminders.css">
</head>
<body>
  <div class="background">
    <div class="container">
      <header>
        <h1>🔔 Automated Reminders</h1>
        <p>Get notified about your vehicle's upcoming services and maintenance.</p>
      </header>

      <form id="reminder-form" class="form" method="POST" action="databaseconnect/set.php">
        <div class="form-group">
          <label for="name">🚗 Full Name</label>
          <input type="text" id="name" name="name" placeholder="Enter your name" required>
        </div>
        <div class="form-group">
          <label for="email">📧 Email Address</label>
          <input type="email" id="email" name="email" placeholder="Enter your email" required>
        </div>
        <div class="form-group">
          <label for="vehicle-number">🔢 Vehicle Number</label>
          <input type="text" id="vehicle-number" name="vehicle_number" placeholder="Enter your vehicle number" required>
        </div>
        <div class="form-group">
          <label for="reminder-date">📅 Next Service Date</label>
          <input type="date" id="reminder-date" name="reminder_date" required>
        </div>
        <button type="submit" class="btn">📤 Schedule Reminder</button>
      </form>

      <div id="success-message" class="hidden">
        <h2>✅ Reminder Scheduled!</h2>
        <p>You will receive a notification via email before your next service date.</p>
      </div>
    </div>
  </div>
  <script src="reminder/automated-reminders.js"></script>
</body>
</html>
