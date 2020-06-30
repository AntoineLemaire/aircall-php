This is a non-official Aircall PHP library which provides access to the Aircall API from applications written in the PHP language.

Api references: https://developer.aircall.io/api-references/

## API version
Last update: 1.11.2


## Installation

The recommended way to install aircall-php is through [Composer](https://getcomposer.org):


```
composer require antoinelemaire/aircall-php
```

## Usage
### Clients

```php
use Aircall\AircallClient;

$client = new AircallClient(appId, apiKey);

// Test purpose
$client->ping();
```

### Company

```php
// Get generic data about the account
$client->company->get();
```

### Users

```php
// Get a user by ID
$client->users->get(155468);

// List all users
$client->users->list();
```

### Calls

```php
// Get a call by ID
$client->calls->get(155468);

// List all calls
$client->calls->list();

// Search calls
$client->calls->search([
  'tags' => 'myTag',
]);

// Display a link in-app to the User who answered a specific Call.
$client->calls->link(155468, [
    'link' => 'http://something.io/mypage'
]);

// Transfer the Call to another user.
$client->calls->transfert(1644658, [
    'user_id' => 8945487
]);

// Delete the recording of a specific Call.
$client->calls->deleteRecording(795312);

// Delete the voicemail of a specific Call.
$client->calls->deleteVoicemail(13877988);
```

### Contacts

```php
// List all contacts
$client->contacts->list();

// Get a contact by ID
$client->contacts->get(699421);

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
$client->contacts->search([
    'phone_number' => '+33631000000',
    'email' => 'john.doe@something.io'
]);

// Update data for a specific Contact
$client->contacts->update(165451, [
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
$client->contacts->delete(325459);
```
### Tags
TODO
### Webhooks
TODO
### Teams
TODO
