@include('email.email_header')

<!-- <table style="width:100%; border: 1px solid#eee; max-width: 600px; margin: 0 auto;">
    <tbody style="display: block;padding: 30px 0; color: #718096;">
        <tr>
			<td colspan="3" style="padding: 15px; font-size: 18px; display: block;">
				<p><strong>Name:</strong> {{$full_name}}</p> 
				<p>{{$personal_message}}</p>
				<p><strong>Giftcard Number:</strong> {{$giftcard_number}}</p>
				<p><strong>Giftcard Pin:</strong> {{$giftcard_pin}}</p>
			</td>
		</tr>
    </tbody>
    </table> -->



	<style type="text/css" media="screen">
		/* Linked Styles */
		body { padding:0 !important; margin:0 !important; display:block !important; min-width:100% !important; width:100% !important; background:#2e57ae; -webkit-text-size-adjust:none }
		a { color:#000001; text-decoration:none }
		p { padding:0 !important; margin:0 !important } 
		img { -ms-interpolation-mode: bicubic; /* Allow smoother rendering of resized image in Internet Explorer */ }
		.mcnPreviewText { display: none !important; }
		
		/* Mobile styles */
		@media only screen and (max-device-width: 480px), only screen and (max-width: 480px) {
			.mobile-shell { width: 100% !important; min-width: 100% !important; }
			
			.m-center { text-align: center !important; }
			.text3,
			.text-footer,
			.text-header { text-align: center !important; }
			
			.center { margin: 0 auto !important; }
			
			.td { width: 100% !important; min-width: 100% !important; }
			
			.m-br-15 { height: 15px !important; }
			.p30-15 { padding: 30px 15px !important; }
			.p30-15-0 { padding: 30px 15px 0px 15px !important; }
			.p40 { padding-bottom: 30px !important; }
			.box,
			.footer,
			.p15 { padding: 15px !important; }
			.h2-white { font-size: 40px !important; line-height: 44px !important; text-align: center !important; }

			.h2 { font-size: 25px !important; line-height: 40px !important; }

			.m-td,
			.m-hide { display: none !important; width: 0 !important; height: 0 !important; font-size: 0 !important; line-height: 0 !important; min-height: 0 !important; }

			.m-block { display: block !important; }
			.container { padding: 0px !important; }
			.separator { padding-top: 30px !important; }

			.fluid-img img { width: 100% !important; max-width: 100% !important; height: auto !important; }

			.column,
			.column-top,
			.column-dir,
			.column-empty,
			.column-empty2,
			.column-bottom,
			.column-dir-top,
			.column-dir-bottom { float: left !important; width: 100% !important; display: block !important; }

			.column-empty { padding-bottom: 10px !important; }
			.column-empty2 { padding-bottom: 30px !important; }

			.content-spacing { width: 15px !important; }
		}
	</style>

<body class="body" style="padding:0 !important; margin:0 !important; display:block !important; min-width:100% !important; width:100% !important; background:#2e57ae; -webkit-text-size-adjust:none;">
	<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#2e57ae">
		<tr>
			<td align="center" valign="top" class="container" style="padding:50px 10px;">
				<!-- Container -->
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td align="center">
							<table width="650" border="0" cellspacing="0" cellpadding="0" class="mobile-shell">
								<tr>
									<td class="td" bgcolor="#ffffff" style="width:650px; min-width:650px; font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal;">
										<!-- Header -->
										<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
											<tr>
												<td class="p30-15-0" style="padding: 40px 30px 0px 30px;">
													<table width="100%" border="0" cellspacing="0" cellpadding="0">
														<tr>
															<th class="column" style="font-size:0pt; line-height:0pt; padding:0; margin:0; font-weight:normal;">
																<table width="100%" border="0" cellspacing="0" cellpadding="0">
																	<tr>
																		<td class="img m-center" style="font-size:0pt; line-height:0pt; text-align:center;"><img src="{{url(Config::get('constants.SITE_IMAGE_PATHS').SiteSettingByName('site_logo'))}}" width="191" height="54" border="0" alt="" /></td>
																	</tr>
																</table>
														</tr>
													</table>
													<table width="100%" border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td class="separator" style="padding-top: 40px; border-bottom:4px solid #000000; font-size:0pt; line-height:0pt;">&nbsp;</td>
														</tr>
													</table>
												</td>
											</tr>
										</table>
										<!-- END Header -->

										<!-- Intro -->
										<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
											<tr>
												<td class="p30-15" style="padding: 70px 30px 70px 30px;">
													<table width="100%" border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td class="fluid-img pb40" style="font-size:0pt; line-height:0pt; text-align:center; padding-bottom:40px;"><img style="border-radius:10px;" src="images/t_free_image1.jpg" width="390" border="0" alt="" /></td>
														</tr>
														<tr>
															<td class="h2 center pb10" style="color:#000000; font-family:'Ubuntu', Arial,sans-serif; font-size:25px; line-height:40px; font-weight:800; text-align:center; padding-bottom:10px;">{{$full_name}}, you've got a SOI Gift Card!</td>
														</tr>
														<tr>
															<td class="h2 center pb10" style="color:#000000; font-family:'Ubuntu', Arial,sans-serif; font-size:40px; line-height:40px; font-weight:800; text-align:center; padding-bottom:10px;">NPR {{$balance_amount}}</td>
														</tr>
														
														<tr>
															<td class="h5 center blue pb30" style="font-family:'Ubuntu', Arial,sans-serif; font-size:20px; line-height:24px; text-align:center; color:#2e57ae; padding-bottom:30px;">NPR {{$balance_amount}} gift card from {{$sender_full_name}}</td>
														</tr>

														<tr>
															<td class="h5 center" style="font-family:'Ubuntu', Arial,sans-serif; font-size:17px; line-height:24px; text-align:center; color:#000; padding-bottom:30px;">
																<strong>Card Number:</strong>{{$giftcard_number}}<br>
																<strong>PIN: </strong>  {{$giftcard_pin}}
															</td>
														</tr>
														<tr>
															<td align="center">
																<table width="120" border="0" cellspacing="0" cellpadding="0">
																	<tr>
																		<td class="text-button" style="background:#3f78f1; color:#ffffff; font-family:'Fira Mono', Arial,sans-serif; font-size:14px; line-height:18px; text-align:center;"><a href="{{route('home')}}" target="_blank" class="link-white" style="color:#ffffff; text-decoration:none;padding:12px; display:block;"><span class="link-white" style="color:#ffffff; text-decoration:none;">Shop Now</span></a></td>
																	</tr>
																</table>
															</td>
														</tr>
													</table>
												</td>
											</tr>
											<!--<tr>-->
											<!--	<td class="fluid-img img-center pb70" style="font-size:0pt; line-height:0pt; text-align:center;"><img src="images/separator.jpg" width="590" height="1" border="0" alt="" /></td>-->
											<!--</tr>-->
										</table>
										<!-- END Intro -->
				 
										<!-- Footer -->
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
											<tr>
												<td class="footer" style="padding: 0px 30px 30px 30px;">
													<table width="100%" border="0" cellspacing="0" cellpadding="0">
														<tr>
															<td class="separator" style="border-bottom:4px solid #000000; font-size:0pt; line-height:0pt;"></td>
														</tr>
														<!--<tr>-->
														<!--	<td class="pb40" style="padding-bottom:40px;"></td>-->
														<!--</tr>-->
														<!--<tr>-->
														<!--	<td class="text-socials" style="color:#000000; font-family:'Fira Mono', Arial,sans-serif; font-size:16px; line-height:22px; text-align:center; text-transform:uppercase;">follow us</td>-->
														<!--</tr>-->
														<!--<tr>-->
														<!--	<td style="padding: 30px 0px 30px 0px;" align="center">-->
														<!--		<table class="center" border="0" cellspacing="0" cellpadding="0" style="text-align:center;">-->
														<!--			<tr>-->
														<!--				<td class="img" width="52" style="font-size:0pt; line-height:0pt; text-align:left;"><a href="#" target="_blank"><img src="images/t_free_ico_facebook.jpg" width="42" height="42" border="0" alt="" /></a></td>-->
														<!--				<td class="img" width="52" style="font-size:0pt; line-height:0pt; text-align:left;"><a href="#" target="_blank"><img src="images/t_free_ico_twitter.jpg" width="42" height="42" border="0" alt="" /></a></td>-->
														<!--				<td class="img" width="52" style="font-size:0pt; line-height:0pt; text-align:left;"><a href="#" target="_blank"><img src="images/t_free_ico_gplus.jpg" width="42" height="42" border="0" alt="" /></a></td>-->
														<!--				<td class="img" width="42" style="font-size:0pt; line-height:0pt; text-align:left;"><a href="#" target="_blank"><img src="images/t_free_ico_instagram.jpg" width="42" height="42" border="0" alt="" /></a></td>-->
														<!--			</tr>-->
														<!--		</table>-->
														<!--	</td>-->
														<!--</tr>-->
													</table>
												</td>
											</tr>
										</table>
										<!-- END Footer -->
									</td>
								</tr>
								<tr>
									<!-- <td class="text-footer" style="padding-top: 30px; color:#9fadd4; font-family:'Fira Mono', Arial,sans-serif; font-size:12px; line-height:22px; text-align:center;">
										Star Office Internatonal &copy; 0123 All rights reserved <br /><a href="#" target="_blank" class="link4" style="color:#9fadd4; text-decoration:none;"><span class="link4" style="color:#9fadd4; text-decoration:none;">Unsubscribe</span></a> 
									</td> -->
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<!-- END Container -->
			</td>
		</tr>
	</table>
</body>

@include('email.email_footer')
</body>
</html>