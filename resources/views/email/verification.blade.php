@include('email.email_header')

<table style="width:100%; border: 1px solid#eee; max-width: 600px; margin: 0 auto;">
    <tbody style="display: block;padding: 30px 0; color: #718096;">
        <tr>
			<td colspan="3" style="padding: 15px;display: block;">
				<p style="margin:0; font-size: 18px;line-height: 30px;">Hello <b>{{$data['toUserName']}}</b></p>
				<p>{{$data['message']}}</p>
				<p style="margin:0;margin-top: 10px; font-size: 16px;line-height: 30px;"><a href="{{url('user/verify', $data['token'])}}">Click here</a> to verify your account</p>
			</td>
		</tr>
    </tbody>
    </table>

@include('email.email_footer')
</body>
</html>