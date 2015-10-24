<!DOCTYPE html>
<html>
<head>
    <title>BugBounty Profile</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../_images/_logos/bug-hunter-icon.ico" />
    <link rel="stylesheet" type="text/css" href="../../_css/hunter-profile.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>
<body>
    {{include ('header_logout.php')}}
    <h1>Edit Your Profile</h1>
    <div id="content_area">
        <form>
            <div id="picture_upload">
                <img id="profile_picture" src="../../_images/_profiles/_{{username}}/{{username}}_profile.png" alt="Profile Picture" />
                <input type="file" name="profilePicture" />
            </div>
            <div id="profile_info">
                <input type="text" placeholder="{{username}}" />
                <input type="text" placeholder="{{email}}" />
                <input type="password" placeholder="Old Password" />
                <input type="password" placeholder="New Password" />
                <input type="password" placeholder="Confirm New Password" />
                <input type="submit" value="Update" />
            </div>
        </form>
    </div>
    
</body>
</html>