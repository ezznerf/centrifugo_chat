<?php

namespace app\Helpers\Jobs;

interface JobInterface
{
    public function run();
    public function log();
}
