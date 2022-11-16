<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Novutec\WhoisParser\Parser as WhoisParser;
use Novutec\DomainParser\Parser as DomainParser;

class CheckDomainController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $domainParser = new DomainParser('json');
        $whoisParser = new WhoisParser('json');

        $result = json_decode($domainParser->parse($request->domain));

        // If domain is valid parse domain information
        if ($isValid = $result->validHostname) {
            $result = json_decode($whoisParser->lookup($result->fqdn));
        }



        return [
            'name' => $result->name,
            'expire_date' => $result->expires,
            'isValid' => $isValid,
            'registered' => $result->registered
        ];
    }
}
