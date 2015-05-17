<!DOCTYPE html>
<html>

<head>

  <meta charset="UTF-8">

  <title>نظر دهی</title>

  <link href="<?php echo asset_url()?>css/css" rel='stylesheet' type='text/css'>

  <link rel="stylesheet" href="<?php echo asset_url()?>css/normalize.css" >

    <link rel="stylesheet" href="<?php echo asset_url()?>css/style.css" media="screen" type="text/css" />

</head>

<body>

 <div class="form">

	<font size="4" color="blue">	<?php if(isset($message)) echo $message ?></font>
      <ul class="tab-group">
        <li class="tab active"><a href="#signup">ثبت نام</a></li>
        <li class="tab"><a href="#login">ورود</a></li>
      </ul>
      <div class="tab-content">
        <div id="signup">   
          <h1>ثبت نام</h1>

		
          <form action="<?php echo site_url('user/registerUserMail'); ?>" method="post">

          <div class="field-wrap">
            <label style="width: 90%; text-align: center;">
              پست الکترونیکی<span class="req"></span>
            </label>
            <input type="email"required autocomplete="off" name="email"style="text-align: center;"/>
          </div>
         
	 <div class="req">
            <div class="field-wrap ">
              <label style="width: 90%; text-align: center;">
                نام و نام خانوادگی<span class="req"></span>
              </label>
              <input type="text" required autocomplete="on" name="name" style="text-align: center;"/>
            </div>
          </div>

            <div class="field-wrap">
              <div class "field-wrap date"> 
                <label style="width: 90%; text-align: center;">
                  شماره دانشجویی<span class="req "></span>
                </label style="width: 90%;">
                <input type="number" required autocomplete="off" name="s_number"style="text-align: center; direction: rtl;"/>
              </div>
            </div>
    
		<div class ="field-wrap date" style="text-align: right; direction: rtl; color: #a0b3b0; font-size: 22px;">  گروه 
		<select name="group" id="group" style="color:  #1ab188;">
                        <option value="1" >1</option>
                        <option value="2">2</option>
                    </select>
	
	 جنسیت 
		<select name="gender" id="gender" style="color:  #1ab188;">
                        <option value="آقا" >آقا</option>
                        <option value="خانم">خانم</option>
                    </select>
		</div>

          <div class="field-wrap">
            <label style="width: 90%; text-align: center;">
              رمز عبور<span class="req">*</span>
            </label>
            <input type="password" required autocomplete="off"  name="password"style="text-align: center;"/>
          </div>
          
        <div class="field-wrap">
            <label style="width: 90%; text-align: center;">
              تکرار رمز عبور<span class="req">*</span>
            </label style="width: 90%;">
            <input type="password" required autocomplete="off" name=
"re-password" style="text-align: center;"/>
          </div>
		
	<div class ="field-wrap date" style="text-align: right; direction: rtl; color: #a0b3b0; font-size: 22px;">
<label for='desc' style="display:inline-table;width: 90%; direction: rtl; text-align: right;">توضیحات</label>
		<textarea rows="2" id="desc" name="description"></textarea> 
	</div>

          <button type="submit" class="button button-block"/>ثبت</button>

          </form>

        </div>

        <div id="login">   
          <h1>وارد شوید</h1>

          <form action="<?php echo site_url('user/login'); ?>" method="post">

            <div class="field-wrap">
            <label style="width: 90%; text-align: center;">
              پست الکترونیکی<span class="req">*</span>
            </label>
            <input name="email" type="email"required autocomplete="off"style="text-align: center;"/>
          </div>

          <div class="field-wrap">
            <label style="width: 90%; text-align: center;">
              رمز ورود<span class="req">*</span>
            </label>
            <input name="password" type="password"required autocomplete="off"style="text-align: center;"/>
          </div>


          <!-- <div class="field-wrap">
            <label style="width: 90%;">
              عبارت موجود در کادر<span class="req">*</span>
            </label>
            <input type="text"required autocomplete="off" name="captcha"style="text-align: right;"/>
          </div> -->

          <button class="button button-block"/>ورود</button>

          </form>

        </div>

      </div><!-- tab-content -->

</div> <!-- /form -->

  <script src="<?php echo asset_url()?>js/jquery.js"></script>

  <script src="<?php echo asset_url()?>js/index.js"></script>

</body>

</html>
