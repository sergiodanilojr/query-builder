test:
	docker-compose exec php bin/phpunit

install:
	docker-compose exec php composer i

du:
	docker-compose exec php composer du