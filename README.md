RAP!
=============

RAP! "Rest API for PHP" provides a very simple way to generate Json Documentation based on your PHP classes and validate your API requests.

### DTOs with docs

DTOs classes with non and sample value.

```php
<?php 
namespace Sample;

class User
{
    /**
     * @var string
     * @EasyJsonDoc\Sample John Smith
     */
    public $name;

    /**
     * @var int
     * @EasyJsonDoc\Sample 33
     */
    public $age;

    /**
     * @var datetime
     */
    public $birthDate;

    /**
     * @var Sample\Status
     */
    public $status;

    /**
     * @var Sample\Group[]
     */
    public $groups;
}

class Status
{
    /**
     * @var string
     * @EasyJsonDoc\Sample Active
     */
    public $name;
}

class Group
{
    /**
     * @var string
     * @EasyJsonDoc\Sample PHP Fans
     */
    public $name;

    /**
     * @var int
     */
    public $members;
}

$documentor = new \GSaores\EasyJsonDoc\Serializer\JsonSerializer();
echo $documentor->serialize('Sample\User');
?>
```

### Output

The output of the code above

<pre>
{
   "name":"John Smith",
   "age":"33",
   "birthDate":"2014-05-10 18:11:57",
   "status":{
      "name":"Active, Inactive, Blocked"
   },
   "groups":[
      {
         "name":"PHP Fans",
         "members":123
      }
   ]
}
</pre>
