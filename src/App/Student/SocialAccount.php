<?php

/*
 * This file is part of the Slim API skeleton package
 *
 * Copyright (c) 2016-2017 Mika Tuupola
 *
 * Licensed under the MIT license:
 *   http://www.opensource.org/licenses/mit-license.php
 *
 * Project home:
 *   https://github.com/tuupola/slim-api-skeleton
 *
 */

 namespace App;

 use Spot\EntityInterface as Entity;
 use Spot\MapperInterface as Mapper;
 use Spot\EventEmitter;

 use Tuupola\Base62;

 use Ramsey\Uuid\Uuid;
 use Psr\Log\LogLevel;
 
 class SocialAccount extends \Spot\Entity
 {
    protected static $table = "social_accounts";

    public static function fields()
    {
        return [


        "social_account_id" => ["type" => "integer" , "unsigned" => true, "primary" => true, "autoincrement" => true],
        "student_id" => ["type" => "integer"],
        "type" => ["type" => "integer"],
        "token" => ["type" => "string"],
        "link" => ["type" => "string"],
        "name" => ["type" => "string"],
        "email" => ["type" => "string"],
        "gender" => ["type" => "string"],
        "birthday" => ["type" => "string"],
        "picture" => ["type" => "string"],
        "cover" => ["type" => "string"]
        ];
    }

    public static function students(EventEmitter $emitter)
    {
        $emitter->on("beforeInsert", function (EntityInterface $entity, MapperInterface $mapper) {
            $entity->id = Base62::encode(random_bytes(9));
            });
    }

    public function clear()
    {
        $this->data([
            "social_account_id" => 0,
                   "student_id" => 0,
                   "type" => 0,
                   "token" => null,
                   "link" => null,
                   "name" => null,
                   "email" => null,
                   "gender" => null,
                   "birthday" => null,
                   "picture" => null,
                   "cover" => null
            ]);
    }

    public static function relations(Mapper $mapper, Entity $entity)
    {
        return [
        'Socialid' => $mapper->belongsTo($entity, 'App\Student', 'student_id'),
        ];
    }
}