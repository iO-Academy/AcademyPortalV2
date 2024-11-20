<?php

namespace Portal\Services;

use Exception;
use Portal\Models\ApplicantsModel;
use Portal\Models\CohortsModel;

class ValidationService
{
    public static function checkCircumstanceOptionExists($id, ApplicantsModel $model, $fieldName): bool
    {
        $result = $model->getAllCircumstanceOptions();
        $result = array_map(function($item) {return $item['id']; }, $result);
//        echo $id;
//        var_dump($result);
        if (!in_array($id, $result)) {
            throw new Exception("$fieldName doesn't exist");
        }
        return true;
    }

    public static function checkFundingOptionExists($id, ApplicantsModel $model, $fieldName): bool
    {
        $result = $model->getAllFundingOptions();
        $result = array_map(function($item) {return $item['id']; }, $result);
        if (!in_array($id, $result)) {
            throw new Exception("$fieldName doesn't exist");
        }
        return true;
    }

    public static function checkCohortOptionExists($id, CohortsModel $model, $fieldName): bool
    {
        $result = $model->getAll();
        $result = array_map(function($item) {return $item->getId(); }, $result);
        if (!in_array($id, $result)) {
            throw new Exception("$fieldName doesn't exist");
        }
        return true;
    }

    public static function checkHeardAboutOptionExists($id, ApplicantsModel $model, $fieldName): bool
    {
        $result = $model->getAllHearAboutUsOptions();
        $result = array_map(function($item) {return $item['id']; }, $result);
        if (!in_array($id, $result)) {
            throw new Exception("$fieldName doesn't exist");
        }
        return true;
    }
}
