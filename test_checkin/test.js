const calendar = document.getElementById('calendar');
const checkInButton = document.getElementById('checkInButton');
const checkInMessage = document.getElementById('checkInMessage');
const checkInRecordsList = document.getElementById('checkInRecordsList');
let currentDay = 1;

// Create calendar
for (let i = 1; i <= 30; i++) {
  const day = document.createElement('div');
  day.classList.add('day');
  day.textContent = i;
  calendar.appendChild(day);

  // Create button for each day (optional)
  const button = document.createElement('button');
  button.textContent = 'Check-in';
  day.appendChild(button);

  // Enable check-in button for current day
  if (i === 1) {
    button.disabled = false;
  } else {
    button.disabled = true;
  }
}

// Check-in button event listener
checkInButton.addEventListener('click', () => {
  const days = document.querySelectorAll('.day');
  if (!days[currentDay - 1].classList.contains('checked')) {
    days[currentDay - 1].classList.add('checked');
    checkInButton.disabled = true;
    checkInMessage.style.display = 'block';
    checkInMessage.textContent = 'You\'ve completed your check-in for today!';
    currentDay++;
    if (currentDay <= 30) {
      days[currentDay - 1].querySelector('button').disabled = false;
    }

    // Send check-in data to PHP backend
    const dayChecked = currentDay - 1;
    fetch('record_checkin.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({ dayChecked }),
    })
      .then(response => response.json())
      .then(data => {
        displayCheckInRecords(data);
      })
      .catch(error => console.error('Error:', error));
  }
});

// Function to display check-in records
function displayCheckInRecords(records) {
  checkInRecordsList.innerHTML = ''; // Clear previous records
  records.forEach(record => {
    const li = document.createElement('li');
    li.textContent = `Day ${record.day}: ${record.checked ? 'Checked' : 'Not Checked'}`;
    checkInRecordsList.appendChild(li);
  });
}

// Load initial check-in records on page load
window.addEventListener('load', () => {
  fetch('fetch_records.php')
    .then(response => response.json())
    .then(data => {
      displayCheckInRecords(data);
    })
    .catch(error => console.error('Error:', error));
});
