FROM phpdockerio/php71-fpm:latest
WORKDIR "/application"

# Fix debconf warnings upon build
ARG DEBIAN_FRONTEND=noninteractive

# Install selected extensions and other stuff
RUN apt-get update \
    && apt-get -y --no-install-recommends install git php7.1-mysql php-redis php7.1-bcmath php7.1-gd
    # begin cassandra driver installation
    # Initial environment setup
RUN apt-get -y --no-install-recommends install build-essential cmake wget libpcre3-dev php-pear php7.1-dev
    # GNU Multiple Precision Arithmetic
RUN apt-get -y --no-install-recommends install libgmp-dev
    # libuv
RUN wget -O libuv.deb https://downloads.datastax.com/cpp-driver/ubuntu/16.04/dependencies/libuv/v1.33.0/libuv1_1.33.0-1_amd64.deb \
    && wget -O libuv-dev.deb https://downloads.datastax.com/cpp-driver/ubuntu/16.04/dependencies/libuv/v1.33.0/libuv1-dev_1.33.0-1_amd64.deb \
    && dpkg -i libuv.deb && rm -f libuv.deb \
    && dpkg -i libuv-dev.deb && rm -f libuv-dev.deb
    # OpenSSL
RUN apt-get -y --no-install-recommends install libssl-dev
    # C/C++ driver
RUN wget -O cpp-driver.deb https://downloads.datastax.com/cpp-driver/ubuntu/16.04/cassandra/v2.14.0/cassandra-cpp-driver_2.14.0-1_amd64.deb \
    && wget -O cpp-driver-dev.deb https://downloads.datastax.com/cpp-driver/ubuntu/16.04/cassandra/v2.14.0/cassandra-cpp-driver-dev_2.14.0-1_amd64.deb \
    && dpkg -i cpp-driver.deb && rm -f cassandra-cpp-driver.deb \
    && dpkg -i cpp-driver-dev.deb && rm -f cassandra-cpp-driver-dev.deb
    # Installing the PHP extension
RUN pecl install cassandra
    ## end cassandra driver installation
RUN apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*
