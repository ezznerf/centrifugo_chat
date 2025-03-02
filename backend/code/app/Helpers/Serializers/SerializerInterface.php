<?php

namespace app\Helpers\Serializers;

use app\Helpers\Jobs\JobInterface;

interface SerializerInterface
{
    public static function serialize(JobInterface $message): string;

    public static function unserialize(string $serialized): JobInterface;
}
