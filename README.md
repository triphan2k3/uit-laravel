| |owner|admin|user|
|----|----|----|----|
|view owner|x|x||
|view admin|x|x||
|view user|x|x|x|
|edit owner|x|||
|edit admin|x|||
|edit user|x|x||
|delete owner|x|||
|delete admin|x|||
|delete user|x|||
|create user|x|||
|change role|x|||

# CHANGE LOG
## [27/8/2022]
- Create `UserSeeder` for generating random users
- Change `role` from string to enum type
- Update `UserController` and `UserPolicy`
- Update `resource/view`
- Display role on navigation

Problems:
- Change password
- Create user