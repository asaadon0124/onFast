<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>On Fast</title>
    <style>

        @import url('https://fonts.googleapis.com/css2?family=Cairo&display=swap');

        body{
            font-family: 'Cairo', sans-serif;
            height: 100%;
             direction: rtl;
            margin: 0;
            padding: 0;
            background-image: url('../assets/admin/images/ca297136-78d1-422c-8274-0afa15d1b748.jpg');
            background-size: cover;
            background-position-x: center;
            background-position-y: center;
            background-color:rgba(0,0,0,.19);
}


*,:after,:before{box-sizing:border-box}
.clearfix:after,.clearfix:before{content:'';display:table}
.clearfix:after{clear:both;display:block}
a{color:inherit;text-decoration:none}

.login-wrap {
    width: 100%;
    margin: auto;
    max-width: 567px;
    min-height: 752px;
    position: relative;
    box-shadow: 0 12px 15px 0 rgb(0 0 0 / 24%), 0 17px 50px 0 rgb(0 0 0 / 24%);
}




.login-html{
	width:100%;
	height:100%;
	position:absolute;
	padding: 20px;
	background-color : transparent;
    margin-top: 5px;
}
.login-html .sign-in-htm,
.login-html .sign-up-htm{
	top:0;
	left:0;
	right:0;
	bottom:0;
	position:absolute;
	transform:rotateY(180deg);
	backface-visibility:hidden;
	transition:all .4s linear;
}
.login-html .sign-in,
.login-html .sign-up,
.login-form .group .check{
	display:none;
}
.login-html .tab,
.login-form .group .label,
.login-form .group .button{
	text-transform:uppercase;
}
.login-html .tab{
	font-size:22px;
	margin-right:15px;
	padding-bottom:5px;
	margin:0 15px 10px 0;
	display:inline-block;
	border-bottom:2px solid transparent;
	font-weight: bolder;

}
.login-html .sign-in:checked + .tab,
.login-html .sign-up:checked + .tab{
	color:#fff;
	border-color:#111111;
}
.login-form{
	min-height:345px;
	position:relative;
	perspective:1000px;
	transform-style:preserve-3d;
}
.login-form .group{
	margin-bottom:15px;
    color: #000
}
.login-form .group .label,
.login-form .group .input,
.login-form .group .button{
	width:100%;
	color:#fff;
	display:block;
}
.login-form .group .input,
.login-form .group .button{
  border: none;
    padding: 15px 20px;
    border-radius: 7px;
    background: rgba(0, 0, 0, 0.5);

}
.login-form .group input[data-type="password"]{
	text-security:circle;
	-webkit-text-security:circle;
}
.login-form .group .label{
color: #fff;
    font-size: 17px;
    margin-bottom: 10px;
    font-weight: bolder;

}
.login-form .group .button{
	background:#d8990a;
	   font-size: 28px;
    font-weight: 700;

}

.login-form .group .button:hover
{
    background:#000;
     cursor: pointer;
}
.login-form .group label .icon{
	width:15px;
	height:15px;.login-html .tab

	border-radius:2px;
	position:relative;
	display:inline-block;
	background:rgba(56, 54, 54, 0.1);
}
.login-form .group label .icon:before,
.login-form .group label .icon:after{
	content:'';
	width:10px;
	height:2px;
	background:#fff;
	position:absolute;
	transition:all .2s ease-in-out 0s;
}
.login-form .group label .icon:before{
	left:3px;
	width:5px;
	bottom:6px;
	transform:scale(0) rotate(0);
}
.login-form .group label .icon:after{
	top:6px;
	right:0;
	transform:scale(0) rotate(0);
}
.login-form .group .check:checked + label{
	color:#fff;
}
.login-form .group .check:checked + label .icon{
	background:#d8c30a;
}
.login-form .group .check:checked + label .icon:before{
	transform:scale(1) rotate(45deg);
}
.login-form .group .check:checked + label .icon:after{
	transform:scale(1) rotate(-45deg);
}
.login-html .sign-in:checked + .tab + .sign-up + .tab + .login-form .sign-in-htm{
	transform:rotate(0);
}
.login-html .sign-up:checked + .tab + .login-form .sign-up-htm{
	transform:rotate(0);
}

.hr{
	height:2px;
	background:rgba(255,255,255,.2);
}
.foot-lnk{
	text-align:center;
	font-size: 22px;
    color: #000000;
    font-weight: bold;
    text-decoration: underline;
    -webkit-transition: color 2s;    transition: color 2s;
}

.foot-lnk:hover
{
     text-decoration: none;
     color:#b76909;
}

@media (max-width: 575.98px) {
    .login-html {font-size: 14px;}
}
    </style>
</head>
<body>

        <div class="login-wrap" style="margin-top: 80px">
         <div class"overlay"> </div>
        <div class="login-html">
            <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab"> </label>
            <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab"> انشاء كلمة سر جديدة</label>
            <div class="login-form">

               <form action="{{ route('reset.password.post') }}" method="post" style="margin-top: 30px">
                @csrf
                    <div class="sign-in-htm">
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="group">
                            <label for="user" class="label">ايميل المستخدم</label>
                            <input id="user" type="text" class="input" name="email" required placeholder="ايميل المستخدم">
                            @error('email')
                                <span class="invalid-feedback" role="alert" style="background-color:#a7a7a7">
                                    <strong style="color: #f00">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="group">
                            <label for="pass" class="label">كلمة المرور</label>
                            <input id="pass" type="password" class="input" data-type="password" name="password" placeholder="كلمة المرور" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert" style="background-color:#a7a7a7">
                                    <strong style="color: #f00">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="group">
                            <label for="pass" class="label">كلمة المرور تاكيد </label>
                            <input  type="password" class="input" data-type="password" name="password_confirmation" placeholder="تاكيد كلمة المرور" required>
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert" style="background-color:#a7a7a7">
                                    <strong style="color: #f00">{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        {{-- <div class="group">
                            <input id="check" type="checkbox" class="check" checked>
                            <label for="check"><span class="icon"></span> Keep me Signed in</label>
                        </div> --}}
                        <div class="group">
                            <input type="submit" class="button" value="ارسال">
                        </div>
                        <div class="hr"></div>
                        
                    </div>
               </form>

               
            </div>
        </div>
    </div>

</body>
</html>
