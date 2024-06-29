document.addEventListener('DOMContentLoaded', function () 
{
    const calendar = document.getElementById('calendar');
    const checkInButton = document.getElementById('checkInButton');
    const checkInMessage = document.getElementById('checkInMessage');
    const modal = document.getElementById('checkinModal');
    const modalMessage = document.getElementById('modalMessage');
    const closeModal = document.getElementsByClassName('close')[0];
    const progressBar = document.getElementById('progress');

    for (let i = 1; i <= 30; i++) 
    {
        const day = document.createElement('div');
        day.classList.add('day');
        day.textContent = i;
        calendar.appendChild(day);
    }

    checkInButton.addEventListener('click', function()
    {
        $.ajax({
            url: 'check_in.php',
            type: 'post',
            success: function(response) {
                checkInMessage.textContent = response;
                checkInButton.disabled = true;
                checkInMessage.style.display = 'block';
                updateCalendar();
                modalMessage.textContent = response;
                modal.style.display = 'block';
            }
        });
    });

    closeModal.onclick = function() 
    {
        modal.style.display = 'none';
    }

    window.onclick = function(event) 
    {
        if (event.target == modal) 
        {
            modal.style.display = 'none';
        }
    }

    function updateCalendar() 
    {
        $.ajax({
            url: 'get_checkin_dates.php',
            type: 'post',
            success: function(response) {
                const checkinDates = JSON.parse(response);
                const days = document.querySelectorAll('.day');
                days.forEach((day, index) => {
                    const checkinDate = new Date(checkinDates[index]);
                    if (checkinDate.toString() !== 'Invalid Date') {
                        day.classList.add('checked');
                    }
                });
                updateProgressBar(checkinDates.length);
            }
        });
    }

    function updateProgressBar(streakCount) 
    {
        const progressPercentage = (streakCount / 30) * 100;
        progressBar.style.width = `${progressPercentage}%`;
    }

    updateCalendar();
});
