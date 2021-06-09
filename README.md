# owoify
pocketmine plugin i made at 3am for the lolz. this was for a 'pm plugin speedrunning' practice i was doing and took around 9m to make. owoifies all msgs sent by members
## Usage
Normal users:
> /owoify on (OPS ONLY COMMAND) \n
> /owoify off (OPS ONLY COMMAND)
'API' for developers:
```php
//make sure to download the plugin first
$owoify = \pocketmine\Server::getInstance()->getPlugin('owoify');
$owoify->owoify('hello world');
```
