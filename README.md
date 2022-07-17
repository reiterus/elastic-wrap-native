# Elastic Wrap

Work with Elasticsearch: getting information and important operations.

### Info methods

getStats, getIndices, getAliases, getCountDocs, getEmptyIndices

### Action methods

deleteEmptyIndices, getAllDocs, getChunkDocs, getFirstDoc, getLastDoc

# Using

The package is very easy to use.

```php
use Elasticsearch\ClientBuilder;
use Reiterus\ElasticWrap\Info as ElasticInfo;
use Reiterus\ElasticWrap\Action as ElasticAction;

$client = ClientBuilder::create()
    ->setHosts(['localhost:9200'])
    ->build();

$info = new ElasticInfo($client);
$action = new ElasticAction($client);

$stats = $info->getStats();
/*
[total] => Array
  (
    [indices] => 15
    [documents] => 686
    [bytes] => 978811
  )
*/

$indices = $info->getIndices();
$aliases = $info->getAliases(true);
$empty = $info->getEmptyIndices();

$lastDoc = $action->getLastDoc('some_index_name')
$chunkDocs = $action->getChunkDocs('some_index_name', 10, '_id', 'desc');

// return the number of empty indexes removed
$deleted = $action->deleteEmptyIndices($empty);

print_r($indices);
/*
...
[6] => Array
(
  [index] => svs_vsf_1_config_1658031132
  [health] => yellow
  [status] => open
  [docs.count] => 49
  [store.size] => 16.3kb
)
...
*/

print_r($aliases);
/*
...
[6] => Array
(
    [svs_vsf_1_config] => svs_vsf_1_config_1658031132
)
...
*/
```

# Installation
You can install the package in two ways

From packagist.org
```shell
composer require reiterus/elastic-wrap-native
```

From GitHub repository
```json
{
 "repositories": [
  {
   "type": "vcs",
   "url": "https://github.com/reiterus/elastic-wrap-native.git"
  }
 ]
}
```

# License

This library is released under the [MIT license](LICENSE).
