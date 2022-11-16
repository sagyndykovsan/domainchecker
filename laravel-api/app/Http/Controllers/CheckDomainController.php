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

        // If domain is not valid return isValid and name
        if (!$isValid = $result->validHostname) {
            return [
                'name' => $request->domain,
                'isValid' => $isValid,
            ];
        }

        $result = json_decode($whoisParser->lookup($result->fqdn));

        return [
            'name' => $result->name,
            'expire_date' => $result->expires,
            'isValid' => $isValid,
            'registered' => $result->registered
        ];
    }
}
