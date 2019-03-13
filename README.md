# isLeaked

## Usage
This is a quick script to check if a password has been compromized before users register on a web site. This project was inspired by [this video](https://www.youtube.com/watch?v=hhUb5iknVJs&t=418s)
it returns the number of times that password has been leaked. Feel free to change the code and use it how you like.

## How to include in a project

just input ``include_once($path_to_pwnedChecker.php)`` at the top of the php file where users type their passwords.
You might use it like this:
````
if(isLeaked($password) > 0){
// do not accept password
}

// continue with registration or with password change...


````
