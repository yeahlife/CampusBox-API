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
 use App\Student;


 use Tuupola\Base62;

 use Ramsey\Uuid\Uuid;
 use Psr\Log\LogLevel;
 
 class Skill extends \Spot\Entity
 {
    protected static $table = "student_skills";

    public static function fields()
    {
        return [
       

        "id" => ["type" => "integer" , "unsigned" => true, "primary" => true, "autoincrement" => true],
        "student_id" => ["type" => "integer"],
        "skill_id" => ["type" => "integer"],
        "proficiency" => ["type" => "integer"]
        ];
    }

    public static function skills(EventEmitter $emitter)
    {
        $emitter->on("beforeInsert", function (EntityInterface $entity, MapperInterface $mapper) {
            $entity->id = Base62::encode(random_bytes(9));
            });
    }

    public function clear()
    {
        $this->data([
            ]);
    }
    public static function relations(Mapper $mapper, Entity $entity)
    {
        return [
            'Skills' => $mapper->belongsTo($entity, 'App\Student', 'student_id')
            // 'Skill_name' => $mapper->hasOne($entity, 'App\SkillList', 'skill_id')
            // 'Students' => $mapper->hasManyThrough($entity, 'Entity\Student', 'Entity\SkillStudent', 'student_id', 'skill_id'),        
            ];
    }
}
