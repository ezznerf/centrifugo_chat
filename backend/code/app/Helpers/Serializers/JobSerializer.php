<?php

namespace app\Helpers\Serializers;

use app\Helpers\Jobs\JobInterface;
use Exception;
use TypeError;

class JobSerializer implements SerializerInterface
{
    public static function serialize(JobInterface $message): string{
        try{
            return serialize($message);
        }catch (TypeError $e){
            throw new Exception('Неверный тип данных передан для сериализации: ' . $e->getMessage(), $e->getCode());
        }catch (Exception $e){
            throw new Exception('Ошибка при сериализации данных: ' . $e->getMessage(), $e->getCode());
        }
    }

    public static function unserialize(string $serialized): JobInterface{
        try {
            return unserialize($serialized);
        }catch (Exception $e){
            throw new Exception('Ошибка при десериализации данных: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }
}
