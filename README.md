## Simple serverless API read and create SMS deployed using Lambda function ###
### Project using lib to create custom PHP env for lambda function 
Refence: https://bref.sh/docs/installation.html

1. Install lib bref 
```
composer require bref/bref
```

2. Create serverless.yml with the following content 
```yaml
service: app
provider:
    name: aws
    runtime: provided.al2
plugins:
    - ./vendor/bref/bref
functions:
    app:
        handler: index.php
        layers:
            - ${bref:layer.php-74-fpm}
        events:
            - httpApi: '*'
```

3. Run command
```
serverless deploy
```