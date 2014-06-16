<?php

namespace GSoares\RAP\Factory;

use Sample\Group;
use Sample\GroupCategory;
use Sample\Status;
use Sample\User;

/**
 * Class RequestClassFactoryTest
 *
 * @package GSoares\RAP\Factory
 */
class RequestClassFactoryTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var RequestClassFactory
     */
    private $factory;

    public function setUp()
    {
        $this->factory = new RequestClassFactory();

        parent::setUp();
    }

    public function tearDown()
    {
        $this->factory = null;

        parent::tearDown();
    }

    public function testCreateSuccess()
    {
        $groupCategory = new GroupCategory();
        $groupCategory->name = 'Programing';
        $groupCategory->code = 10;

        $group = new Group();
        $group->name = 'PHP Fans';
        $group->members = 777;
        $group->groupCategory = $groupCategory;

        $user = new User();
        $user->name = 'John Smith';
        $user->birthDate = '2000-01-01';
        $user->age = 10;
        $user->status = new Status();
        $user->status->code = 10;
        $user->status->name = 'Active';
        $user->groups = [$group];

        $request = [
            'name' => $user->name,
            'age' => $user->age,
            'birthDate' => $user->birthDate,
            'status' => [
                'code' => $user->status->code,
                'name' => $user->status->name
            ],
            'groups' => [
                [
                    'name' => current($user->groups)->name,
                    'members' => current($user->groups)->members,
                    'groupCategory' => [
                        'code' => $groupCategory->code,
                        'name' => $groupCategory->name
                    ]
                ]
            ]
        ];

        $this->assertEquals($user, $this->factory->create('Sample\User', $request));
    }
}
