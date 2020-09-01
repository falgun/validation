# Validation

Simple array based Input Validator.
Used in falgun framework to validate form values.

## Install
 *Please not that  PHP 7.4 or higher is required.*

Via Composer

``` bash
$ composer require falgunphp/validation
```

## Basic Usage
```php
<?php
use Falgun\Validation\Validator;

$validation = new Validator();

$validation->select('name')->required()->minLen(1)->maxLen(100)->alphaNumWords();
$validation->select('email')->required()->email();

// formData should be something like $_POST values
$formData = ['name' => 'John Doe', 'email' => 'email@site.com'];

$isValid = $validation->validate($formData);

// $isValid will be either true or false

// If validation fails we can get errors
$errors = $validation->errors()->all();
/**
* Example:
* array (
*	'name' => array (
*	                'Required' => 'Name is required'
*	          )
*       )
*/
```

If you are using Falgun Framework, you can use \Falgun\Notification Library to pass the validation errors to UI
```php
<?php
use Falgun\Http\Session;
use Falgun\Validation\Validator;

// Build Notification Object
$notification = new Notification(new Session(), BootstrapNote::class);
// pass $notification to Validator
$validation = new Validator($notification);

$validation->select('name')->required();

// we are passing blank array, so validation will fail
if ($validation->validate([])) {
	// do something
} else {
        $errors = $notification->getNotifications();
	print_r($errors);
/** (
*    [0] => Falgun\Notification\Notes\BootstrapNote Object
*        (
*            [icon:protected] => exclamation-triangle
*            [message:protected] => Name is required!
*            [type:protected] => warning
*        )
*
* )
*/
}
```
## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
