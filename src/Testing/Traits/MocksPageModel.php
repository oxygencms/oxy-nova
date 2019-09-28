<?php

namespace Oxygencms\OxyNova\Testing\Traits;

use Mockery;

trait MocksPageModel
{
    /**
     * When testing views that use the routeToPage() helper function it will try to fetch
     * a Page from the database (which is missing if not seeded in the test) and throw
     * "ErrorException: No query results for model [Oxygencms\OxyNova\Models\Page]".
     * Use this trait and call the mockPages() method in your tests to mock it.
     *
     * @return void
     */
    public function mockPages()
    {
        $page = config('oxygen.page_model');

        $mock = Mockery::mock($page);

        $this->app->instance($page, $mock);

        $mock->shouldReceive('where')
             ->andReturn($mock);

        $mock->shouldReceive('firstOrFail')
             ->andReturn( (object) ['slug' => 'mocked-page-slug']);
    }
}
