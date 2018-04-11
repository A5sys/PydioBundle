# PydioBundle
Access and manage resources from your Pydio instance.

# Composer

Use composer to get the bundle

    composer require "a5sys/pydio-bundle"

# Activate the bundle

In the AppKernel, activate the bundle for the dev environment

    new A5sys\PydioBundle\PydioBundle(),

# Usage

## Parameters needed

config.yml

    pydio:
        base_api_url: %pydio_base_url%
        api_url: %pydio_api_url%
        login: %pydio_login%
        password: %pydio_password%

parameters.yml

    parameters:
        pydio_base_url: 'http://myPydioInstance'
        pydio_api_url: '/pydio/api/v2'
        pydio_login: 'pydioLogin'
        pydio_password: 'pydioPassword'

## Services

- pydio.directory_service
  - List / Metadata / Create / Remove a folder inside a workspace or a folder
- pydio.file_service
  - Create / Remove / get content of a file
- pydio.search_service
  - Search (API V1) against a workspace or a directory

# Contribute

Create a PR with the associated tests.

Run tests : 
```
vendor/bin/phpunit
or
vendor/bin/phpunit --filter DirectoryServiceTest
```
