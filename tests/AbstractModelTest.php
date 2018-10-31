<?php

namespace Gietos\Dadata\Tests;

use Gietos\Dadata\Tests\Model\ModelWithPublicProperty;

class AbstractModelTest extends BaseTestCase
{
    public function testThrowsExceptionForNull()
    {
        $this->expectException(\TypeError::class);
        $dummy = new ModelWithPublicProperty();
        $dummy->configure(null);
    }
}
