Installation instructions
-------------------------
Update composer.json

Repository

{
    "type": "path",
    "url": "packages/proactiveants/parents",
    "options": {
        "symlink": true
    }
}

require

"proactiveants/parents": "dev-master"


Add this to /resources/views/partials/leftmenu.blade.php

<li><a href="{{route('parents.index')}}"><i class="fa fa-mobile fa-fw"></i>  Parents App</a></li>

/resources/views/partials/students/family.blade.php

Add placehoders for all three mobile numbers [placeholder="+94123456789"]

app/Jobs/SendSMS.php

Add after line 42

elseif(substr($mobile,0,1)=="+"){
    $mobile = substr($mobile,1,strlen($mobile)-1);
}

.env

Add API_KEY=123
APP_ONE_PRICE=500
APP_TWO_PRICE=250

app/Http/Kernel.php

'api_parents' => [
    'throttle:60,1',
    'bindings',
    \ProactiveAnts\Parents\VerifyAPIKey::class,
],

'api_parents_auth' => [
    'throttle:60,1',
    'bindings',
    \ProactiveAnts\Parents\VerifyAPIKey::class,
    \ProactiveAnts\Parents\VerifyToken::class,
],

Add Laravel schedule task to cron job


-------------------------END---------------------------------------