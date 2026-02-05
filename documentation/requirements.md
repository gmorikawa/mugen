# Requirements

## Initial Configuration

1. When installed and run for the first time, the user will be first asked to inform a valid e-mail address that will be used as _login_ information for the admin user;
2. A verification e-mail will be sent to the user with the first access key to confirm that the e-mail exists;
3. In case of wrong e-mail the user should be able to modify the inputted value and restart the process of verification;
4. After successful e-mail verification the user should configure a secure password to be defined;
5. All the information set in the first steps can be reconfigured after in the application;

## User Authentication and Authorization

1. Users can have three different roles: _admin_, _manager_, _member_;
2. The system must have one, and only one _admin_ user;
3. The _admin_ roles is not transferable, creatable, and deletable;
4. Only logged users can access the system;
5. Only _admin_ or _managers_ can create new _managers_ or _members_;
6. Non-members cannot create their own account in the system;

## File Storage

1. The system allows to store files related to game ROM images and other application images.
2. Each context that generates a file should manage which files it allows to store.
3. A file have four states: Pending, Uploading, Available and Corrupted.

##  Platform Management

1. Only the _admin_ user can register game platforms.
2. A platform has:
    1. Console Name
    2. Abbreviation
    3. Console Type
    4. Developer Company
3. Each platform _name_ and its _abbreveation_ should be unique.
4. There are three types of platform: __HOME__, __PORTABLE__ and __HYBRID__.
5. The company that developed the console is required.

## Game Catalog

1. _admin_ and _managers_ can register games.
2. A game have the following data:
    1. Title
    2. Platform
    3. Cover Image
    4. Categories
    5. Developers
    6. Publishers
    7. Description
    8. Release Dates
3. If the game is released in multiple platforms, each one should have a separed registration.
4. Multiples release dates release dates are allowed, each per country.
5. Multiples publishers, developers and categories are allowed.
