.PHONY: test
test: vendor/bin/phpunit
	vendor/bin/phpunit --colors tests