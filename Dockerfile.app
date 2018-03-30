FROM php:7.2-fpm

# Install PHP tools
RUN apt-get update && apt-get install -y gnupg2 curl libz-dev \
 && docker-php-ext-install pdo_mysql zip \
 && curl --silent --show-error https://getcomposer.org/installer | php

# Install Node
RUN curl -sL https://deb.nodesource.com/setup_9.x -o /tmp/nodesource_setup.sh \
    && bash /tmp/nodesource_setup.sh \
    && apt-get install -y nodejs build-essential

# Install dev tools
RUN apt-get install -y vim git

# Create user
RUN useradd --no-log-init -r -m blag

# Set up envirnment
WORKDIR /home/blag

ADD . .
RUN chown -R blag:blag .
USER blag

# Set up entrypoint
ENTRYPOINT ["/home/blag/entrypoint.sh"]
CMD ["php-fpm"]

