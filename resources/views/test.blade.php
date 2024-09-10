<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="https://www.google.com/recaptcha/enterprise.js?render=6LcgYjsqAAAAACIzL1H9t7vASOTc5zXIzJwkPfxa">
    </script>
    <!-- Your code -->

    <title>Document</title>
</head>

<body>
    <button class="g-recaptcha" data-sitekey="6LcgYjsqAAAAACIzL1H9t7vASOTc5zXIzJwkPfxa" data-callback='onSubmit'
        data-action='submit'>
        Submit
    </button>
    <script>
        function onClick(e) {
        e.preventDefault();
        grecaptcha.enterprise.ready(async () => {
          const token = await grecaptcha.enterprise.execute('6LcgYjsqAAAAACIzL1H9t7vASOTc5zXIzJwkPfxa', {action: 'LOGIN'});
        });
      }
    </script>
</body>

</html>
