<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Welcome Email</title>
</head>
<body>

<p>Hello {{ $user->email }}</p>
<p>We like to invite you to use our inovative platform and share your valuable feedback with us.</p>
<p>Please change your username and password through below link.</p>
<p>Send this unique string as token in form values with username, password</p>
<p>Token : {{$user->invitation_token}}</p>
<br>
<p>Thanks</p>
<p>Assessment Team</p>

</body>
</html>