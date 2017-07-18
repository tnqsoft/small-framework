# Getting Started with Doctrine
https://doctrine-orm.readthedocs.io/en/latest/tutorials/getting-started.html

# Read the ./cli-config.php (by default) and generate mapping yaml files to ./config/yaml directory
php vendor/bin/doctrine orm:convert-mapping --namespace="" --force --from-database yml ./config/yaml

# Generated models to ./src directory
php vendor/bin/doctrine orm:generate-entities --generate-annotations=true --update-entities=true --generate-methods=true ./src/Entity

# Validate schema
php vendor/bin/doctrine orm:validate-schema

# Build Framework
composer require symfony/http-foundation
composer require symfony/routing
composer require symfony/http-kernel
composer require twig/twig

# Vitual Host
```
Listen *:8003
<VirtualHost *:8003>
        ServerName codebase.lab
        ServerAlias codebase.lab

	#SSLEngine on
	#SSLCertificateFile /etc/apache2/ssl/apache.crt
	#SSLCertificateKeyFile /etc/apache2/ssl/apache.key

        DocumentRoot /home/nntuan/Tutorials/php/code-base/public
        <Directory /home/nntuan/Tutorials/php/code-base/public>
                Options Indexes FollowSymLinks
                AllowOverride all
		Require all granted
        </Directory>
        ErrorLog ${APACHE_LOG_DIR}/error-codebase-lab.log
        CustomLog ${APACHE_LOG_DIR}/access-codebase-lab.log combined
</VirtualHost>
```
