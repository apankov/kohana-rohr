rohr for Kohana
===============

Rohr makes usage of routes and controllers very similar to what Ruby on Rails 2 had.

Instead of creating bunch of RESTful routes in bootstrap one can use just

```php
Route::resource('photos');
```

Module will make usage of routes with verbs according to table below (as far as I know RoR has similar):

| Verb   | Path             | action  | used for                                     |
|--------+------------------+---------+----------------------------------------------|
| GET    | /photos          | index   | display a list of all photos                 |
| GET    | /photos/new      | new     | return an HTML form for creating a new photo |
| POST   | /photos          | create  | create a new photo                           |
| GET    | /photos/:id      | show    | display a specific photo                     |
| GET    | /photos/:id/edit | edit    | return an HTML form for editing a photo      |
| PUT    | /photos/:id      | update  | update a specific photo                      |
| PATCH  | /photos/:id      | patch   | partially update a specific photo            |
| DELETE | /photos/:id      | destroy | delete a specific photo                      |


To finish RESTful functionality one has to implement controller that extends `Controller_Common_Resources`


Some more examples

```php
// API Users

$options_api = array(
  'prefix' => 'api/v1/',
  'directory' => 'api',
);

Route::resource('users', $options_api);


// Management of tags

$options_manage = array(
  'prefix' => 'manage/',
  'directory' => 'manage',
);

Route::resource('tags', $options_manage);


// Extended resource

Route::extend_resource('users',
  array(
    'tags',
  ),
  $options_api);
```

