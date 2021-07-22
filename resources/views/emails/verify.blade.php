<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Confirm Email</title>
</head>
<body>

<p>Hello {{ $user->email }}</p>
<p>Thank you for accepting our invitation.</p>
<p>You have successfully created username and password.</p>
<p>Please verify the account with below details.</p>
<p>Generated pin : {{$user->pin}}</p>
<p>Username : {{$user->name}}</p>
<br>
<p>Thanks</p>
<p>Assessment Team</p>

</body>
</html>