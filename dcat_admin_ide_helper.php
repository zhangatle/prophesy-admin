<?php

/**
 * A helper file for Dcat Admin, to provide autocomplete information to your IDE
 *
 * This file should not be included in your code, only analyzed by your IDE!
 *
 * @author jqh <841324345@qq.com>
 */
namespace Dcat\Admin {
    use Illuminate\Support\Collection;

    /**
     * @property Grid\Column|Collection id
     * @property Grid\Column|Collection name
     * @property Grid\Column|Collection type
     * @property Grid\Column|Collection version
     * @property Grid\Column|Collection detail
     * @property Grid\Column|Collection created_at
     * @property Grid\Column|Collection updated_at
     * @property Grid\Column|Collection is_enabled
     * @property Grid\Column|Collection parent_id
     * @property Grid\Column|Collection order
     * @property Grid\Column|Collection icon
     * @property Grid\Column|Collection uri
     * @property Grid\Column|Collection extension
     * @property Grid\Column|Collection permission_id
     * @property Grid\Column|Collection menu_id
     * @property Grid\Column|Collection slug
     * @property Grid\Column|Collection http_method
     * @property Grid\Column|Collection http_path
     * @property Grid\Column|Collection role_id
     * @property Grid\Column|Collection user_id
     * @property Grid\Column|Collection value
     * @property Grid\Column|Collection username
     * @property Grid\Column|Collection password
     * @property Grid\Column|Collection avatar
     * @property Grid\Column|Collection remember_token
     * @property Grid\Column|Collection uuid
     * @property Grid\Column|Collection connection
     * @property Grid\Column|Collection queue
     * @property Grid\Column|Collection payload
     * @property Grid\Column|Collection exception
     * @property Grid\Column|Collection failed_at
     * @property Grid\Column|Collection img_url
     * @property Grid\Column|Collection price
     * @property Grid\Column|Collection start_time
     * @property Grid\Column|Collection end_time
     * @property Grid\Column|Collection status
     * @property Grid\Column|Collection kt_status
     * @property Grid\Column|Collection sort
     * @property Grid\Column|Collection activity_id
     * @property Grid\Column|Collection activity_name
     * @property Grid\Column|Collection activity_end_time
     * @property Grid\Column|Collection synthetic_id
     * @property Grid\Column|Collection member_id
     * @property Grid\Column|Collection product_no
     * @property Grid\Column|Collection url
     * @property Grid\Column|Collection mobile
     * @property Grid\Column|Collection realname
     * @property Grid\Column|Collection first_consume
     * @property Grid\Column|Collection chip_num
     * @property Grid\Column|Collection upper_id
     * @property Grid\Column|Collection birthday
     * @property Grid\Column|Collection address_id
     * @property Grid\Column|Collection last_login
     * @property Grid\Column|Collection login_num
     * @property Grid\Column|Collection last_ip
     * @property Grid\Column|Collection level_id
     * @property Grid\Column|Collection token
     * @property Grid\Column|Collection promo_code
     * @property Grid\Column|Collection create_time
     * @property Grid\Column|Collection update_time
     * @property Grid\Column|Collection delete_time
     * @property Grid\Column|Collection rate
     * @property Grid\Column|Collection chip_total
     * @property Grid\Column|Collection merchant_id
     * @property Grid\Column|Collection money_before
     * @property Grid\Column|Collection money_now
     * @property Grid\Column|Collection money_change
     * @property Grid\Column|Collection money_all
     * @property Grid\Column|Collection money_consume
     * @property Grid\Column|Collection money_frozen
     * @property Grid\Column|Collection province_id
     * @property Grid\Column|Collection city_id
     * @property Grid\Column|Collection area_id
     * @property Grid\Column|Collection district_id
     * @property Grid\Column|Collection address_name
     * @property Grid\Column|Collection address_details
     * @property Grid\Column|Collection is_default
     * @property Grid\Column|Collection zip_code
     * @property Grid\Column|Collection consignee
     * @property Grid\Column|Collection home_phone
     * @property Grid\Column|Collection rules
     * @property Grid\Column|Collection amount
     * @property Grid\Column|Collection discount
     * @property Grid\Column|Collection thumb
     * @property Grid\Column|Collection invite_member_id
     * @property Grid\Column|Collection order_id
     * @property Grid\Column|Collection rate_price
     * @property Grid\Column|Collection cur_price
     * @property Grid\Column|Collection client_id
     * @property Grid\Column|Collection refresh_token
     * @property Grid\Column|Collection access_token
     * @property Grid\Column|Collection expires_time
     * @property Grid\Column|Collection refresh_expires_time
     * @property Grid\Column|Collection openid
     * @property Grid\Column|Collection tablename
     * @property Grid\Column|Collection group
     * @property Grid\Column|Collection order_no
     * @property Grid\Column|Collection actual_price
     * @property Grid\Column|Collection channel
     * @property Grid\Column|Collection payment_time
     * @property Grid\Column|Collection pid
     * @property Grid\Column|Collection short_name
     * @property Grid\Column|Collection areacode
     * @property Grid\Column|Collection zipcode
     * @property Grid\Column|Collection pinyin
     * @property Grid\Column|Collection lng
     * @property Grid\Column|Collection lat
     * @property Grid\Column|Collection level
     * @property Grid\Column|Collection need_chip_num
     * @property Grid\Column|Collection synthetic_status
     * @property Grid\Column|Collection out_member_id
     * @property Grid\Column|Collection out_name
     * @property Grid\Column|Collection out_mobile
     * @property Grid\Column|Collection in_member_id
     * @property Grid\Column|Collection in_name
     * @property Grid\Column|Collection in_mobile
     * @property Grid\Column|Collection product_id
     * @property Grid\Column|Collection product_name
     * @property Grid\Column|Collection apply_name
     * @property Grid\Column|Collection apply_mobile
     * @property Grid\Column|Collection apply_price
     * @property Grid\Column|Collection account
     * @property Grid\Column|Collection expires
     * @property Grid\Column|Collection scope
     * @property Grid\Column|Collection authorization_code
     * @property Grid\Column|Collection redirect_uri
     * @property Grid\Column|Collection id_token
     * @property Grid\Column|Collection client_secret
     * @property Grid\Column|Collection grant_types
     * @property Grid\Column|Collection subject
     * @property Grid\Column|Collection public_key
     * @property Grid\Column|Collection first_name
     * @property Grid\Column|Collection last_name
     * @property Grid\Column|Collection email
     * @property Grid\Column|Collection email_verified
     *
     * @method Grid\Column|Collection id(string $label = null)
     * @method Grid\Column|Collection name(string $label = null)
     * @method Grid\Column|Collection type(string $label = null)
     * @method Grid\Column|Collection version(string $label = null)
     * @method Grid\Column|Collection detail(string $label = null)
     * @method Grid\Column|Collection created_at(string $label = null)
     * @method Grid\Column|Collection updated_at(string $label = null)
     * @method Grid\Column|Collection is_enabled(string $label = null)
     * @method Grid\Column|Collection parent_id(string $label = null)
     * @method Grid\Column|Collection order(string $label = null)
     * @method Grid\Column|Collection icon(string $label = null)
     * @method Grid\Column|Collection uri(string $label = null)
     * @method Grid\Column|Collection extension(string $label = null)
     * @method Grid\Column|Collection permission_id(string $label = null)
     * @method Grid\Column|Collection menu_id(string $label = null)
     * @method Grid\Column|Collection slug(string $label = null)
     * @method Grid\Column|Collection http_method(string $label = null)
     * @method Grid\Column|Collection http_path(string $label = null)
     * @method Grid\Column|Collection role_id(string $label = null)
     * @method Grid\Column|Collection user_id(string $label = null)
     * @method Grid\Column|Collection value(string $label = null)
     * @method Grid\Column|Collection username(string $label = null)
     * @method Grid\Column|Collection password(string $label = null)
     * @method Grid\Column|Collection avatar(string $label = null)
     * @method Grid\Column|Collection remember_token(string $label = null)
     * @method Grid\Column|Collection uuid(string $label = null)
     * @method Grid\Column|Collection connection(string $label = null)
     * @method Grid\Column|Collection queue(string $label = null)
     * @method Grid\Column|Collection payload(string $label = null)
     * @method Grid\Column|Collection exception(string $label = null)
     * @method Grid\Column|Collection failed_at(string $label = null)
     * @method Grid\Column|Collection img_url(string $label = null)
     * @method Grid\Column|Collection price(string $label = null)
     * @method Grid\Column|Collection start_time(string $label = null)
     * @method Grid\Column|Collection end_time(string $label = null)
     * @method Grid\Column|Collection status(string $label = null)
     * @method Grid\Column|Collection kt_status(string $label = null)
     * @method Grid\Column|Collection sort(string $label = null)
     * @method Grid\Column|Collection activity_id(string $label = null)
     * @method Grid\Column|Collection activity_name(string $label = null)
     * @method Grid\Column|Collection activity_end_time(string $label = null)
     * @method Grid\Column|Collection synthetic_id(string $label = null)
     * @method Grid\Column|Collection member_id(string $label = null)
     * @method Grid\Column|Collection product_no(string $label = null)
     * @method Grid\Column|Collection url(string $label = null)
     * @method Grid\Column|Collection mobile(string $label = null)
     * @method Grid\Column|Collection realname(string $label = null)
     * @method Grid\Column|Collection first_consume(string $label = null)
     * @method Grid\Column|Collection chip_num(string $label = null)
     * @method Grid\Column|Collection upper_id(string $label = null)
     * @method Grid\Column|Collection birthday(string $label = null)
     * @method Grid\Column|Collection address_id(string $label = null)
     * @method Grid\Column|Collection last_login(string $label = null)
     * @method Grid\Column|Collection login_num(string $label = null)
     * @method Grid\Column|Collection last_ip(string $label = null)
     * @method Grid\Column|Collection level_id(string $label = null)
     * @method Grid\Column|Collection token(string $label = null)
     * @method Grid\Column|Collection promo_code(string $label = null)
     * @method Grid\Column|Collection create_time(string $label = null)
     * @method Grid\Column|Collection update_time(string $label = null)
     * @method Grid\Column|Collection delete_time(string $label = null)
     * @method Grid\Column|Collection rate(string $label = null)
     * @method Grid\Column|Collection chip_total(string $label = null)
     * @method Grid\Column|Collection merchant_id(string $label = null)
     * @method Grid\Column|Collection money_before(string $label = null)
     * @method Grid\Column|Collection money_now(string $label = null)
     * @method Grid\Column|Collection money_change(string $label = null)
     * @method Grid\Column|Collection money_all(string $label = null)
     * @method Grid\Column|Collection money_consume(string $label = null)
     * @method Grid\Column|Collection money_frozen(string $label = null)
     * @method Grid\Column|Collection province_id(string $label = null)
     * @method Grid\Column|Collection city_id(string $label = null)
     * @method Grid\Column|Collection area_id(string $label = null)
     * @method Grid\Column|Collection district_id(string $label = null)
     * @method Grid\Column|Collection address_name(string $label = null)
     * @method Grid\Column|Collection address_details(string $label = null)
     * @method Grid\Column|Collection is_default(string $label = null)
     * @method Grid\Column|Collection zip_code(string $label = null)
     * @method Grid\Column|Collection consignee(string $label = null)
     * @method Grid\Column|Collection home_phone(string $label = null)
     * @method Grid\Column|Collection rules(string $label = null)
     * @method Grid\Column|Collection amount(string $label = null)
     * @method Grid\Column|Collection discount(string $label = null)
     * @method Grid\Column|Collection thumb(string $label = null)
     * @method Grid\Column|Collection invite_member_id(string $label = null)
     * @method Grid\Column|Collection order_id(string $label = null)
     * @method Grid\Column|Collection rate_price(string $label = null)
     * @method Grid\Column|Collection cur_price(string $label = null)
     * @method Grid\Column|Collection client_id(string $label = null)
     * @method Grid\Column|Collection refresh_token(string $label = null)
     * @method Grid\Column|Collection access_token(string $label = null)
     * @method Grid\Column|Collection expires_time(string $label = null)
     * @method Grid\Column|Collection refresh_expires_time(string $label = null)
     * @method Grid\Column|Collection openid(string $label = null)
     * @method Grid\Column|Collection tablename(string $label = null)
     * @method Grid\Column|Collection group(string $label = null)
     * @method Grid\Column|Collection order_no(string $label = null)
     * @method Grid\Column|Collection actual_price(string $label = null)
     * @method Grid\Column|Collection channel(string $label = null)
     * @method Grid\Column|Collection payment_time(string $label = null)
     * @method Grid\Column|Collection pid(string $label = null)
     * @method Grid\Column|Collection short_name(string $label = null)
     * @method Grid\Column|Collection areacode(string $label = null)
     * @method Grid\Column|Collection zipcode(string $label = null)
     * @method Grid\Column|Collection pinyin(string $label = null)
     * @method Grid\Column|Collection lng(string $label = null)
     * @method Grid\Column|Collection lat(string $label = null)
     * @method Grid\Column|Collection level(string $label = null)
     * @method Grid\Column|Collection need_chip_num(string $label = null)
     * @method Grid\Column|Collection synthetic_status(string $label = null)
     * @method Grid\Column|Collection out_member_id(string $label = null)
     * @method Grid\Column|Collection out_name(string $label = null)
     * @method Grid\Column|Collection out_mobile(string $label = null)
     * @method Grid\Column|Collection in_member_id(string $label = null)
     * @method Grid\Column|Collection in_name(string $label = null)
     * @method Grid\Column|Collection in_mobile(string $label = null)
     * @method Grid\Column|Collection product_id(string $label = null)
     * @method Grid\Column|Collection product_name(string $label = null)
     * @method Grid\Column|Collection apply_name(string $label = null)
     * @method Grid\Column|Collection apply_mobile(string $label = null)
     * @method Grid\Column|Collection apply_price(string $label = null)
     * @method Grid\Column|Collection account(string $label = null)
     * @method Grid\Column|Collection expires(string $label = null)
     * @method Grid\Column|Collection scope(string $label = null)
     * @method Grid\Column|Collection authorization_code(string $label = null)
     * @method Grid\Column|Collection redirect_uri(string $label = null)
     * @method Grid\Column|Collection id_token(string $label = null)
     * @method Grid\Column|Collection client_secret(string $label = null)
     * @method Grid\Column|Collection grant_types(string $label = null)
     * @method Grid\Column|Collection subject(string $label = null)
     * @method Grid\Column|Collection public_key(string $label = null)
     * @method Grid\Column|Collection first_name(string $label = null)
     * @method Grid\Column|Collection last_name(string $label = null)
     * @method Grid\Column|Collection email(string $label = null)
     * @method Grid\Column|Collection email_verified(string $label = null)
     */
    class Grid {}

