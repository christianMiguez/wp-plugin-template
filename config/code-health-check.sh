#!/bin/bash

# installs PHPCS and WPCS via composer
function maybe_install_dependencies {

	# Checking available coding standards.
	if type ./vendor/bin/phpcs > /dev/null; then

		# standards=$(phpcs -i)

		if [[ $(phpcs -i) == *"WordPress"* ]]; then
			return
		fi

	fi
	echo "Code Sniffing in progress"
	echo "Installing PHPCS and WPCS via composer"
	# install phpcs:
	composer install

	return
}

phpfiles=$(git status -uno --porcelain| grep 'A\|M'| awk '{print $2}' | grep .php)
if [ ! -z "$phpfiles" ]; then
	maybe_install_dependencies
    # do sniffing
    ./vendor/bin/phpcs --extensions=php -p -n -s --colors $phpfiles
else
    exit 0
fi