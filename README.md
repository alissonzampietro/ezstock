# :dollar: EzStock

[<img src="assets/images/ezstock.png">](https://whimsical.com/ezstock-DvdixTAPByw9SqQki5M9pD)

_Click over the image to access whimscal_

## Requirements

- Docker: ~24
- docker-compose: ~1.29.2

## How to run the project

- Rename .env.examples variables (one in the root and the other one into ezstock folder)
  - The root .env is related to docker.compose environment
- `docker-compose up`
- `docker-compose exec php bin/console doctrine:migrations:execute --up DoctrineMigrations\\Version20240730002030`
- `docker-compose exec php bin/console messenger:consume amqp -vv`

After this, check if frontend is running on the following URL: [http://localhost:5000/](http://localhost:5000/).

## Services

### MailHog

All e-mails are sent to this container. If you want to validate if your e-mail was received, just access the following link: [http://localhost:8025/](http://localhost:8025/)

### Rabbimq

You can track all requests and make a traffic analysis, accessing this link: [http://localhost:15672/#/](http://localhost:15672/#/). The credentials are set in the [.env](https://github.com/alissonzampietro/ezstock/blob/62d87ebee71b51c2f59c8f65c7d901d2c4efbba8/.env.example#L6-L7) file.

### alphavantage

I just created this container because the public api from alphavantage only supports 25 requests per day, thus, this service only returns a dumb JSON (doesn't matter if you change the query parameter)

## Utils Container Commands

- `docker-compose exec php bin/console messenger:consume amqp -vv`
  - Trigger rabbitmq to start processing the queue
- `docker-compose exec php bin/console doctrine:migrations:diff`
  - This command will analyze the entities, and if there was any change, will generate a migration. Once migration is generated, it's going to show its name (DoctrineMigrations\\Version20240730002030), so you just need to run
- `docker exec php bin/console doctrine:migrations:execute --up DoctrineMigrations\\Version20240730002030`

## Import postman

You can find all postman files (environments file and collections file) to be imported inside the folder `assets/postman`.

## TODO

- Implement unit testing
- Run rabbitmq automatically, without the need of running the command line on container
