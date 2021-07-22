<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Confirm Email</title>
</head>
<body>

<p>Hello {{ $user->name }}</p>
<p>You have successfully completed varification.</p>
<p>Now you can login with username as below with your secreat password</p>
<p>Username : {{$user->name}}</p>
<br>
<p>Thanks</p>
<p>Assessment Team</p>

</body>
</html>