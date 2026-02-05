# Entities

## Classes

### User

* _id_: __primary key, uuid__;
* _email_: __varchar(127), unique, not null__;
* _username_: __varchar(127), unique, not null__;
* _password_: __varchar(255), not null__;
* _role_: __UserRole, not null__;

### User Profile

* _user\_id_: __User__;
* _fullname_: __varchar(127), not null__;
* _biography_: __varchar(255)__;
* _avatar_: __File__;

### File

* _id_: __primary key, uuid__;
* _name_: __varchar(127), not null__;
* _path_: __varchar(255), not null__;
* _state_: __FileState, not null__;

### Country

* _id_: __primary key, uuid__;
* _name_: __varchar(127), not null__;
* _flag_: __File__;

### Language

* _id_: __primary key, uuid__;
* _name_: __varchar(127), not null__;
* _iso\_code_: __varchar(7), not null__;

### Company

* _id_: __primary key, uuid__;
* _name_: __varchar(127), not null__;
* _country_: __Country__;
* _description_: __varchar(255)__;

### Platform

* _id_: __primary key, uuid__;
* _name_: __varchar(127), unique, not null__;
* _abbreviation_: __varchar(63), unique, not null__;
* _type_: __PlatformType, not null__;
* _developer_: __Company, not null__;

### Game

* _id_: __primary key, uuid__;
* _title_: __varchar(127), not null__;
* _platform_: __Platform, not null__;
* _description_: __text__;
* _cover\_id_: __File__;

### Category

* _id_: __primary key, uuid__;
* _name_: __varchar(127), not null, unique__;
* _description_: __varchar(255)__;

### GameCategory

* _game_: __Game, not null__;
* _category_: __Category, not null__;

### GameDeveloper

* _game_: __Game, not null__;
* _company_: __Company, not null__;

### GamePublisher

* _game_: __Game, not null__;
* _company_: __Company, not null__;

### GamePlatform

* _game_: __Game, not null__;
* _company_: __Company, not null__;

### GameCountry

* _game_: __Game, not null__;
* _country_: __Country, not null__;
* _release\_date_: __date__;

### Image

Image in this application represents the data of a game the way it was extracted from the original media. It is very common to call _ROMs_ when referring to images of cartridges. But for all other cases, like playstation games which comes in CD, it might be an [incorrect term](https://www.reddit.com/r/Roms/comments/18jsvwa/why_are_roms_called_as_roms_i_mean_rom_stands_for/). A _image_ or _game dump_ are more generic terms that encompasses all cases.

* _id_: __primary key, uuid__;
* _game_: __Game, not null__;
* _color\_encoding_: __ColorEncoding, not null__;
* _file_: __File, not null__;
* _description_: __varchar(255)__;

### ImageLanguage

* _image_: __Image, not null__;
* _language_: __Language, not null__;

### ColorEncoding

* _id_: __primary key, uuid__;
* _name_: __varchar(127), not null__;
* _description_: __varchar(255)__;

## Enums

### UserRole

* _ADMIN_;
* _MANAGER_;
* _MEMBER_;

### PlatformType

* _HOME_;
* _PORTABLE_;
* _HYBRID_;

### FileState

* _PENDING_;
* _UPLOADING_;
* _AVAILABLE_;
* _CORRUPTED_;
