[[!UpdateProfile? &submitVar=`login-updprof` &useExtended=`1` &postHooks=`SetDoB` &allowedExtendedFields=`discount_card` &validate=`fullname:required, email:required:email` &errTpl=`error`]]
[[!UpdateProfile? &submitVar=`login-updprof-get` &useExtended=`1` &allowedExtendedFields=`get_news_by_email,get_news_by_sms` &postHooks=`hookNewsletters`]]
<h1 class="newh">
  Личный кабинет
  <a class="logout" href="[[~1? &service=`logout`]]">Выйти</a>
</h1>

<div class="tabs_wrapper cab_content">

  <div class="cab_buttons buttons">
    <a class="tab_button [[!ifGet? &name=`profile` &yes=`active` &no=``]]">Персональные данные</a>
    <a class="tab_button [[!ifGet? &name=`orders` &yes=`active` &no=``]]">Мои заказы</a>
    <a class="tab_button [[!ifGet? &name=`subscribe` &yes=`active` &no=``]]">Подписки</a>
    <a class="tab_button [[!ifGet? &name=`favourite` &yes=`active` &no=``]]">Избранное</a>
  </div>

  <div class="tab" [[!ifGet? &name=`profile` &yes=`` &no=`style="display:none;"`]]>
    <div class="personal">

      <div class="error">[[+error.message]]</div>
      <div class="error">[[!+cp.error_message]]</div>
      [[+login.update_success:is=`1`:then=`<p class="success">[[%login.profile_updated? &namespace=`login` &topic=`updateprofile`]]</p>`]]
      [[!+cp.successMessage]]
      <form class="personal_form" action="[[~[[*id]]]]" method="post">
        <input type="hidden" name="nospam" value="" />
        <div class="form-row">
          <label>ФИО</label>
          <input type="text" name="fullname" id="fullname" value="[[+fullname]]" class="[[+error.fullname]]">
        </div>
        <div class="form-row">

          <label>Мобильный телефон</label>
          <input type="text" name="phone" id="phone" value="[[+phone]]" class="[[+error.phone]] maskphone">
        </div>
        <div class="form-row">
          <input type="checkbox" class="filled-in" id="get_news_by_sms" name="get_news_by_sms" value="Y">
          <label class="checkbox_label" for="get_news_by_sms">Подписаться на sms рассылку</label>
        </div>

        <div class="form-row">
          <label>Электронная почта</label>
          <input type="text" name="email" id="email" value="[[+email]]" class="[[+error.email]]">
        </div>
        <div class="form-row">
          <input type="checkbox" class="filled-in" id="get_news_by_email" name="get_news_by_email" value="Y">
          <label class="checkbox_label" for="get_news_by_email">Подписаться на новости и скидки</label>
        </div>

        <div class="form-row">
          <label>Пол</label>
          <div class="gender-label">
            <input type="radio" id="radio-man" name="gender" value="1" [[+gender:is=`1`:then=`checked`]]>
            <label class="radio" for="radio-man">Мужской</label>
            <input type="radio" id="radio-woman" name="gender" value="2" [[+gender:is=`2`:then=`checked`]]>
            <label class="radio" for="radio-woman">Женский</label>
          </div>
        </div>


        <div class="form-row birthday-row">
          <label>Дата рождения</label><br>
          <div class="newdrop">
            <select id="dat" name="birthday-day">
              [[!dates? &date=`[[+dob:date=`%d`]]` &type=`day`]]
            </select>
          </div>

          <div class="newdrop">
            <select id="mon" class="birthday-month" name="birthday-month">
              [[!dates? &date=`[[+dob:date=`%m`]]` &type=`month`]]
            </select>
          </div>

          <div class="newdrop">
            <select id="year" class="birthday-year" name="birthday-year">
              [[!dates? &date=`[[+dob:date=`%Y`]]` &type=`year`]]
            </select>
          </div>

        </div>

        <div class="form-row">
          <label>Номер дисконтной карты</label>
          <input type="text" name="discount_card" value="[[+discount_card]]">
        </div>

        <div class="form_change_passblock" id="form_change_passblock">
          <a class="change_pass" id="change_pass">Изменить пароль</a>
        </div>

        <div class="password_block" style="display:none;" id="password_block">
          <div class="form_subhead">
            <span class="form_subhead_head">Смена пароля</span>
            <a class="form_subhead_cancel" id="form_subhead_cancel">Отмена</a>
            <div class="clearfix"></div>
          </div>


          [[!ChangePassword?
          &submitVar=`change-password`
          &placeholderPrefix=`cp.`
          &validateOldPassword=`1`
          &validate=`nospam:blank` &reloadOnSuccess=`0` &successMessage=`<p class="success">Пароль успешно изменен</p>`
          ]]

          <form class="form" action="[[~[[*id]]`]]" method="post">
            <input type="hidden" name="nospam" value="" />
            <div class="form-row">
              <label>Старый пароль</label>
              <input type="password" name="password_old" id="password_old" value="[[+cp.password_old]]" />
            </div>
            <div class="form-row">
              <label>Новый пароль</label>
              <input type="password" name="password_new" id="password_new" value="[[+cp.password_new]]" />
            </div>
            <div class="form-row">
              <label>Повторите пароль</label>
              <input type="password" name="password_new_confirm" id="password_new_confirm" value="[[+cp.password_new_confirm]]" />
            </div>
            <div class="form_buttons_block">
              <input type="submit" name="change-password" value="Изменить пароль" class="personal_form_submit bblackbutton" style="max-width:340px;">
            </div>
        </div>

        [[!HybridAuth? providers=`Facebook,Twitter,Vkontakte,Yandex` &groups=`Users` &logoutTpl=`default.tpl.HybridAuth.logout`]]

        <div class="form_buttons_block">
          <a href="javascript:void(0);" class="whitebutton bbtn">Отмена</a>
          <input type="submit" class="personal_form_submit bblackbutton bbtn" name="login-updprof">
        </div>
      </form>
    </div>

  </div>


  <div class="tab" [[!ifGet? &name=`orders` &yes=`` &no=`style="display:none;"`]]>
    <div class="orders">

      <div class="order_table">
        [[!listOrders]]
      </div>

    </div>
  </div>


  <div class="tab" [[!ifGet? &name=`subscribe` &yes=`` &no=`style="display:none;"`]]>
    <div class="personal subscribe">
      <form class="personal_form" action="[[~[[*id]]]]" method="post">
        <input type="hidden" name="nospam" value="" />
        <input type="hidden" name="fullname" id="fullname" value="[[+fullname]]">
        <input type="hidden" name="email" id="email" value="[[+email]]">

        <input type="hidden" name="get_news_by_email" value="[[+get_news_by_email:default=`N`]]" id="val_get_news_by_email">
        <input type="hidden" name="get_news_by_sms" value="[[+get_news_by_sms:default=`N`]]" id="val_get_news_by_sms">

        <div class="form_change_passblock">
          <span class="fz13">Мне удобно получать новости и скидки:</span>
        </div>

        <div class="form-row checkbox_row">
          <input type="checkbox" class="filled-in" id="get_news_by_email" [[+get_news_by_email:is=`Y`:then=`checked`]]>
          <label class="checkbox_label" for="get_news_by_email">По электронной почте</label>
        </div>




        <div class="form-row sms_row checkbox_row">
          <input type="checkbox" class="filled-in" id="get_news_by_sms" [[+get_news_by_sms:is=`Y`:then=`checked`]]>
          <label for="get_news_by_sms" class="checkbox_label">С помощью SMS</label>
        </div>

        <div class="form_buttons_block">
          <a href="javascript:void(0);" class="whitebutton bbtn">Отмена</a>
          <input type="submit" class="personal_form_submit bblackbutton bbtn" name="login-updprof-get">
        </div>
      </form>
    </div>
  </div>


  <div class="tab" [[!ifGet? &name=`favourite` &yes=`` &no=`style="display:none;"`]]>
    <div class="favorite">
      [[!Favourite]]
    </div>
  </div>

</div>
