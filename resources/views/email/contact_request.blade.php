@include('email.email_header')

<table style="width:100%; border: 1px solid#eee; max-width: 600px; margin: 0 auto;">
    <tbody style="display: block;padding: 30px 0; color: #718096;">
        <tr>
			<td colspan="3" style="display: block;">
				<h1 style="margin:0; font-size: 18px;line-height: 30px;">Contact Request</h1>
			</td>
		</tr>
		<tr>
		    <td>
		    <h2>Name</h2>
		    </td>
		    <td>{{$data['name']}}</td>
		</tr>
		<tr>
		    <td>
		       <h2>Email</h2>
		    </td>
		    <td>{{$data['email']}}</td>
		</tr>
		<tr>
		    <td>
		       <h2>Phone</h2>
		    </td>
		    <td>{{$data['phone']}}</td>
		</tr>
		<tr>
		    <td>
		       <h2>Message</h2>
		    </td>
		    <td>{{$data['message']}}</td>
		</tr>
    </tbody>
</table>

@include('email.email_footer')
</body>
</html>