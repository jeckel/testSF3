test-SF3
========

A Symfony project created on May 3, 2017, 9:43 am.

Route `/status/` will test if the application is running.

## How to use it

It check if files `redis.running` and `mysql.running` exist in the `/var` folder.

If the file exist, it means that the service is correctly running.

Start the console :
```bash
$ php bin/console server:run
```

Open the url : `http://localhost:8000/status/`

Add or remove the `redis.running` and `mysql.running` files, and check the updated json reponse from the API.