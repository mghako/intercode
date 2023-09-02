# Simple CRUD for Employee Data

## Installation & updates

`git clone "remote-url-with-branch"` then `composer install` 

## Setup

run `php spark shield:setup`

## Server Requirements

PHP version 7.4 or higher is required.

## Run

- in console or project directory `php spark serve` or use `valet or herd in macos`. For window, you can use `wamp or xamp` and for linux env, setup virtual host or use `lamp`.
- go to `/register` url and create your account and go to `login` url to login and start using.


# View Employee

**URL** : `/employee`

**Method** : `GET`

**Auth required** : `YES`

## Success Response

```
    this will show you page with employees list
```
# Edit Employee

**URL** : `/employee/edit/{id}`

**Method** : `GET`

**Auth required** : `YES`

**Params required** : `YES`

## Success Response

```
    this will show you the page with employee data to edit
```

# Delete employee

**URL** : `/employee/delete/{id}`

**Method** : `GET`

**Auth required** : `YES`

**Params required** : `YES`

## Success Response

```
    this will delete employee data forever
```