FROM mysql:5.6
ADD ./chatapp.sql /docker-entrypoint-initdb.d
ENV MYSQL_DATABASE=chatapp \
    MYSQL_ROOT_PASSWORD=123456

EXPOSE  3306