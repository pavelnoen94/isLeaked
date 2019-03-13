# isLeaked

This is function to check if a password has been leaked before users register with it on a web site. This project was inspired by [this video](https://www.youtube.com/watch?v=hhUb5iknVJs&t=418s). Feel free to change the code and use it how you like. 

## Usage
Use this on registration forms and when users try to change passwords. The function returns -1 on any error, and a number representing how many times the password has been leaked. The function takes in the password in plaintext.

## How to include in a project

just input ``include_once($path_to_pwnedChecker.php)`` at the top of the php file where users type their passwords.
You might use it like this:
````
if(isLeaked($password) > 0){
// do not accept password
}

// continue with registration or with password change...
````
## Example

Example code is in example directory

## How to run

### Windows

install php server like [XAMMP](https://www.apachefriends.org/index.html). You might need to install [CURL](https://curl.haxx.se/windows/) as well. Not sure
