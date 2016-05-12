<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * 帐号类错误信息类
 */
class Account_errors{
    CONST RET_REGISTER_SUCCESS=1;
    CONST RET_REGISTER_FAILED=0;
    CONST RET_PHONE_REGISTERED=10001;
    CONST RET_NAME_REGISTERED=10002;
    CONST RET_EMAIL_REGISTERED=10003;
    CONST RET_PHONE_FORMAT=10004;
    CONST RET_NAME_FORMAT=10005;
    CONST RET_EMAIL_FORMAT=10006;
    CONST RET_PHONE_NULL=10007;
    CONST RET_NAME_NULL=10008;
    CONST RET_EMAIL_NULL=10009;
    CONST RET_PASSWORD_NULL=10010;
    CONST RET_TYPE_NULL=10011;
    CONST RET_LOGIN_SUCCESS=10012;
    CONST RET_LOGIN_FAILED=10013;
    CONST RET_TOKEN_GEN_ERROR=10014;
    CONST RET_TOKEN_ERROR=10015;
    CONST RET_LOGOUT_SUCCESS=10016;
    CONST RET_LOGOUT_FAILED=10017;
    CONST RET_FIELD_NULL=10018;
    CONST RET_UPDATE_SUCCESS=10019;
    CONST RET_UPDATE_FAILED=10020;
    CONST RET_DELETE_SUCCESS=10021;
    CONST RET_DELETE_FAILED=10022;
    CONST RET_DB_ERROR=10023;
    CONST RET_CAPTCHA_ERROR=10024;
    static $code_msg=array(
        self::RET_REGISTER_SUCCESS=>'注册成功',
        self::RET_REGISTER_FAILED=>'系统错误，注册失败',
        self::RET_PHONE_REGISTERED=>'手机号码已经被注册',
        self::RET_NAME_REGISTERED=>'用户名已经被注册',
        self::RET_EMAIL_REGISTERED=>'邮箱已经被注册',
        self::RET_PHONE_FORMAT=>'手机号码格式不正确',
        self::RET_NAME_FORMAT=>'用户格式不正确',
        self::RET_EMAIL_FORMAT=>'邮件格式不正确',
        self::RET_PHONE_NULL=>'手机号码不能为空',
        self::RET_NAME_NULL=>'用户名不能为空',
        self::RET_EMAIL_NULL=>'邮箱不能为空',
        self::RET_PASSWORD_NULL=>'密码不能为空',
        self::RET_TYPE_NULL=>'注册类型不能为空',
        self::RET_LOGIN_SUCCESS=>'登录成功',
        self::RET_LOGIN_FAILED=>'登录失败,账号或密码错误',
        self::RET_TOKEN_GEN_ERROR=>'token写入数据库失败',
        self::RET_TOKEN_ERROR=>'你尚未登录,token为空或者错误',
        self::RET_LOGOUT_SUCCESS=>'退出系统成功',
        self::RET_LOGOUT_FAILED=>'系统错误,退出系统失败',
        self::RET_FIELD_NULL=>'字段不能为空',
        self::RET_UPDATE_SUCCESS=>'数据库记录更新成功',
        self::RET_UPDATE_FAILED=>'数据库记录更新失败',
        self::RET_DELETE_SUCCESS=>'数据库记录删除成功',
        self::RET_DELETE_FAILED=>'数据库记录删除失败',
        self::RET_DB_ERROR=>'数据库读取错误',
        self::RET_CAPTCHA_ERROR=>'短信验证码无效'
    );
}
