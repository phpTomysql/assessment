

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

- Login : http://localhost:8000/api/login
- Invite : http://localhost:8000/api/invite
- Sign Up : http://localhost:8000/api/accept-invite
- Verify Account : http://localhost:8000/api/verify
- Update Profile : http://localhost:8000/api/update-profile

### Refer postman collection attached with in this repo


