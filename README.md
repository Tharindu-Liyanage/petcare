<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');
  body{
    font-family: 'Poppins', sans-serif;
  }
</style>
# PetCare



<div style="display:flex; justify-content:center; align-items:center; color:#fff; margin-bottom:10px; gap:10px;">
    <div><img style="width:100px; height:auto;" src="https://i.ibb.co/wQncy57/logo-croped.png" alt="Logo"></div>
        <div style="font: 400 50px 'Poppins', sans-serif;">PetCare<span style="color:#1F2E88">.</span></div>
    </div>
</div>

- PetCare is a veterinary system for managing pet clinics, developed as a group project.

## Important

 - Enable GD extension:
    - Open the `php.ini` connfiguration file for your PHP installation.
    - Look for the folowing line in `php.ini` and uncomment it (remove the semicolon at the beginning of the line if it exists):

        ```bash
        extension=gd
        ```
    -   If it's not present, you can add it.
    -   Restart Apache Server.



    


## Environment Variables

To run this project, you will need to add the following environment variables to your .env file

`MAIL_USERNAME`

`MAIL_PASSWORD`

`NOTIFY_USERID`

`NOTIFY_APIKEY`

`STRIPE_SECRET_KEY`

