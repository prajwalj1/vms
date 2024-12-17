
// Close button functionality
document.getElementById('close-form').addEventListener('click', () => {
  const container = document.querySelector('.container');
  container.style.display = 'none'; // Hides the form
  document.querySelector('#background').style.filter = 'none'; // Removes blur effect
});

// Optional: Reset form fields when closed
document.getElementById('close-form').addEventListener('click', () => {
  document.getElementById('service-request-form').reset();
});

