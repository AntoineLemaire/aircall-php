## Installation

Requires PHP 5.6.

Using Composer:

The recommended way to install aircall-php is through [Composer](https://getcomposer.org):

First, install Composer:

```
$ curl -sS https://getcomposer.org/installer | php
```

Next, install the latest aircall-php:

```
$ php composer.phar require antoinelemaire/aircall-php
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
$client->users->getUser('155468');

// List all users
$client->users->getUsers();
```

## Calls

```php
// Get a call by ID
$client->calls->getCall('155468');

// List all calls
$client->calls->getCalls();

// Search calls
$client->calls->searchCalls([
  'tags' => 'myTag',
]);

// Display a link in-app to the User who answered a specific Call.
$client->calls->linkCall('155468', [
    'link' => 'http://something.io/mypage'
]);

// Transfer the Call to another user.
$client->calls->transfertCall('1644658', [
    'user_id' => '8945487'
]);

// Delete the recording of a specific Call.
$client->calls->deleteRecordingCall('795312');

// Delete the voicemail of a specific Call.
$client->calls->deleteVoicemailCall('13877988');
```

## Contacts

```php
// List all contacts
$client->contacts->getContacts();

// Get a contact by ID
$client->contacts->getContact('699421');

// Create a contact
$client->contacts->create([
    'first_name'    => 'John',
    'last_name'     => 'Doe',
    'information'   => 'TEST',
    'phone_numbers' => [
        [
            'label' => 'Work',
            'value' => '+33631000000',
        ],
    ],
    'emails' => [
        [
            'label' => 'Work',
            'value' => 'john.doe@something.io',
        ],
    ],
]);

// Search contacts
$client->contacts->searchContacts([
    'phone_number' => '+33631000000',
    'email' => 'john.doe@something.io'
]);

// Update data for a specific Contact
$client->contacts->update('165451', [
  'first_name'    => 'John',
  'last_name'     => 'Doe',
  'information'   => 'TEST',
  'phone_numbers' => [
      [
          'label' => 'Work',
          'value' => '+33631000000',
      ],
  ],
  'emails' => [
      [
          'label' => 'Work',
          'value' => 'john.doe@something.io',
      ],
  ],
]);

// Delete a specific Contact
$client->contacts->delete('325459');
```