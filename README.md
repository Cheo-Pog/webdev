## logins

Login admin:
    - username: Jesse321
    - password: WEED
Login customer:
    - username: waltuh
    -password: finger

customers logins can be made in the application itself so you dont have to use the one provided.

## Usage

In a terminal, from the cloned project folder, run:
```bash
docker compose up
```

NGINX will now serve files in the app/public folder. Visit localhost in your browser to check.
PHPMyAdmin is accessible on localhost:8080

If you want to stop the containers, press Ctrl+C. 

Or run:
```bash
docker compose down
```