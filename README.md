# Earny API Client

Simple wrapper for the [Earny](http://www.earny.nl)! 

Examples. For more information about the Earny API, visit their [documentation](https://www.earny.nl/apidocs) page.

#####Add Draft
```php
$earny_data = [
    'idcontact' => 1,
    'idpaymentmethod' => 2,
    'idtemplate' => 3,
    'language' => 'nl',
    'rules' => [[
        'idcategory' => 4,
        'idvatgroup' => 5,
        'productcode' => 6,
        'name' => 'Some Product name',
        'description' => 'Some cool description'
        'price' => 10.00,
        'amount' => 2
    ]],
];

// insert into the database
$earny = new Earny('your@username.com', 'withyourpassword');
$result = $earny->addDraft($earny_data);
```

