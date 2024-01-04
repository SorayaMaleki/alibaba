FROM composer:2

# environment arguments
ARG UID
ARG GID
ARG USER

ENV UID=${UID}
ENV GID=${GID}
ENV USER=${USER}

WORKDIR /var/www/html

# Dialout group in alpine linux conflicts with MacOS staff group's gid, whis is 20. So we remove it.
RUN delgroup dialout

# Creating user and group
RUN addgroup -g ${GID} --system ${USER}
RUN adduser -G ${USER} --system -D -s /bin/sh -u ${UID} ${USER}

CMD bash -c "composer clear-cache && composer install --prefer-dist --optimize-autoloader && composer du"