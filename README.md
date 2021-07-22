

## About APIS

This code base contains 5 apis

- Login
- Invitation
- Sign Up
- Verify Account
- Update Profile


### Migration

After clone this repo add env file for laravel and add database and smtp credentials. Once these changes done run

- **php artisan migrate**

It will generate all tables with admin user with username: admin & password : secret

### APIS END POINTS AS BELOW

- Login : http://localhost:8000/api/login , type : POST, params : username, password

- Invite : http://localhost:8000/api/invite , type : POST, params : email , headers : { Authorization : 'Bearer token' }

- Sign Up : http://localhost:8000/api/accept-invite, type : POST, params : token, username, password

- Verify Account : http://localhost:8000/api/verify, type : POST, params : username, pin

- Update Profile : http://localhost:8000/api/update-profile, type : POST, params : email, username,avatar(file,optional), headers : { Authorization : 'Bearer token' }

### Refer postman collection attached with in this repo


