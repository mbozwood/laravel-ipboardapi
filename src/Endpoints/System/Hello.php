<?php

namespace MBozwood\IPBoardApi;

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
