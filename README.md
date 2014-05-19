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
     * @RAP\Sample John Smith
     */
    public $name;

    /**
     * @var int
     * @RAP\Sample 33
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
     * @RAP\Sample Active
     */
    public $name;
}

class Group
{
    /**
     * @var string
     * @RAP\Sample PHP Fans
     */
    public $name;

    /**
     * @var int
     */
    public $members;
}

$documentor = new \GSaores\RAP\Serializer\JsonSerializer();
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
