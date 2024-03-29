# Divido-ConfigChallenge

Technical Challenge for designing and implementing a configuration system for holding and 
overwriting config values from different config files.

## How to start the project
The project uses Docker and Docker-compose, please make sure you have installed both tools
before you move to the next steps.
- [Install docker](https://docs.docker.com/get-docker/).

### Start the project
- On the project directory from a terminal, execute the command `make build`
- Then we have to start our containers with the command `make start`
    - After you run this step you will have a PHP cli container running where you can 
    execute php scripts with different examples.
- To run a script you can call `make run php script.php` where `php script.php` is the command we want 
  to execute on the container. There are two relevant scripts in this repo:
    - `index.php` is a simple example loading some configs and retrieving a single value.
    - `overwritingConfig.php` is a more complex example overwriting configs and retrieving different values.
    
### Running Tests
- You just need to run the next command `make tests` on the project root folder.
