# wordpress-snippets
code snippets for wordpress

## General Snippets Go's Here:

#### add new admin account via ftp:

```
function add_admin_acct(){
	$login = 'myacct1';
	$passw = 'mypass1';
	$email = 'myacct1@mydomain.com';

	if ( !username_exists( $login )  && !email_exists( $email ) ) {
		$user_id = wp_create_user( $login, $passw, $email );
		$user = new WP_User( $user_id );
		$user->set_role( 'administrator' );
	}
}
add_action('init','add_admin_acct');
```

#### CSS/JS full screen loading animation

``` javascript
function loader(status){
	if(status && !jQuery( '.loader-box' ).length){
		jQuery( 'body' ).append(`
		<div class="loader-box">
		  <div class="signal"></div>
		</div>
		`);
	}else{
		jQuery( '.loader-box' ).remove();
	}
}
```
``` css
/* Loader Animation */
.loader-box {
  background-color: #00000075;
  width: 100%;
  height: 100%;
  position: absolute;
  top: 0;
  left: 0;
}
.signal {
  border: 5px solid #ffffff;
  border-radius: 95px;
  height: 95px;
  left: 50%;
  margin: -15px 0 0 -15px;
  opacity: 0;
  position: absolute;
  top: 50%;
  width: 95px;
  -webkit-animation: pulsate 1s ease-out;
  animation: pulsate 1s ease-out;
  -webkit-animation-iteration-count: infinite;
  animation-iteration-count: infinite;
}
@-webkit-keyframes pulsate {
  0% {
    -webkit-transform: scale(.1);
    transform: scale(.1);
    opacity: 0.0;
  }
  50% {
    opacity: 1;
  }
  100% {
    -webkit-transform: scale(1.2);
    transform: scale(1.2);
    opacity: 0;
  }
}
@keyframes pulsate {
  0% {
    -webkit-transform: scale(.1);
    transform: scale(.1);
    opacity: 0.0;
  }
  50% {
    opacity: 1;
  }
  100% {
    -webkit-transform: scale(1.2);
    transform: scale(1.2);
    opacity: 0;
  }
}
/* #Loader Animation */
```
