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

use App\Student;
use League\Fractal;

class StudentTransformer extends Fractal\TransformerAbstract
{
  protected $availableIncludes = [
        'Events',
          'Skills'
    ];
    protected $defaultIncludes = [
          'Events',
          'Skills'
      ];
    public function transform(Student $student)
    {
        return [
            "id" => (integer)$student->student_id?: 0 ,
            "name" => (string)$student->name?: null,
            "photo" => (string)$student->photo?: null,
            
            "college" => [
                "roll_number" => (integer)$student->roll_number?: null,
                "name" => (string)$student->College['name']?: null,
                "hostelid" => (integer)$student->hostelid?: null,
                "room_number" => (string)$student->room_number?: null,
            ],
            "contacts" => [
                "email" => (string)$student->email?: null,  
                "phone" => (integer)$student->phone?: null,
            ],
            "about" => [
                "age" => (integer)$student->age?: null,
                "gender" => (string)$student->gender?: null,
                "home_city" => (string)$student->home_city?: null,
            ],
            
            "studies" => [
                "grad_id" => (integer)$student->grad_id?: null,
                "branch_id" => (integer)$student->branch_id?: null,
                "year" => (string)$student->year?: null,
                "class_id" => (integer)$student->class_id?: null,
                "passout_year" => (integer)$student->passout_year?: null,
                "college" => (string)$student->College['name']?: null,
            ],
           
            "links"=> [
                "facebook" => (string)$student->Socialid['facebook']?: null,
                "instagram" => (string)$student->Socialid['instagram']?: null,
                "github" => (string)$student->Socialid['github']?: null,
                "behance" => (string)$student->Socialid['behance']?: null,
                "soundcloud" => (string)$student->Socialid['soundcloud']?: null,
                "linkedin" => (string)$student->Socialid['linkedin']?: null,
                "other" => (string)$student->Socialid['other']?: null,
                "self" => "/students/{$student->id}"
            ]
        ];
    }
    public function includeEvents(Student $student) {
        $events = $student->Events;

        return $this->collection($events, new EventTransformer);
    }
 public function includeSkills(Student $student) {
        $skills = $student->Skills;

        return $this->collection($skills, new SkillTransformer);
    }
}
