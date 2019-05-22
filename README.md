# Third-party-login-with-Alipay
This PHP file is allowed that users login third party though their Aplipay account. The third party can obtain Alipay user ID (USER_ID) and authorization token (access_token), which is convenient for developers to use when processing their own business logic. For example, obtaining Alipay user information, issuing membership card, fast login, etc. Such scenarios as H5 (installation of Alipay mobile client), PC, APP (refer to APP Alipay login).

<p>1. Signup the Alipay open platfrom. The link is here: https://open.alipay.com/</p>
<p>2. Enter the developer center, create the application, and apply for the application to go online. This may take 1-2 working days.</p>
<p>3. After your application goes online, you gonna get your appid.</p>
<p>4. Sign up - get member information function in Alipay developer center.</p>
<p>5. Set authorization callback path and interface signature (select RSA2(SHA256) key.)</p>
<p>6. The key generation needs to download the generation tool provided by alipay. choose 2048 type.</p>
<p>7. Download Alipay SDK.</p>

<h3 style="color:red;"> your need to change your appid, private key and public key.</h3>
