## Installation

Requires PHP 5.6.

Using Composer:

The recommended way to install intercom-php is through [Composer](https://getcomposer.org):

First, install Composer:

```
$ curl -sS https://getcomposer.org/installer | php
```

Next, install the latest intercom-php:

```
$ php composer.phar require intercom/intercom-php
```

Finally, you can include the files in your PHP script:

```php
require "vendor/autoload.php";
```

## Clients

```php
use Aircall\AircallClient;

$client = new AircallClient(appId, apiKey);

// Test purpose
$client->ping();
```

## Company

```php
// Get generic data about the account
$client->company->getCompany();
```

## Users

```php
// Get a user by ID
$client->users->getUser("155468");

// List all users
$client->users->getUsers([]);
```

## Calls

```php
// Get a call by ID
$client->calls->getCall('155468');

// List all calls
$client->calls->getCalls([]);

// Search calls
$client->calls->searchCalls([]);

// Display a link in-app to the User who answered a specific Call.
$client->calls->linkCall([]);

// Transfer the Call to another user.
$client->calls->callPath([]);

// Delete the recording of a specific Call.
$client->calls->deleteRecordingCall([]);

// Delete the voicemail of a specific Call.
$client->calls->deleteVoicemailCall([]);
```

## Contacts

```php
// Get a contact by ID
$client->contacts->getContact('699421');

// List all contacts
$client->contacts->getContacts([]);

// Create a contact
$client->contacts->create([]);

// Search contacts
$client->contacts->searchContacts([]);

// Update data for a specific Contact
$client->contacts->update('165451', []);

// Delete a specific Contact
$client->contacts->delete('325459');
```