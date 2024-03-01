@include('email.email_header')

<table style="width:100%; border: 1px solid#eee; max-width: 600px; margin: 0 auto;">
    <tbody style="display: block;padding: 30px 0; color: #718096;">
        <tr>
			<td colspan="3" style="padding: 15px; font-size: 18px; display: block;">
				<p>{{$data['message']}}</p>
				<p><strong>Username:</strong> {{$data['toUserName']}}</p>
				<p><strong>Name:</strong> {{$data['toName']}}</p>
				<p><strong>Email:</strong> {{$data['email']}}</p>
				@if(!empty($data['password']))
				<p><strong>Password:</strong> {{$data['password']}}</p>
				@endif
			</td>
		</tr>
    </tbody>
    </table>

@include('email.email_footer')
</body>
</html>