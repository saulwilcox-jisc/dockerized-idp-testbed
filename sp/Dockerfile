FROM unicon/shibboleth-sp

RUN yum -y update \
    && yum -y install php mod_ssl mod_ldap mod_proxy mod_proxy_fcgi mod_deflate mod_rewrite\
    && yum -y clean all

COPY etc-shibboleth /etc/shibboleth/
COPY etc-httpd/ /etc/httpd/
COPY var-www-html/ /var/www/html/
