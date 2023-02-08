build:
	docker compose up

run:
	docker run -p 6379:6379 redis

clean:
	docker compose down && docker compose rm --force
	docker image rm selarbackendtest3-selar -f;

