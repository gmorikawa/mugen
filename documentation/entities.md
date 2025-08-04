# Entities

## Classes

### User

* _id_: __primary key, uuid__;
* _email_: __varchar(127), unique, not null__;
* _username_: __varchar(127), unique, not null__;
* _password_: __varchar(255), not null__;

### Company

* _id_: __primary key, uuid__;
* _name_: __varchar(127), not null__;
* _country_: __varchar(127)__;
* _description_: __varchar(255)__;

### Platform

* _id_: __primary key, uuid__;
* _name_: __varchar(127), not null__;
* _code_: __varchar(63), not null__;
* _type_: __PlatformType, not null__;
* _developer_: __Company, not null__;
* _manufacturer_: __Company, not null__;

### Game

* _id_: __primary key, uuid__;
* _title_: __varchar(127), not null__;
* _developer_: __Company, not null__;
* _publisher_: __Company, not null__;
* _platform_: __Platform, not null__;

### GameCategory

* _id_: __primary key, uuid__;
* _game_: __Game, not null__;
* _category_: __Category, not null__;

### Cover

* _id_: __primary key, uuid__;
* _game_: __Game, not null__;
* _file_: __File, not null__;
* _descriptio_: __varchar(255)__;

### Category

* _id_: __primary key, uuid__;
* _name_: __varchar(127), not null__;
* _description_: __varchar(255)__;

### Image

* _id_: __primary key, uuid__;
* _game_: __Game, not null__;
* _region_: __Game, not null__;
* _country_: __Game, not null__;
* _file_: __File, not null__;
* _description_: __varchar(255)__;

### Region

* _id_: __primary key, uuid__;
* _name_: __varchar(127), not null__;
* _description_: __varchar(255)__;

### Country

* _id_: __primary key, uuid__;
* _name_: __varchar(127), not null__;
* _flag_: __File__;

### File

Observations: _size_ is measured in bytes.

* _id_: __primary key, uuid__;
* _name_: __varchar(127), not null__;
* _path_: __varchar(255), not null__;
* _size_: __integer, not null__;

## Enums

### PlatformType

* _Home_;
* _Portable_;
* _Hybrid_;

### FileState

* _Uploading_;
* _Available_;
* _Corrupted_;
