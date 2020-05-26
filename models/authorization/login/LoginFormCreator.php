<?php


namespace app\models\authorization\login;


use app\models\authorization\login\loginForms\aaa\AAALoginForm;
use app\models\authorization\login\loginForms\ScorecardLoginForm;

/**
 * Class LoginFormCreator
 * @package app\models\authorization
 */
class LoginFormCreator // возвращает какой-либо вид авторизации
{
    /**
     * types of authorization
     */
    const TYPE_AAA = 1;
    const TYPE_SCORECARD = 2;

    /**
     * returns login form by type
     *
     * @param int $type
     * @return AAALoginForm|ScorecardLoginForm
     */
    static public function getLoginFormByType(int $type = self::TYPE_SCORECARD) {
        switch ($type) {
            case self::TYPE_AAA:
                return new AAALoginForm();

            case self::TYPE_SCORECARD:
                return new ScorecardLoginForm();

            default:
                return new ScorecardLoginForm();
        }
    }
}