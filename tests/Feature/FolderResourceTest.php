<?php
/**
 * -- file description --
 *
 * @author Marko Krüger <plant2code@marko-krueger.de>
 *
 */

namespace Tests\Feature;


use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Response;
use Tests\TestResource;
use Tests\Traits\ModelFactoryTrait;

/**
 * Class FolderResourceTest
 *
 * @package Tests\Feature
 */
class FolderResourceTest extends TestResource
{
    use DatabaseMigrations, ModelFactoryTrait;

    /**
     *
     */
    public function testIndex()
    {
        $user = $this->createUser();
        $this->be($user);
        $this->createFolder($user, [], 5);

        $differentUser = $this->createUser();
        $this->createFolder($differentUser, [], 10);

        $response = $this->getJson('api/v1/folders')
                         ->assertStatus(Response::HTTP_OK)
                         ->decodeResponseJson();
        $this->assertCount(5, $response['data']);

        foreach ($response['data'] as $folder) {
            $this->assertEquals($user->id, array_get($folder, 'relationships.user.data.id'));
        }
    }

    /**
     *
     */
    public function testIndexFilterByUser()
    {
        $user = $this->createUser(['name' => 'anthony']);
        $this->be($user);

        $this->createFolder($user, [], 5);

        $response = $this->getJson('api/v1/folders?filter[user]=anthony')
                         ->assertStatus(Response::HTTP_OK)
                         ->decodeResponseJson();
        $this->assertCount(5, $response['data']);

    }

    /**
     *
     */
    public function testIndexWithFilterForbiddenForUser()
    {
        $userBadGuy = $this->createUser(['name' => 'karlheinzdeutschmann']);
        $this->be($userBadGuy);

        $user = $this->createUser(['name' => 'anthony']);

        $this->createFolder($user, [], 5);

        $response = $this->getJson('api/v1/folders?filter[user]=anthony')
                         ->assertStatus(Response::HTTP_FORBIDDEN)
                         ->decodeResponseJson();
    }

    /**
     *
     */
    public function testRead()
    {

    }

}
