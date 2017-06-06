<?php

namespace AWeberForLaravel\Console;

use \AWeberAPI;

use Illuminate\Console\Command;

class GenerateTokenCommand extends Command
{
    
    /**
     * Console command name
     *
     * @var string
     */
    protected $name = "aweber:generate-token";

     /**
      * Console command description
      *
      * @var string
      */
    protected $description = "Interactive task for generating AWeber API access token.";

    public function __construct()
    {
        parent::__construct();
    }

      /**
       * Execute console commmand
       *
       * @return void
       */
    public function fire()
    {
        $aweber = new AWeberAPI(
            config('aweber.consumer_key'),
            config('aweber.consumer_secret'));
        $callbackURL = 'oob';
        list($requestToken, $tokenSecret) = $aweber->getRequestToken($callbackURL);
        echo "Go to this url in your browser: {$aweber->getAuthorizeUrl()}\n";
        echo 'Type code here: ';
        $code = trim(fgets(STDIN));
        # exchange request token + verifier code for an access token
        $aweber->user->requestToken = $requestToken;
        $aweber->user->tokenSecret = $tokenSecret;
        $aweber->user->verifier = $code;
        list($accessToken, $accessSecret) = $this->aweber->getAccessToken();
        \Config::set('aweber.access_token', $accessToken);
        \Config::set('aweber.access_token_secret', $accessSecret);
        # show your access token
        print "Your access token is:\n$accessToken\n$accessSecret\n";
        print "Your token has been saved into your config file.\nKeep it safe, keep it secret\n";
    }
}
