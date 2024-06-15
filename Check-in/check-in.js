document.getElementById('checkInButton').addEventListener('click', function() {
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'path_to_your_php_file.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.onload = function() {
      if (xhr.status === 200) {
          var response = JSON.parse(xhr.responseText);
          var messageDiv = document.getElementById('checkInMessage');
          messageDiv.style.display = 'block';
          messageDiv.textContent = response.message;

          if (response.status === 'success') {
              messageDiv.style.color = 'green';
              // 这里可以添加显示优惠券信息的逻辑
          } else {
              messageDiv.style.color = 'red';
          }
      }
  };
  xhr.send('action=checkin');
});