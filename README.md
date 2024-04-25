# PetCare



<div align="center">
  <img src="https://i.ibb.co/wQncy57/logo-croped.png" alt="Logo" width="100">
  <h1>PetCare<span style="color: #1F2E88;">.</span></h1>
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

`CURRENCY_EXCHANGE_APIKEY`

