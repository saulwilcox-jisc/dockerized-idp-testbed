cd `dirname $0`
cd ..
docker-compose exec php bin/console doctrine:schema:update -f