    class MiniGrid extends Grid {}

    /**
     * @property Show\Field|Collection id
     * @property Show\Field|Collection name
     * @property Show\Field|Collection type
     * @property Show\Field|Collection version
     * @property Show\Field|Collection detail
     * @property Show\Field|Collection created_at
     * @property Show\Field|Collection updated_at
     * @property Show\Field|Collection is_enabled
     * @property Show\Field|Collection parent_id
     * @property Show\Field|Collection order
     * @property Show\Field|Collection icon
     * @property Show\Field|Collection uri
     * @property Show\Field|Collection extension
     * @property Show\Field|Collection permission_id
     * @property Show\Field|Collection menu_id
     * @property Show\Field|Collection slug
     * @property Show\Field|Collection http_method
     * @property Show\Field|Collection http_path
     * @property Show\Field|Collection role_id
     * @property Show\Field|Collection user_id
     * @property Show\Field|Collection value
     * @property Show\Field|Collection username
     * @property Show\Field|Collection password
     * @property Show\Field|Collection avatar
     * @property Show\Field|Collection remember_token
     * @property Show\Field|Collection uuid
     * @property Show\Field|Collection connection
     * @property Show\Field|Collection queue
     * @property Show\Field|Collection payload
     * @property Show\Field|Collection exception
     * @property Show\Field|Collection failed_at
     * @property Show\Field|Collection img_url
     * @property Show\Field|Collection price
     * @property Show\Field|Collection start_time
     * @property Show\Field|Collection end_time
     * @property Show\Field|Collection status
     * @property Show\Field|Collection kt_status
     * @property Show\Field|Collection sort
     * @property Show\Field|Collection activity_id
     * @property Show\Field|Collection activity_name
     * @property Show\Field|Collection activity_end_time
     * @property Show\Field|Collection synthetic_id
     * @property Show\Field|Collection member_id
     * @property Show\Field|Collection product_no
     * @property Show\Field|Collection url
     * @property Show\Field|Collection mobile
     * @property Show\Field|Collection realname
     * @property Show\Field|Collection first_consume
     * @property Show\Field|Collection chip_num
     * @property Show\Field|Collection upper_id
     * @property Show\Field|Collection birthday
     * @property Show\Field|Collection address_id
     * @property Show\Field|Collection last_login
     * @property Show\Field|Collection login_num
     * @property Show\Field|Collection last_ip
     * @property Show\Field|Collection level_id
     * @property Show\Field|Collection token
     * @property Show\Field|Collection promo_code
     * @property Show\Field|Collection create_time
     * @property Show\Field|Collection update_time
     * @property Show\Field|Collection delete_time
     * @property Show\Field|Collection rate
     * @property Show\Field|Collection chip_total
     * @property Show\Field|Collection merchant_id
     * @property Show\Field|Collection money_before
     * @property Show\Field|Collection money_now
     * @property Show\Field|Collection money_change
     * @property Show\Field|Collection money_all
     * @property Show\Field|Collection money_consume
     * @property Show\Field|Collection money_frozen
     * @property Show\Field|Collection province_id
     * @property Show\Field|Collection city_id
     * @property Show\Field|Collection area_id
     * @property Show\Field|Collection district_id
     * @property Show\Field|Collection address_name
     * @property Show\Field|Collection address_details
     * @property Show\Field|Collection is_default
     * @property Show\Field|Collection zip_code
     * @property Show\Field|Collection consignee
     * @property Show\Field|Collection home_phone
     * @property Show\Field|Collection rules
     * @property Show\Field|Collection amount
     * @property Show\Field|Collection discount
     * @property Show\Field|Collection thumb
     * @property Show\Field|Collection invite_member_id
     * @property Show\Field|Collection order_id
     * @property Show\Field|Collection rate_price
     * @property Show\Field|Collection cur_price
     * @property Show\Field|Collection client_id
     * @property Show\Field|Collection refresh_token
     * @property Show\Field|Collection access_token
     * @property Show\Field|Collection expires_time
     * @property Show\Field|Collection refresh_expires_time
     * @property Show\Field|Collection openid
     * @property Show\Field|Collection tablename
     * @property Show\Field|Collection group
     * @property Show\Field|Collection order_no
     * @property Show\Field|Collection actual_price
     * @property Show\Field|Collection channel
     * @property Show\Field|Collection payment_time
     * @property Show\Field|Collection pid
     * @property Show\Field|Collection short_name
     * @property Show\Field|Collection areacode
     * @property Show\Field|Collection zipcode
     * @property Show\Field|Collection pinyin
     * @property Show\Field|Collection lng
     * @property Show\Field|Collection lat
     * @property Show\Field|Collection level
     * @property Show\Field|Collection need_chip_num
     * @property Show\Field|Collection synthetic_status
     * @property Show\Field|Collection out_member_id
     * @property Show\Field|Collection out_name
     * @property Show\Field|Collection out_mobile
     * @property Show\Field|Collection in_member_id
     * @property Show\Field|Collection in_name
     * @property Show\Field|Collection in_mobile
     * @property Show\Field|Collection product_id
     * @property Show\Field|Collection product_name
     * @property Show\Field|Collection apply_name
     * @property Show\Field|Collection apply_mobile
     * @property Show\Field|Collection apply_price
     * @property Show\Field|Collection account
     * @property Show\Field|Collection expires
     * @property Show\Field|Collection scope
     * @property Show\Field|Collection authorization_code
     * @property Show\Field|Collection redirect_uri
     * @property Show\Field|Collection id_token
     * @property Show\Field|Collection client_secret
     * @property Show\Field|Collection grant_types
     * @property Show\Field|Collection subject
     * @property Show\Field|Collection public_key
     * @property Show\Field|Collection first_name
     * @property Show\Field|Collection last_name
     * @property Show\Field|Collection email
     * @property Show\Field|Collection email_verified
     *
     * @method Show\Field|Collection id(string $label = null)
     * @method Show\Field|Collection name(string $label = null)
     * @method Show\Field|Collection type(string $label = null)
     * @method Show\Field|Collection version(string $label = null)
     * @method Show\Field|Collection detail(string $label = null)
     * @method Show\Field|Collection created_at(string $label = null)
     * @method Show\Field|Collection updated_at(string $label = null)
     * @method Show\Field|Collection is_enabled(string $label = null)
     * @method Show\Field|Collection parent_id(string $label = null)
     * @method Show\Field|Collection order(string $label = null)
     * @method Show\Field|Collection icon(string $label = null)
     * @method Show\Field|Collection uri(string $label = null)
     * @method Show\Field|Collection extension(string $label = null)
     * @method Show\Field|Collection permission_id(string $label = null)
     * @method Show\Field|Collection menu_id(string $label = null)
     * @method Show\Field|Collection slug(string $label = null)
     * @method Show\Field|Collection http_method(string $label = null)
     * @method Show\Field|Collection http_path(string $label = null)
     * @method Show\Field|Collection role_id(string $label = null)
     * @method Show\Field|Collection user_id(string $label = null)
     * @method Show\Field|Collection value(string $label = null)
     * @method Show\Field|Collection username(string $label = null)
     * @method Show\Field|Collection password(string $label = null)
     * @method Show\Field|Collection avatar(string $label = null)
     * @method Show\Field|Collection remember_token(string $label = null)
     * @method Show\Field|Collection uuid(string $label = null)
     * @method Show\Field|Collection connection(string $label = null)
     * @method Show\Field|Collection queue(string $label = null)
     * @method Show\Field|Collection payload(string $label = null)
     * @method Show\Field|Collection exception(string $label = null)
     * @method Show\Field|Collection failed_at(string $label = null)
     * @method Show\Field|Collection img_url(string $label = null)
     * @method Show\Field|Collection price(string $label = null)
     * @method Show\Field|Collection start_time(string $label = null)
     * @method Show\Field|Collection end_time(string $label = null)
     * @method Show\Field|Collection status(string $label = null)
     * @method Show\Field|Collection kt_status(string $label = null)
     * @method Show\Field|Collection sort(string $label = null)
     * @method Show\Field|Collection activity_id(string $label = null)
     * @method Show\Field|Collection activity_name(string $label = null)
     * @method Show\Field|Collection activity_end_time(string $label = null)
     * @method Show\Field|Collection synthetic_id(string $label = null)
     * @method Show\Field|Collection member_id(string $label = null)
     * @method Show\Field|Collection product_no(string $label = null)
     * @method Show\Field|Collection url(string $label = null)
     * @method Show\Field|Collection mobile(string $label = null)
     * @method Show\Field|Collection realname(string $label = null)
     * @method Show\Field|Collection first_consume(string $label = null)
     * @method Show\Field|Collection chip_num(string $label = null)
     * @method Show\Field|Collection upper_id(string $label = null)
     * @method Show\Field|Collection birthday(string $label = null)
     * @method Show\Field|Collection address_id(string $label = null)
     * @method Show\Field|Collection last_login(string $label = null)
     * @method Show\Field|Collection login_num(string $label = null)
     * @method Show\Field|Collection last_ip(string $label = null)
     * @method Show\Field|Collection level_id(string $label = null)
     * @method Show\Field|Collection token(string $label = null)
     * @method Show\Field|Collection promo_code(string $label = null)
     * @method Show\Field|Collection create_time(string $label = null)
     * @method Show\Field|Collection update_time(string $label = null)
     * @method Show\Field|Collection delete_time(string $label = null)
     * @method Show\Field|Collection rate(string $label = null)
     * @method Show\Field|Collection chip_total(string $label = null)
     * @method Show\Field|Collection merchant_id(string $label = null)
     * @method Show\Field|Collection money_before(string $label = null)
     * @method Show\Field|Collection money_now(string $label = null)
     * @method Show\Field|Collection money_change(string $label = null)
     * @method Show\Field|Collection money_all(string $label = null)
     * @method Show\Field|Collection money_consume(string $label = null)
     * @method Show\Field|Collection money_frozen(string $label = null)
     * @method Show\Field|Collection province_id(string $label = null)
     * @method Show\Field|Collection city_id(string $label = null)
     * @method Show\Field|Collection area_id(string $label = null)
     * @method Show\Field|Collection district_id(string $label = null)
     * @method Show\Field|Collection address_name(string $label = null)
     * @method Show\Field|Collection address_details(string $label = null)
     * @method Show\Field|Collection is_default(string $label = null)
     * @method Show\Field|Collection zip_code(string $label = null)
     * @method Show\Field|Collection consignee(string $label = null)
     * @method Show\Field|Collection home_phone(string $label = null)
     * @method Show\Field|Collection rules(string $label = null)
     * @method Show\Field|Collection amount(string $label = null)
     * @method Show\Field|Collection discount(string $label = null)
     * @method Show\Field|Collection thumb(string $label = null)
     * @method Show\Field|Collection invite_member_id(string $label = null)
     * @method Show\Field|Collection order_id(string $label = null)
     * @method Show\Field|Collection rate_price(string $label = null)
     * @method Show\Field|Collection cur_price(string $label = null)
     * @method Show\Field|Collection client_id(string $label = null)
     * @method Show\Field|Collection refresh_token(string $label = null)
     * @method Show\Field|Collection access_token(string $label = null)
     * @method Show\Field|Collection expires_time(string $label = null)
     * @method Show\Field|Collection refresh_expires_time(string $label = null)
     * @method Show\Field|Collection openid(string $label = null)
     * @method Show\Field|Collection tablename(string $label = null)
     * @method Show\Field|Collection group(string $label = null)
     * @method Show\Field|Collection order_no(string $label = null)
     * @method Show\Field|Collection actual_price(string $label = null)
     * @method Show\Field|Collection channel(string $label = null)
     * @method Show\Field|Collection payment_time(string $label = null)
     * @method Show\Field|Collection pid(string $label = null)
     * @method Show\Field|Collection short_name(string $label = null)
     * @method Show\Field|Collection areacode(string $label = null)
     * @method Show\Field|Collection zipcode(string $label = null)
     * @method Show\Field|Collection pinyin(string $label = null)
     * @method Show\Field|Collection lng(string $label = null)
     * @method Show\Field|Collection lat(string $label = null)
     * @method Show\Field|Collection level(string $label = null)
     * @method Show\Field|Collection need_chip_num(string $label = null)
     * @method Show\Field|Collection synthetic_status(string $label = null)
     * @method Show\Field|Collection out_member_id(string $label = null)
     * @method Show\Field|Collection out_name(string $label = null)
     * @method Show\Field|Collection out_mobile(string $label = null)
     * @method Show\Field|Collection in_member_id(string $label = null)
     * @method Show\Field|Collection in_name(string $label = null)
     * @method Show\Field|Collection in_mobile(string $label = null)
     * @method Show\Field|Collection product_id(string $label = null)
     * @method Show\Field|Collection product_name(string $label = null)
     * @method Show\Field|Collection apply_name(string $label = null)
     * @method Show\Field|Collection apply_mobile(string $label = null)
     * @method Show\Field|Collection apply_price(string $label = null)
     * @method Show\Field|Collection account(string $label = null)
     * @method Show\Field|Collection expires(string $label = null)
     * @method Show\Field|Collection scope(string $label = null)
     * @method Show\Field|Collection authorization_code(string $label = null)
     * @method Show\Field|Collection redirect_uri(string $label = null)
     * @method Show\Field|Collection id_token(string $label = null)
     * @method Show\Field|Collection client_secret(string $label = null)
     * @method Show\Field|Collection grant_types(string $label = null)
     * @method Show\Field|Collection subject(string $label = null)
     * @method Show\Field|Collection public_key(string $label = null)
     * @method Show\Field|Collection first_name(string $label = null)
     * @method Show\Field|Collection last_name(string $label = null)
     * @method Show\Field|Collection email(string $label = null)
     * @method Show\Field|Collection email_verified(string $label = null)
     */
    class Show {}

    /**
     
     */
    class Form {}

}

namespace Dcat\Admin\Grid {
    /**
     
     */
    class Column {}

    /**
     
     */
    class Filter {}
}

namespace Dcat\Admin\Show {
    /**
     
     */
    class Field {}
}
