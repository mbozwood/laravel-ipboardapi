<?php

namespace MBozwood\IPBoardApi\Endpoints\System;

trait Hello
{
    /**
     * Call core/hello to find details of forum instance.
     *
     * @return string json return.
     */
    public function hello()
    {
        return $this->getRequest('core/hello');
    }
}
