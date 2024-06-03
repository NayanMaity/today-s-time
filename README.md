<h3>Today's Time a blog site</h3>

<p>Module -> Client, Admin</p>

--------------------------------------------------->

<ul>
    Client Module -> 
                 <li>index.php</li>
                 <li>login.php</li>
                 <li>register.php</li>
                 <li>profile.php</li>
                 <li>single-blog.php</li>
                 <li>update-profile.php</li>
                 <li>become-blogger.php</li>
                 <li>add-post.php</li>
                 <li>reset-password.php</li>
                 <li>search-user.php</li>
                 <li>logout.php</li>
</ul>



<ul>
Admin Module -> 
<li>dashboard.php</li>
<li>admin-profile.php</li>
                
<li><b>manage-blog.php</b></li>
    <li>add-blog.php</li>
    <li>edit-blog.php</li>
    <li>delete-blog.php</li>

<li><b>manage-user.php</b></li>
    <li>edit-category.php</li>
    <li>delete-category.php</li>

<li><b>manage-blogger.php</b></li>
    <li>add-blogger.php</li>
    <li>edit-bloger.php</li>
    <li>remove-bloger.php</li>
    <li>delete-bloger.php</li>

<li><b>manage-category.php</b></li>
    <li>add-category.php</li>
    <li>edit-category.php</li>
    <li>delete-category.php</li>

<li>logout.php</li>

</ul>

------------------------------------------------------>


<p>DATABASE -> today's_time</p>

<p>TABLES -> users, post, post_category, notification</p>



------------------------------------------------------->


user -> user_id(PRIMARY), user_name, user_email, user_password(md5), avatar, user_role(user, admin, blogger) , token, 
        user_show(0, 1), create_user_data, update_user_data


user_role -> role_id(PRIMARY), role_name


post_category -> category_id(PRIMARY), category_name, category_desc, category_show(0, 1), create_category_data, update_category_data


post -> post_id(PRIMARY), post_title, post_desc, post_image, category_id(reference from post_category table),
         user_id(reference from users table), post_show(0, 1), create_post_data, update_post_data


notification -> notification_id(PRIMATY), notification_title(Become Blogger),  
                notification_status(pending, approve, reject), user_id(reference from users table), 
                notification_show(0, 1), create_notification_data, update_notification_data


---------------------------------------------------->

<h2>How to run the Today's Time Project</h2>
<ol>
    <li>Download the zip file</li>
    <li>Extract the file and copy today's_time folder</li>
    <li>Paste inside root directory(for xampp, xampp/htdocs, for wamp, wamp/www, for lamp, var/www/Html)</li>
    <li>Open PHPMyAdmin (http://localhost/phpmyadmin)</li>
    <li>Create a database with name today_s_time_db</li>
    <li>Import today_s_time_db.sql file(given inside the zip package in SQL file folder)</li>
    <li>Run the script http://localhost/today's_time (frontend)</li>
    <li>For admin panel http://localhost/today's_time/admin (admin panel)</li>
</ol>

<ul>Credential for admin panel :
    <li>useremail: admin@gmail.com</li>
    <li>Password: 12345</li>
</ul>

<ul>Credential for user panel :
    <li>useremail: demo@gmail.com</li>
    <li>Password: 12345</li>
</ul>