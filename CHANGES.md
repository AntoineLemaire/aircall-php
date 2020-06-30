# CHANGELOG

## 2.0.0 (2020-06-30)
* Upgrade minimum PHP version to 7.1
* BC BREAK: review naming of all functions in all endpoint to simplify them:
  * list
  * get
  * update
  * create
  * search 
  * link
  * ...
  
Eg:
```
# Before
$client->users->getUsers;
$client->users->getUser('155468');

# After

$client->users->list();
$client->users->get('155468');
```


## 1.1.0 (2020-06-30)

* Fix AircallCalls::comment
* Add /calls/:id/insight_cards
* Add all Tag endpoints
* Add all Webhook endpoints
## 1.0.2 (2019-11-24)

 * Add missing endpoints:
   * /calls/:id/metadata
   * /calls/:id/comments
   * /calls/:id/tags
   * /calls/:id/pause_recording
   * /calls/:id/resume_recording
   * /users/:id/calls
   * /users/:id/dial

## 1.0.1 (2019-11-24)

 * Add options to allow extra parameters for filters (https://developer.aircall.io/api-references/#extra-parameters)

## 1.0.0 (2017-01-26)

 * Complete documentation in README
 * Remove unused functions parameters

## 1.0.0-b1 (2017-01-25)

 * initial beta release
