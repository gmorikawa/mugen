# Requirements

## Initial Configuration

* When installed and run for the first time, the user will be first asked to inform a valid e-mail address that will be used as _login_ information for the admin user;
* A verification e-mail will be sent to the user with the first access key to confirm that the e-mail exists;
* In case of wrong e-mail the user should be able to modify the inputted value and restart the process of verification;
* After successful e-mail verification the user should configure a secure password to be defined;
* All the information set in the first steps can be reconfigured after in the application;

## User Authentication and Authorization

* Users can have three different roles: _admin_, _manager_, _member_;
* The system must have one, and only one _admin_ user;
* The _admin_ roles is not transferable, creatable, and deletable;
* Only logged users can access the system;
* Only _admin_ or _managers_ can create new _managers_ or _members_;
* Non-members cannot create their own account in the system;
