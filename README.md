# PEX CARD PHP SDK
This is a PEX CARD PHP SDK to trigger the api



[View tutorial](https://developer.pexcard.com/docs4)

## Usage
- Install package

```
composer require aatishgore/PexCardSDK
```
- Publish Vendor

```
php artisan vendor:publish
```

## Define API KEYS and Username

- After Vendor Publish, define the api keys in config/pex.php


## Modules complete
-   Generating API key
```
use aatish\Pex\Services\PexService;

    $objPex = new PexService();
    $objPex->generate_user_token();
    $objPex->getToken()
```
-   Renew API key
```
    $pex = new PexService();
    $pex->renew_token(<token>);
        
```
-   Add Fund to card 
```
        $pex = new PexService();
        $pex->setToken(<token>);
        $pex->FundCard(<cardID>,<amount>);
```
-   Add Fund to card to zero
```
        $pex = new PexService();
        $pex->setToken(<token>);
        $pex->FundCardZero(<cardID>);
```

        