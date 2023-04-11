<?php

namespace Sunhill\Collection\Tests\Feature\html_tests;

use Sunhill\Collection\Tests\DatabaseTestCase;

class HtmlTestBase extends DatabaseTestCase
{
    
    /**
     * @dataProvider HTMLProvider
     */
    public function testHTMLResponse(string $route, int $response_code = 200, string $expect_to_see = "", string $dont_expect_to_see = "")
    {
        $response = $this->get($route);
        $response->assertStatus($response_code);
        if (!empty($expect_to_see)) {
            $response->assertSeeText($expect_to_see);
        }
        if (!empty($dont_expect_to_see)) {
            $response->assertDontSee($dont_expect_to_see);
        }
    }
    
}