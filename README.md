rohr for Kohana
===============

Rohr makes usage of routes and controllers very similar to what Ruby on Rails 2 had.

Instead of creating bunch of RESTful routes in bootstrap one can use just

```php
Route::resource('photos');
```

Module will make usage of routes with verbs according to table below (as far as I remember RoR has similar):

<table>
  <tr>
    <th>Verb</th>
    <th>Path</th>
    <th>Action</th>
    <th>Used for</th>
  </tr>
  <tr>
    <td>GET</td>
    <td>`/photos`</td>
    <td>index</td>
    <td>display a list of all photos</td>
  </tr>
  <tr>
    <td>GET</td>
    <td>`/photos/new`</td>
    <td>new</td>
    <td>return an HTML form for creating a new photo</td>
  </tr>
  <tr>
    <td>POST</td>
    <td>`/photos`</td>
    <td>create</td>
    <td>create a new photo</td>
  </tr>
  <tr>
    <td>GET</td>
    <td>`/photos/:id`</td>
    <td>show</td>
    <td>display a specific photo</td>
  </tr>
  <tr>
    <td>GET</td>
    <td>`/photos/:id/edit`</td>
    <td>edit</td>
    <td>return an HTML form for editing a photo</td>
  </tr>
  <tr>
    <td>PUT</td>
    <td>`/photos/:id`</td>
    <td>update</td>
    <td>update a specific photo</td>
  </tr>
  <tr>
    <td>PATCH</td>
    <td>`/photos/:id`</td>
    <td>patch</td>
    <td>partially update a specific photo</td>
  </tr>
  <tr>
    <td>DELETE</td>
    <td>`/photos/:id`</td>
    <td>destroy</td>
    <td>delete a specific photo</td>
  </tr>
</table>


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
