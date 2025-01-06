# Usando a imagem base do Alpine
FROM alpine:3.20

# Definindo os parâmetros de usuário e UID
ARG USER=vinicius
ARG UID=1000

# Instalação de dependências essenciais
RUN apk update && apk add --no-cache \
    curl \
    zip \
    unzip \
    sqlite \
    nodejs \
    npm \
    supervisor \
    php83 \
    php83-fpm \
    php83-curl \
    php83-mbstring \
    php83-bcmath \
    php83-openssl \
    php83-pdo \
    php83-pdo_sqlite \
    php83-pdo_mysql \
    php83-tokenizer \
    php83-fileinfo \
    php83-zip \
    php83-intl \
    php83-xml \
    php83-ctype \
    php83-openssl \
    php83-phar \
    php83-pcntl \
    php83-session \
    php83-dom \
    php83-xmlreader \
    php83-xmlwriter \
    && rm -rf /var/cache/apk/* /tmp/* /usr/share/man /usr/share/doc

# Instalação do Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --no-interaction

# Criação do usuário e diretórios necessários
RUN addgroup -g ${UID} -S ${UID} \
    && adduser -u ${UID} -S ${USER} -G ${UID} \
    && mkdir -p /var/log/ /var/run/ /var/www/ \
    && chown -R ${USER}:www-data /var/log/ \
    && chown -R ${USER}:www-data /var/run/ \
    && chown -R ${USER}:www-data /var/www/ \
    && chmod -R 775 /var/log/ /var/run/ /var/www/

# Copiar os arquivos de configuração
COPY ./supervisor/supervisord.conf /etc/supervisord.conf
COPY ./supervisor/conf.d/*.conf /etc/supervisor/conf.d/
COPY ./php/php-fpm.conf /etc/php83/php-fpm.conf
COPY ./php/php.ini /etc/php83/php.ini

# Iniciar o Supervisor
CMD ["supervisord", "-c", "/etc/supervisord.conf"]

# Rodar o container com o usuário criado
USER ${USER}

# Definindo o diretório de trabalho
WORKDIR /var/www/html
