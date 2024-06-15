const calendar = document.getElementById('calendar');
const checkInButton = document.getElementById('checkInButton');
const checkInMessage = document.getElementById('checkInMessage');
let currentDay = 1;

// Create calendar
for (let i = 1; i <= 30; i++) {
  const day = document.createElement('div');
  day.classList.add('day');
  day.textContent = i;
  calendar.appendChild(day);
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
  }
});

// Enable check-in button for current day
document.querySelector('.day:nth-child(1) button').disabled = false;
