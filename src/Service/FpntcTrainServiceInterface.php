<?php

namespace Drupal\fpntc_train\Service;


interface FpntcTrainServiceInterface
{
    public function updateUserRegistration($userId, $courseId, $courseGradePoints, $courseGradePercentage, $completionDate);

}