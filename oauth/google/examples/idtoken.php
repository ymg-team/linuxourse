<?php
/*
 * Copyright 2011 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
include_once "templates/base.php";
session_start();

require_once realpath(dirname(__FILE__) . '/../src/Google/autoload.php');

/************************************************
  ATTENTION: Fill in these values! Make sure
  the redirect URI is to this page, e.g:
  http://localhost:8080/user-example.php
 ************************************************/
  $client_id = '850390802439-iam46vt2ah1i291fs4bhr3r8lp43miau.apps.googleusercontent.com';
  $client_secret = '-Fgv-YgBFMyPjjYDEztf3vWT';
  $redirect_uri = 'http://127.0.0.1/oprek/GoggleOauth/google-api-php-client-master/examples/idtoken.php';

  $client = new Google_Client();
  $client->setClientId($client_id);
  $client->setClientSecret($client_secret);
  $client->setRedirectUri($redirect_uri);
  $client->setScopes(array('https://www.googleapis.com/auth/userinfo.profile','https://www.googleapis.com/auth/userinfo.email'));

/************************************************
  If we're logging out we just need to clear our
  local access token in this case
 ************************************************/
  if (isset($_REQUEST['logout'])) {
    unset($_SESSION['access_token']);
  }

/************************************************
  If we have a code back from the OAuth 2.0 flow,
  we need to exchange that with the authenticate()
  function. We store the resultant access token
  bundle in the session, and redirect to ourself.
 ************************************************/
  if (isset($_GET['code'])) {
    $client->authenticate($_GET['code']);
    $_SESSION['access_token'] = $client->getAccessToken();
    $redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
    header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
  }

/************************************************
  If we have an access token, we can make
  requests, else we generate an authentication URL.
 ************************************************/
  if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
    $client->setAccessToken($_SESSION['access_token']);
  } else {
    $authUrl = $client->createAuthUrl();
  }

/************************************************
  If we're signed in we can go ahead and retrieve
  the ID token, which is part of the bundle of
  data that is exchange in the authenticate step
  - we only need to do a network call if we have
  to retrieve the Google certificate to verify it,
  and that can be cached.
 ************************************************/
  if ($client->getAccessToken()) {
    $_SESSION['access_token'] = $client->getAccessToken();
    $token_data = $client->verifyIdToken()->getAttributes();
  }

  echo pageHeader("User Query - Retrieving An Id Token");
  if (
    $client_id == '850390802439-iam46vt2ah1i291fs4bhr3r8lp43miau.apps.googleusercontent.com'
    || $client_secret == '-Fgv-YgBFMyPjjYDEztf3vWT'
    || $redirect_uri == 'http://127.0.0.1/oprek/GoggleOauth/google-api-php-client-master/examples/idtoken.php') {
    echo missingClientSecretsWarning();
}
?>
<div class="box">
  <div class="request">
    <?php
    if (isset($authUrl)) {
      echo "<a class='login' href='" . $authUrl . "'>Connect Me!</a>";
    } else {
      echo "<a class='logout' href='?logout'>Logout</a>";
    }
    ?>
  </div>

  <div class="data">
  </div>
</div>
<pre>
  <?php 
  if (isset($token_data)) {
    print_r($token_data);
  }
  ?>
</pre>
<?php
