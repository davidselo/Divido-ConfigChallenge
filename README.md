# Divido-ConfigChallenge

Technical Challenge for designing and implementing a configuration system for holding and 
overwriting config values from different config files.

## How to start the project
The project uses Docker and Docker-compose, please make su you have installed both tools
before you move to the next steps.
- [Install docker](https://docs.docker.com/get-docker/).

### Start the project
- On the project directory from a terminal, execute the next command `make build`
- Then we have to start our containers with the command `make start`
    - After you run this step you will have a PHP cli container running where you can 
    execute php script with different examples.
- For running a script you can call `make run php index.php` where `php index` is the command we want 
  to executate on the container
    - i.e: `make run php overwritingConfig.php`
    - other example: `make run php index.php`
    
### Running Tests
- You just need to run the next command `make tests` on the project root folder.