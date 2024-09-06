<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>
    <div class="social-login text-center grid grid-cols-2 gap-x-8 pb-5 mt-100">
        <a class="social-login--facebook grid justify-items-end " onclick="loginFacebook()" >
            <img width="129px" height="37px" alt="facebook-login-button" src="//bizweb.dktcdn.net/assets/admin/images/login/fb-btn.svg">
        </a>
        <a class="social-login--google" href="#" onclick="loginGoogle()">
            <img width="129px" height="37px" alt="google-login-button" src="//bizweb.dktcdn.net/assets/admin/images/login/gp-btn.svg">
        </a>
    </div>

    <script type="text/javascript">
        function loginGoogle() {
            var width = 600, height = 400;
            var left = (screen.width - width)/2;
            var top = (screen.height - height)/2;
            var url = '/login/google';
            var params = 'width=' + width + ', height=' + height;
            params += ', top=' + top + ', left=' + left;
            params += ', directories=no';
            params += ', location=no';
            params += ', menubar=no';
            params += ', resizable=no';
            params += ', scrollbars=no';
            params += ', status=no';
            params += ', toolbar=no';
            window.open(url, 'Google Login', params);
        }
        </script>
</body>
</html>
