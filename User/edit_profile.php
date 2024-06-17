<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Profile - Okay Stationery Shop</title>
    <link rel="stylesheet" href="edit_profile.css">
</head>
<body>
    <header>
        <h1>
            <a id="back" href="../User/user_profile.php"><b>BACK TO USER PROFILE</b></a>
            <img src="logo.png" alt="OKAY Stationery Shop Logo" class="logo">
            OKAY STATIONERY SHOP
        </h1>
    </header>
    <div class="container">
        <h2>Edit Profile</h2>
        <form action="/update-profile" method="POST" enctype="multipart/form-data">
            <div class="profile-picture">
                <img src="profile_picture.jpg" alt="Profile Picture" id="profilePic">
                <input type="file" id="profilePicInput" name="profile_picture" accept="image/*">
            </div>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="tel" id="phone" name="phone" required placeholder="123-456-7890">
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="birthday">Birthday:</label>
                <input type="date" id="birthday" name="birthday" max="2005-12-12">
            </div>

            </div>
            <button type="submit">Update Profile</button>
        </form>
    </div>
</body>
</html>
