<?php
/* Template Name: Customer Registration */

get_header('login');

?>

<main class="main-container">
	<?php do_action( 'woocommerce_before_customer_login_form' );  ?>
	<div class="auth-form auth-form--registration">
		<?php if (!empty($errors)): ?>
			<div class="errors">
				<ul>
					<?php foreach ($errors as $error): ?>
						<li><?php echo esc_html($error); ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
		<?php endif; ?>
		
		<div class="registration-progress-bar">
			<ol class="registration-progress-bar__steps">
				<li class="registration-progress-bar__step">1</li>
				<li class="registration-progress-bar__step">2</li>
				<li class="registration-progress-bar__step">3</li>
				<li class="registration-progress-bar__step">4</li>
			</ol>
			<button class="registration-progress-bar__back">
				<svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M1 1L6 6L1 11" stroke="#D4AF36" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
			</button>
		</div>

		<form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?>>
			<?php do_action( 'woocommerce_register_form_start' ); ?>
	
				<div class="registration-step step-1" id="step-1">
					<div>
						<div class="heading registration-step__heading">
							<h2 class="registration-step__title"><?php esc_html_e('פרטים אישיים', 'swap'); ?></h2>
						</div>
						<p class="auth-field">
							<input type="text" id="reg_username" name="username" autocomplete="username" required aria-required="true" placeholder="<?php esc_html_e('שם פרטי', 'swap') ?>" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>">
						</p>
						<p class="auth-field">
							<input type="email" id="email" name="email" required aria-required="true" placeholder="<?php esc_html_e('מייל', 'swap') ?>" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>">
						</p>
						<p class="auth-field">
							<input type="date" id="birthday" name="dob" onfocus="(this.type='date')" placeholder="<?php esc_html_e('תאריך לידה', 'swap') ?>" value="<?php echo isset($_POST['dob']) ? esc_attr($_POST['dob']) : ''; ?>">
							<span class="registration-field__info">*<?php esc_html_e('השימוש בפלטפורמה הינו מגיל 18 ומעלה.', 'swap') ?></span>
						</p>
						<p class="auth-field registration-field--agree">
							<label class="registration-label registration-label--agree">
								<input type="checkbox" name="agree" id="agree"><span>יש לקרוא את <a href="#">התקנון</a> על מנת להמשיך ברישום</span>
							</label>
						</p>
					</div>
					<div class="registration-buttons">
						<button type="button" class="auth-btn auth-btn-dark registration-btn-dark--next" disabled>המשך</button>
					</div> 
				</div>
				<div class="registration-step step-2" id="step-2">
					<div>
						<div class="heading registration-step__heading">
							<h2 class="registration-step__title"><?php esc_html_e('תמונת פרופיל', 'swap'); ?></h2>
							<p><?php esc_html_e('לחץ להעלאת תמונת פרופיל', 'swap'); ?></p>	
						</div>
						<p class="auth-field auth-field--media">
							<label class="registration-label registration-label--media">
								<input type="file" id="profile_photo" name="profile_photo"  class="registration-input registration-input--media" accept="image/*">
								<img id="previewImage" src="" alt="Image Preview">
							</label>
							עידו
						</p>
					</div>
					<div class="registration-buttons">
						<button type="button" class="auth-btn auth-btn-dark registration-btn-dark--next">המשך</button>
						<button type="button" class="auth-btn-skip">דילוג</button>
					</div> 
				</div>
				<div class="registration-step step-3" id="step-3">
					<div>
						<div class="heading registration-step__heading">
							<h2 class="registration-step__title"><?php esc_html_e('התאמה אישית', 'swap'); ?></h2>
							<p><?php esc_html_e('הגדיר/י את הדרך שלכם איתנו', 'swap'); ?></p>
						</div>
						<div class="registration-fieldset">
							<div class="registration-fieldset__heading">
								<h3 class="registration-fieldset__title">מה הסטייל שלך ביום-יום?</h3>
								<p class="registration-fieldset__subtitle">מה הסטייל שלך ביום-יום?</p>
							</div>
							<div class="registration-fieldset__styles">
								<?php
									$options = array(
										'evening' 	=> 'ערב', 
										'freedom' 	=> 'חופשה', 
										'wedding' 	=> 'חתונה', 
										'work'		=> 'עבודה', 
										'party'		=> 'מסיבה', 
										'festival'	=> 'פסטיבל'
									); 
								?>
								<label class="registration-fieldset__style">
									<input type="checkbox" name="styles[]" value="evening" class="registration-fieldset__checkbox" hidden>
									<svg width="40" height="56" viewBox="0 0 40 44" fill="none" xmlns="http://www.w3.org/2000/svg" class="registration-fieldset__icon registration-fieldset__icon--fill">
										<path d="M0.561902 41.7162L9.01967 43.9698C10.0059 44.2325 10.4267 42.7045 9.44119 42.4419L5.97164 41.5172L9.64158 27.7456C9.97866 27.7957 10.3165 27.8229 10.6528 27.8229C11.8523 27.8229 13.036 27.5073 14.1016 26.8897C14.8877 26.4373 15.5762 25.8334 16.1273 25.113C16.6784 24.3926 17.0811 23.5701 17.3121 22.693L20.7316 9.86182L22.7827 18.3446C23.5463 21.5022 26.3796 23.627 29.4935 23.627C29.7726 23.627 30.0531 23.6091 30.3358 23.574L33.6859 37.4258L30.1777 38.2745C29.1872 38.5143 29.6066 40.0422 30.5992 39.8025L39.1071 37.745C40.0975 37.5052 39.6782 35.9773 38.6855 36.217L35.226 37.0536L31.8759 23.2012C35.1222 22.0096 37.0366 18.5386 36.205 15.0991L32.7906 0.981096C32.7102 0.650584 32.502 0.365446 32.2117 0.188218C31.9213 0.0109891 31.5726 -0.0438606 31.2419 0.035699L20.3136 2.67866C19.9808 2.75953 19.6989 2.96493 19.5207 3.25692C19.3417 3.54963 19.2881 3.89386 19.3689 4.22665L20.0553 7.06427L9.27945 4.1923C8.95072 4.10513 8.60083 4.15196 8.30659 4.32249C8.01234 4.49303 7.79778 4.77334 7.70999 5.10191L3.96991 19.1376C3.05887 22.5571 4.89241 26.0724 8.11005 27.3377L4.4401 41.1086L0.98343 40.1875C-0.00347632 39.9256 -0.424288 41.4535 0.561902 41.7162ZM30.7445 21.8936C27.894 22.5828 25.0127 20.8251 24.3228 17.9739L22.2266 9.30718H33.1727L34.6635 15.4734C35.3541 18.3232 33.5957 21.2037 30.7445 21.8936ZM31.3213 1.64738L32.7906 7.72197H21.8444L20.9806 4.14864L31.3213 1.64738ZM9.1628 5.80255L19.4434 8.54213L18.6275 11.603H7.61695L9.1628 5.80255ZM5.50001 19.5462L7.19471 13.1875H18.2053L15.7806 22.2858C15.6024 22.9616 15.2921 23.5953 14.8674 24.1503C14.4427 24.7053 13.9122 25.1706 13.3065 25.5192C12.7028 25.8712 12.0352 26.0999 11.3425 26.192C10.6497 26.2842 9.9456 26.2379 9.27086 26.056C6.43682 25.3009 4.74498 22.381 5.50001 19.5462Z" fill="#0D0D0D"/>
										<path d="M9.91568 17.5109C9.91568 17.2107 9.79643 16.9228 9.58417 16.7106C9.37192 16.4983 9.08403 16.379 8.78385 16.379C8.48367 16.379 8.19579 16.4983 7.98353 16.7106C7.77127 16.9228 7.65202 17.2107 7.65202 17.5109C7.65202 17.8111 7.77127 18.0989 7.98353 18.3112C8.19579 18.5235 8.48367 18.6427 8.78385 18.6427C9.08403 18.6427 9.37192 18.5235 9.58417 18.3112C9.79643 18.0989 9.91568 17.8111 9.91568 17.5109ZM14.516 16.8968C14.816 16.8968 15.1037 16.7777 15.3158 16.5655C15.5279 16.3534 15.6471 16.0657 15.6471 15.7657C15.6471 15.4657 15.5279 15.178 15.3158 14.9659C15.1037 14.7538 14.816 14.6346 14.516 14.6346C14.216 14.6346 13.9283 14.7538 13.7162 14.9659C13.5041 15.178 13.3849 15.4657 13.3849 15.7657C13.3849 16.0657 13.5041 16.3534 13.7162 16.5655C13.9283 16.7777 14.216 16.8968 14.516 16.8968ZM26.3768 12.0403C26.0766 12.0403 25.7887 12.1596 25.5764 12.3718C25.3642 12.5841 25.2449 12.872 25.2449 13.1721C25.2449 13.4723 25.3642 13.7602 25.5764 13.9725C25.7887 14.1847 26.0766 14.304 26.3768 14.304C26.6769 14.304 26.9648 14.1847 27.1771 13.9725C27.3893 13.7602 27.5086 13.4723 27.5086 13.1721C27.5086 12.872 27.3893 12.5841 27.1771 12.3718C26.9648 12.1596 26.6769 12.0403 26.3768 12.0403ZM30.9306 16.3794C30.6305 16.3794 30.3427 16.4986 30.1305 16.7108C29.9183 16.923 29.7991 17.2108 29.7991 17.5109C29.7991 17.811 29.9183 18.0988 30.1305 18.3109C30.3427 18.5231 30.6305 18.6423 30.9306 18.6423C31.2306 18.6423 31.5184 18.5231 31.7306 18.3109C31.9428 18.0988 32.062 17.811 32.062 17.5109C32.062 17.2108 31.9428 16.923 31.7306 16.7108C31.5184 16.4986 31.2306 16.3794 30.9306 16.3794ZM11.7871 23.4617C11.9358 23.4617 12.0831 23.4324 12.2204 23.3755C12.3578 23.3186 12.4826 23.2352 12.5877 23.13C12.6929 23.0249 12.7763 22.9001 12.8332 22.7627C12.8901 22.6254 12.9193 22.4781 12.9193 22.3295C12.9193 22.1808 12.8901 22.0336 12.8332 21.8962C12.7763 21.7588 12.6929 21.634 12.5877 21.5289C12.4826 21.4238 12.3578 21.3404 12.2204 21.2835C12.0831 21.2266 11.9358 21.1973 11.7871 21.1973C11.4869 21.1973 11.1989 21.3166 10.9866 21.5289C10.7742 21.7412 10.655 22.0292 10.655 22.3295C10.655 22.6297 10.7742 22.9177 10.9866 23.13C11.1989 23.3424 11.4869 23.4617 11.7871 23.4617Z" fill="#0D0D0D"/>
									</svg>
									<?php esc_html_e( 'ערב', 'swap'); ?>
								</label>
								<label class="registration-fieldset__style">
									<input type="checkbox" name="styles[]" value="freedom" class="registration-fieldset__checkbox" hidden>
									<svg width="49" height="56" viewBox="0 0 49 49" fill="none" xmlns="http://www.w3.org/2000/svg" class="registration-fieldset__icon registration-fieldset__icon--stroke">
										<path d="M35.7391 19.3913L28.3826 2.83913C27.9739 1.81739 26.7478 1 25.5217 1H23.4783L25.9304 20.0043C20.2087 20.6174 13.2609 21.4348 8.15217 22.2522L6.1087 17.3478H3.04348L3.86087 23.2739C2.02174 23.6826 1 24.0913 1 24.5C1 24.9087 2.02174 25.3174 3.86087 25.7261L3.04348 31.6522H6.1087L8.15217 26.7478C13.2609 27.5652 20.0043 28.587 25.9304 28.9957L23.4783 48H25.5217C26.7478 48 27.7696 47.387 28.3826 46.1609L35.7391 29.6087C41.8696 29.6087 48 27.5652 48 24.5C48 21.4348 41.8696 19.3913 35.7391 19.3913Z" stroke="#0D0D0D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
										<path d="M39.8261 22.4565V26.5435C40.4391 26.5435 40.8478 25.7261 40.8478 24.5C40.8478 23.2739 40.4391 22.4565 39.8261 22.4565Z" stroke="#0D0D0D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
									</svg>
									<?php esc_html_e( 'חופשה', 'swap'); ?>
								</label>
								<label class="registration-fieldset__style">
									<input type="checkbox" name="styles[]" value="wedding" class="registration-fieldset__checkbox" hidden>
									<svg width="49" height="56" viewBox="0 0 49 42" fill="none" xmlns="http://www.w3.org/2000/svg" class="registration-fieldset__icon registration-fieldset__icon--fill">
										<path d="M24.4753 4.66849C24.0375 4.35475 23.5475 4.2402 23.0587 4.33757C22.36 4.4763 21.8025 5.01723 21.4327 5.49643C20.9605 5.11524 20.2955 4.7124 19.5808 4.74486C19.0838 4.76395 18.6345 4.98796 18.2813 5.39397C18.083 5.61905 17.9337 5.88299 17.8429 6.16897C17.7522 6.45494 17.7221 6.75668 17.7544 7.05495C17.7678 7.19814 17.7932 7.34069 17.8295 7.47433C18.1954 8.8833 19.7228 10.3088 21.6275 11.0197C21.773 11.0755 21.9298 11.0952 22.0847 11.0773C22.2395 11.0593 22.3876 11.0042 22.5165 10.9166C24.0808 9.86843 25.2021 8.29082 25.3714 6.90285C25.4031 6.66901 25.405 6.43207 25.3771 6.19773C25.2982 5.56325 24.9863 5.03441 24.4753 4.66849ZM24.1419 6.74694C24.019 7.74989 23.1408 8.96667 21.9374 9.81052C20.4947 9.2365 19.2824 8.13809 19.0285 7.15868C19.0091 7.08631 18.9959 7.01244 18.989 6.93786C18.9729 6.80684 18.9849 6.67388 19.0243 6.54789C19.0637 6.4219 19.1296 6.30577 19.2175 6.20728C19.3829 6.01636 19.5242 5.98709 19.6286 5.98327L19.6509 5.98264C19.9894 5.98264 20.4864 6.2671 20.9535 6.72785C21.0375 6.81219 21.1395 6.87643 21.2519 6.91576C21.3643 6.95509 21.4841 6.96849 21.6023 6.95497C21.7206 6.94144 21.8343 6.90133 21.9348 6.83764C22.0354 6.77395 22.1203 6.68834 22.183 6.58721C22.5394 6.01573 22.9677 5.61926 23.3005 5.55307C23.403 5.53334 23.5475 5.52825 23.7537 5.67589C23.9821 5.83945 24.1113 6.06028 24.1476 6.34983C24.1622 6.47138 24.1609 6.60312 24.1419 6.74694ZM25.4305 2.85478C25.2543 4.95868 26.6791 7.65952 28.9752 9.57251C29.1171 9.69169 29.2853 9.77519 29.466 9.81604C29.6467 9.85689 29.8345 9.85391 30.0138 9.80734C32.6968 9.11495 35.0152 7.48452 35.9183 5.65808C36.0729 5.35197 36.1855 5.03951 36.2543 4.72767C36.4401 3.86982 36.2766 3.04251 35.7821 2.33612C35.3589 1.73282 34.8052 1.37835 34.137 1.28289C33.031 1.12443 31.8982 1.74173 31.1657 2.26548C30.726 1.47763 29.9661 0.434585 28.8989 0.104935C28.2548 -0.0936185 27.6038 -0.0102521 26.9636 0.353763C26.2292 0.772508 25.7322 1.43372 25.526 2.26739C25.4783 2.46027 25.4464 2.65672 25.4305 2.85478ZM26.6664 2.95405C26.6766 2.82292 26.6977 2.69286 26.7294 2.56522C26.8542 2.06247 27.1393 1.68127 27.5771 1.43117C27.7998 1.30453 28.0124 1.24216 28.2205 1.24216C28.3255 1.24216 28.4292 1.25807 28.5329 1.28989C29.1152 1.46999 29.7586 2.18275 30.2518 3.19206C30.3084 3.31188 30.3914 3.41726 30.4947 3.50025C30.598 3.58324 30.7188 3.64165 30.8479 3.67108C30.9771 3.70051 31.1113 3.70018 31.2403 3.67011C31.3694 3.64004 31.4899 3.58103 31.5927 3.49753C31.9224 3.23407 33.066 2.38194 33.9614 2.51113C34.2815 2.55695 34.5449 2.73259 34.7664 3.04888C35.0661 3.47653 35.1565 3.94046 35.0426 4.46548C34.992 4.68766 34.9135 4.90255 34.809 5.10505C34.0727 6.59421 32.0414 7.99426 29.7408 8.5982C27.7884 6.95758 26.5245 4.64303 26.6664 2.95405ZM38.7725 12.8302C33.8818 11.0235 28.3363 12.0035 24.3073 15.1505C23.0643 14.1631 21.6721 13.3799 20.1829 12.8302C14.2644 10.6429 7.38825 12.54 3.39744 17.4128C-0.571087 22.2577 -1.13302 29.2599 2.08202 34.6546C5.31489 40.0766 11.7373 42.9264 17.9275 41.7293C20.2647 41.2763 22.4561 40.2601 24.3118 38.7688C27.7031 41.4143 32.168 42.5706 36.5139 41.7293C43.546 40.3713 48.5697 34.0551 48.6556 26.9651C48.5805 20.6858 44.6909 15.0143 38.7725 12.8302ZM27.2328 18.2446C29.667 16.478 32.8012 15.7277 35.8323 16.3723C40.8388 17.4351 44.3536 21.8873 44.4293 26.9644C44.3612 31.4771 41.5745 35.6142 37.2814 37.146C33.8742 38.3609 30.0794 37.7633 27.2175 35.6874C29.0325 33.1375 30.0267 30.0947 30.0673 26.9651C30.0313 23.8376 29.0425 20.7955 27.2328 18.2446ZM24.2895 21.4647C25.2764 23.1318 25.8106 25.0279 25.8391 26.9651C25.8104 28.903 25.28 30.8004 24.2997 32.4724C22.3447 29.1441 22.2817 24.886 24.2647 21.5048C24.2723 21.4921 24.28 21.4768 24.2895 21.4647ZM21.3672 18.2268C17.9682 23.0188 17.6329 29.5545 20.6716 34.6546C20.89 35.0208 21.1246 35.3771 21.3748 35.7224C20.5548 36.3255 19.6509 36.8051 18.6918 37.146C14.449 38.66 9.59843 37.3605 6.70858 33.896C3.82128 30.4366 3.40062 25.3925 5.67827 21.5048C8.00109 17.5363 12.7358 15.4152 17.2434 16.3723C18.7349 16.6882 20.1412 17.3206 21.3672 18.2268ZM38.1246 39.9983C33.738 41.5028 28.8906 40.6564 25.2695 37.9326C24.937 37.6827 24.6159 37.4179 24.3073 37.139C23.881 36.7534 23.4805 36.3401 23.1084 35.9019C23.0632 35.8542 23.0224 35.8039 22.9798 35.7536C22.7558 35.4844 22.5431 35.2061 22.3421 34.9193C19.2531 30.5403 18.9935 24.5512 21.7573 19.9126C21.9387 19.6078 22.1302 19.3125 22.3345 19.028C22.7652 19.4297 23.1621 19.866 23.5214 20.3326C21.0197 24.1624 20.8657 29.2395 23.2617 33.2004C23.3476 33.3417 23.4355 33.4798 23.5265 33.616C23.7632 33.9736 24.0178 34.316 24.2927 34.6437C24.6612 35.0901 25.0631 35.508 25.4948 35.8936C25.8022 36.173 26.1223 36.4333 26.4545 36.6751C29.1051 38.6104 32.5015 39.444 35.8349 38.8369C41.5414 37.8015 45.6035 32.6894 45.6888 26.9651C45.613 21.9312 42.524 17.3855 37.7721 15.6246C33.9626 14.2137 29.6664 14.9067 26.459 17.2448C26.0917 16.8072 25.6988 16.3917 25.2823 16.0007C28.3408 13.695 32.3118 12.6743 36.1792 13.4157C42.6723 14.6605 47.3186 20.4051 47.3962 26.9657C47.3262 32.7772 43.6701 38.0936 38.1246 39.9983Z" fill="#0D0D0D"/>
									</svg>
									<?php esc_html_e( 'חתונה', 'swap'); ?>
								</label>
								<label class="registration-fieldset__style">
									<input type="checkbox" name="styles[]" value="work" class="registration-fieldset__checkbox" hidden>
									<svg width="46" height="56" viewBox="0 0 46 38" fill="none" xmlns="http://www.w3.org/2000/svg" class="registration-fieldset__icon registration-fieldset__icon--stroke registration-fieldset__icon--work">
										<path d="M3.84211 6.6842H41.7368C43.2526 6.6842 44.5789 8.01052 44.5789 9.52631V34.1579C44.5789 35.6737 43.2526 37 41.7368 37H3.84211C2.32632 37 1 35.6737 1 34.1579V9.52631C1 8.01052 2.32632 6.6842 3.84211 6.6842Z" stroke="#0D0D0D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
										<path d="M17.1058 1H28.4742C29.99 1 31.3163 2.32632 31.3163 3.84211V6.68421H14.2637V3.84211C14.2637 2.32632 15.59 1 17.1058 1Z" stroke="#0D0D0D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
										<path d="M19.9474 19.9473H3.84211C2.32632 19.9473 1 18.621 1 17.1052" stroke="#0D0D0D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
										<path d="M44.5792 17.1052C44.5792 18.621 43.2529 19.9473 41.7371 19.9473H25.6318" stroke="#0D0D0D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
										<path d="M25.6315 18.0527H19.9473V23.7369H25.6315V18.0527Z" fill="#0D0D0D" stroke="#0D0D0D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="fill-primary"/>
									</svg>
									<?php esc_html_e( 'עבודה', 'swap'); ?>
								</label>
								<label class="registration-fieldset__style">
									<input type="checkbox" name="styles[]" value="party" class="registration-fieldset__checkbox" hidden>
									<svg width="34" height="56" viewBox="0 0 34 44" fill="none" xmlns="http://www.w3.org/2000/svg" class="registration-fieldset__icon registration-fieldset__icon--fill">
										<path d="M20.7647 6.21941C17.8274 0.142725 9.79465 -1.98439 4.24835 2.11059C-1.99313 6.71796 -0.714924 15.3836 3.94022 20.6509C5.33338 22.2275 6.9938 23.6483 8.86196 24.6323C9.23309 24.8275 9.62362 25.0505 10.0252 25.198C10.0744 25.7111 10.2032 26.1681 10.4988 26.6064C10.8298 27.0959 11.3249 27.4248 11.3249 28.0736C11.3249 28.7169 10.8264 29.0575 10.4988 29.5409C10.18 30.0029 10.0097 30.5513 10.0107 31.1127C10.0107 31.6818 10.1803 32.2143 10.4988 32.6838C10.825 33.1657 11.3291 33.5077 11.3249 34.1496C11.3207 34.7915 10.8284 35.1273 10.4988 35.6162C10.1699 36.1029 10.0474 36.607 10.0107 37.188C9.94837 38.1733 11.4821 38.1691 11.5437 37.188C11.5846 36.5336 12.0312 36.222 12.3698 35.7214C12.6877 35.2591 12.858 34.7111 12.858 34.15C12.858 33.5888 12.6877 33.0409 12.3698 32.5785C12.0416 32.0924 11.5437 31.7594 11.5437 31.1127C11.5437 30.4639 12.0395 30.135 12.3698 29.6454C12.6878 29.1828 12.858 28.6346 12.858 28.0733C12.858 27.5119 12.6878 26.9637 12.3698 26.5011C12.0589 26.0414 11.6663 25.7429 11.5672 25.1966C12.3628 24.8968 13.1155 24.4806 13.8308 24.0167C15.4365 26.7289 17.8253 29.1247 20.5826 30.6224C20.9399 30.8163 21.4246 31.1133 21.9016 31.3058C21.9529 31.8044 22.083 32.2517 22.3725 32.6796C22.7035 33.1691 23.1985 33.498 23.1985 34.1468C23.1985 34.7901 22.7 35.1315 22.3725 35.6141C22.0538 36.0764 21.8837 36.625 21.885 37.1866C21.885 37.7557 22.0547 38.2882 22.3725 38.7577C22.6986 39.2396 23.2034 39.5823 23.1985 40.2242C23.1944 40.8661 22.7021 41.2019 22.3725 41.6908C22.0443 42.1775 21.9217 42.6816 21.885 43.2626C21.8227 44.2479 23.3557 44.2437 23.418 43.2626C23.4596 42.6082 23.9055 42.2966 24.2441 41.796C24.562 41.3338 24.7322 40.7859 24.7322 40.2249C24.7322 39.6639 24.562 39.1161 24.2441 38.6538C23.9159 38.1677 23.418 37.8347 23.418 37.188C23.418 36.5392 23.9138 36.2103 24.2441 35.7207C24.562 35.2581 24.7322 34.7099 24.7322 34.1486C24.7322 33.5872 24.562 33.0391 24.2441 32.5764C23.9443 32.1333 23.5662 31.8432 23.4506 31.3342C24.0516 31.1099 24.6872 30.7041 25.1221 30.4528C26.6156 29.5886 27.9721 28.4551 29.1527 27.2005C33.6285 22.4449 35.6684 14.4689 30.6144 9.3367C28.0309 6.71173 24.3452 5.64678 20.7647 6.21941ZM9.32865 23.1422C7.9265 22.3556 6.68083 21.319 5.57088 20.1613C3.39806 17.8929 1.82003 15.0519 1.5119 11.8876C1.2287 8.98495 2.09215 6.1571 4.22135 4.12346C6.21414 2.21999 8.98174 1.29561 11.7189 1.53726C14.9054 1.81839 17.8157 3.75301 19.26 6.59194C17.5776 7.15027 16.0466 8.08932 14.7863 9.336C11.284 12.9954 11.1476 18.2108 13.1217 22.6506C12.6405 22.9656 12.1461 23.2578 11.6247 23.5043C10.7017 23.9399 10.1769 23.6179 9.32865 23.1422Z" fill="#0D0D0D"/>
									</svg>

									<?php esc_html_e( 'מסיבה', 'swap'); ?>
								</label>
								<label class="registration-fieldset__style">
									<input type="checkbox" name="styles[]" value="festival" class="registration-fieldset__checkbox" hidden>
									<svg width="54" height="56" viewBox="0 0 54 32" fill="none" xmlns="http://www.w3.org/2000/svg" class="registration-fieldset__icon registration-fieldset__icon--stroke">
										<path d="M8.91304 12.3043H13.4348C16.8261 12.3043 21.3478 15.9217 21.3478 17.5043V20.2174C15.9217 20.4435 10.9478 17.2783 8.91304 12.3043ZM45.087 12.3043H40.5652C37.1739 12.3043 32.6522 15.9217 32.6522 17.5043V20.2174C38.0783 20.4435 43.0522 17.2783 45.087 12.3043Z" fill="#0D0D0D"/>
										<path d="M27 30.3913C29.2609 30.3913 29.2609 28.1304 39.4348 25.8696C49.6087 23.6087 53 13.4348 53 1C49.6087 5.52174 47.3478 3.26087 40.5652 3.26087C33.7826 3.26087 30.3913 10.0435 27 10.0435C23.6087 10.0435 20.2174 3.26087 13.4348 3.26087C6.65217 3.26087 4.3913 5.52174 1 1C1 13.4348 4.3913 23.6087 14.5652 25.8696C24.7391 28.1304 24.7391 30.3913 27 30.3913Z" stroke="#0D0D0D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
										<path d="M8.91304 12.3043H13.4348C16.8261 12.3043 21.3478 15.9217 21.3478 17.5043V20.2174C15.9217 20.4435 10.9478 17.2783 8.91304 12.3043ZM45.087 12.3043H40.5652C37.1739 12.3043 32.6522 15.9217 32.6522 17.5043V20.2174C38.0783 20.4435 43.0522 17.2783 45.087 12.3043Z" stroke="#0D0D0D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="fill-primary"/>
									</svg>
									<?php esc_html_e( 'פסטיבל', 'swap'); ?>
								</label>
							</div>
		

						</div>

					</div>
					<div class="registration-buttons">
						<button type="submit" name="register" class="auth-btn auth-btn-dark">המשך</button>
					</div> 

				</div>
				<div class="registration-step step-4" id="step-4">

				</div>


			<?php wp_nonce_field('user_registration', 'user_registration_nonce'); ?>

			<?php do_action( 'woocommerce_register_form_end' ); ?>

		</form>

		
		<?php if( false ):?>
		

		<script>

			document.addEventListener("DOMContentLoaded", function () {



			const steps = document.querySelectorAll(".registration-step");
			const progressItems = document.querySelectorAll(".registration-progress-bar__step");
			const btnNext = document.querySelectorAll(".registration-btn-dark--next");
			const btnSkip = document.querySelectorAll(".auth-btn-skip");
			const btnBack = document.querySelector(".registration-progress-bar__back");


				const usernameInput = document.getElementById("reg_username");
				const emailInput = document.getElementById("email");
				const agreeCheckbox = document.getElementById("agree");

				const firstNextButton = steps[0].querySelector(".registration-btn-dark--next");

				let currentStep = 0;

				// Function to update the progress bar and show the current step
				function updateStep() {
					// Hide all steps
					steps.forEach(step => step.style.display = "none");
					// Show the current step
					steps[currentStep].style.display = "flex";

					// Update progress bar
					progressItems.forEach((item, index) => {
						if (index <= currentStep) {
							item.classList.add("registration-progress-bar__step--active");
						} else {
							item.classList.remove("registration-progress-bar__step--active");
						}
					});
				}

				// Enable or disable the "Next" button on the first step
				function toggleFirstNextButton() {
					if (usernameInput.value.trim() && emailInput.value.trim() && agreeCheckbox.checked) {
						firstNextButton.disabled = false;
					} else {
						firstNextButton.disabled = true;
					}
				}

				// Listen to input events on username and email fields
				usernameInput.addEventListener("input", toggleFirstNextButton);
				emailInput.addEventListener("input", toggleFirstNextButton);
				agreeCheckbox.addEventListener("change", toggleFirstNextButton);


				// Handle the "Next" button click
				btnNext.forEach(button => {
					button.addEventListener("click", function () {
						if (currentStep < steps.length - 1) {
							currentStep++;
							updateStep();
						}
					});
				});

				// Handle the "Skip" button click
				btnSkip.forEach(button => {
					button.addEventListener("click", function () {
						if (currentStep < steps.length - 1) {
							currentStep++;
							updateStep();
						}
					});
				});

				// Handle the "Back" button click
				btnBack.addEventListener("click", function () {
					if (currentStep > 0) {
						currentStep--;
						updateStep();
					}
				});

				// Initialize the form by showing the first step and toggling the "Next" button
				updateStep();
				toggleFirstNextButton();
			});


		</script>

<script>
			const fileInput = document.getElementById('profile_photo');
			const previewImage = document.getElementById('previewImage');

			fileInput.addEventListener('change', function () {
			const file = fileInput.files[0]; // Get the selected file
			if (file) {
				const reader = new FileReader(); // Create a FileReader
				reader.onload = function (e) {
				previewImage.src = e.target.result; // Set the img src to the file's data URL
				previewImage.style.display = 'block'; // Make the image visible
				};
				reader.readAsDataURL(file); // Read the file as a data URL
			} else {
				previewImage.src = '';
				previewImage.style.display = 'none';
			}
			});
		</script>

<?php endif; ?>




		
	</div>
</main>

<?php
get_footer('login');